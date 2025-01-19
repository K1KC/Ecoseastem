<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use App\Mail\ReceiptMail;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function __construct()
    {
        // Configure Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_PRODUCTION', false);
    }

    public function checkout(Request $request)
    {
        Log::info('Incoming request', $request->all());
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|string',
            'merch_id' => 'required|numeric',
            'total' => 'required|numeric|min:1',
        ]);

        // Check merchandise stock
        $merchandise = Merchandise::find($request->merch_id);
        if (!$merchandise || $merchandise->stock <= 0) {
            return response()->json(['error' => __('messages.transaction.stocknotavailable')], 400);
        }

        // Create a pending transaction
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'merch_id' => $merchandise->id,
            'total_price' => $request->total,
            'status' => 'Pending',
        ]);

        // Deduct merchandise stock
        $merchandise->decrement('stock');

        // Prepare parameters for Midtrans
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

        dd($request->all());
        // Generate Snap token
        try {
            $snapToken = Snap::getSnapToken($params);

            // Send receipt
            $this->sendReceipt($params, $merchandise, $request->email);

            return response()->json([
                'transaction' => $transaction,
                'snapToken' => $snapToken,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => __('messages.transaction.failtoken')], 500);
        }
    }

    public function notification(Request $request)
    {
        try {
            // Create Midtrans notification object
            $notification = new Notification();

            // Find transaction using order ID
            $transaction = Transaction::find($notification->order_id);
            if (!$transaction) {
                return response()->json(['message' => __('messages.transaction.transnotfound')], 404);
            }

            // Update transaction status
            $status = $notification->transaction_status;
            if (in_array($status, ['capture', 'settlement'])) {
                $transaction->update(['status' => 'Success']);
                session()->flash('status', __('messages.transaction.paysuccess'));
                return redirect()->route('merch');
            } elseif (in_array($status, ['deny', 'expire'])) {
                $transaction->update(['status' => 'Failed']);
                session()->flash('error', __('messages.transaction.payfail'));
                return redirect()->back();
            } elseif ($status === 'pending') {
                $transaction->update(['status' => 'Pending']);
            }

            return response()->json(['message' => __('messages.transaction.notifprocess')]);
        } catch (\Exception $e) {
            return response()->json(['message' => __('messages.transaction.notification_error')], 500);
        }
    }

    public function sendReceipt($params, $merchandise, $email)
    {
        $receiptData = [
            'order_id' => $params['transaction_details']['order_id'],
            'name' => $params['customer_details']['name'],
            'email' => $params['customer_details']['email'],
            'phone' => $params['customer_details']['phone'],
            'merch_name' => $merchandise->name,
            'total' => $params['transaction_details']['gross_amount'],
            'date' => Carbon::now()->format('H:i d/m/Y'),
        ];

        try {
            Mail::to($email)->send(new ReceiptMail($receiptData));
        } catch (\Exception $e) {
            throw new \Exception(__('messages.transaction.failsendreceipt'));
        }
    }

    public function showHistory()
    {
        // Retrieve transaction history
        $transactions = Transaction::with(['user:id,name', 'merch:id,name'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.transactions-history', compact('transactions'));
    }
}
