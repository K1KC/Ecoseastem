<?php

namespace App\Http\Controllers;

use App\Mail\ReceiptMail;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Merchandise;
use Midtrans\Config;
use Midtrans\Snap;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    protected $merchandiseController;

    public function __construct(MerchandiseController $merchandiseController) {
        $this->merchandiseController = $merchandiseController;
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|string',
            'merch_id' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        // Create a pending transaction
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'merch_id' => $request->merch_id,
            'total_price' => $request->total,
            'status' => 'Pending',
        ]);

        // Configure Midtrans parameters
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => $transaction->total_price,
            ],
            'customer_details' => [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];

        $merchId = $request->merch_id;
        $email = $request->email;
        $this->sendReceipt($params, $merchId, $email);

        // Generate Snap token
        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snapToken' => $snapToken]);
    }

    public function notification(Request $request)
    {
        // Create Midtrans notification object
        $notification = new \Midtrans\Notification();

        // Retrieve the transaction using the order ID
        $transaction = Transaction::find($notification->order_id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Handle payment status
        if ($notification->transaction_status == 'capture' || $notification->transaction_status == 'settlement') {
            $transaction->update(['status' => 'Success']);
            session()->flash('status', 'Payment Successful!');
            return redirect()->route('merch');
        } elseif ($notification->transaction_status == 'deny' || $notification->transaction_status == 'expire') {
            $transaction->update(['status' => 'Failed']);
            session()->flash('error', 'Payment Failed or Expired!');
            return redirect()->back();
        } elseif ($notification->transaction_status == 'pending') {
            $transaction->update(['status' => 'Pending']);
        }

        return response()->json(['message' => 'Notification processed']);
    }

    public function getAndSendReceipt ($transactionId) {

        $transaction = Transaction::where('id', $transactionId)->get();

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => $transaction->total_price,
            ],
            'customer_details' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
            ],
        ];

        $merchId = $transaction->merch_id;

        $email = auth()->user()->email;

        $this->sendReceipt($params, $merchId, $email);
    }

    public function sendReceipt($params, $merchId, $email) {
        $merchName = Merchandise::where('merch_id', $merchId)->firstOrFail()->merch_name;

        $receiptData = [
            'order_id' => $params['transaction_details']['order_id'],
            'name' => $params['customer_details']['name'],
            'email' => $params['customer_details']['email'],
            'phone' => $params['customer_details']['phone'],
            'merch_name' => $merchName,
            'total' => $params['transaction_details']['gross_amount'],
            'date' => Carbon::now()->format('H:i d/m/Y')
        ];

        Mail::to($email)->send(new ReceiptMail($receiptData));
    }
}
