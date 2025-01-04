<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;

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
            'status' => 'pending',
            'buyer_email' => $request->email,
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
            $transaction->update(['status' => 'success']);
            session()->flash('status', 'Payment successful!');
            return redirect()->route('merch'); // Adjust to your merch page route
        } elseif ($notification->transaction_status == 'deny' || $notification->transaction_status == 'expire') {
            $transaction->update(['status' => 'failed']);
            session()->flash('error', 'Payment failed or expired!');
            return redirect()->back();
        } elseif ($notification->transaction_status == 'pending') {
            $transaction->update(['status' => 'pending']);
        }

        return response()->json(['message' => 'Notification processed']);
    }
}
