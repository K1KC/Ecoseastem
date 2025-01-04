<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function viewProfile($current_username) {
        $user = auth()->user();
        $totalPrice = Transaction::where('user_id', $user->id)->sum('total_price');
        return view('pages.profile', compact('totalPrice', 'user', 'current_username'));
    }
}
