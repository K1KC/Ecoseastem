<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $merch = Merchandise::findOrFail($request->merchandise_id);
        $quantity = $request->quantity;

        if ($quantity > $merch->stock) {
            return redirect()->back()->with('error', 'Insufficient stock');
        }

        $totalPrice = $merch->price * $quantity;

        Transaction::create([
            'user_id' => Auth::id(),
            'merchandise_id' => $merch->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
        ]);

        $merch->decrement('stock', $quantity);

        return redirect()->route('merch.index')->with('success', 'Transaction completed');
    }
}

