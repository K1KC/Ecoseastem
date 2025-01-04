<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;

class MerchandiseController extends Controller
{
    public function getAllMerchs() {
        $merchandises = Merchandise::all();
        return $merchandises;
    }
    public function index()
    {
        $merchandises = $this->getAllMerchs();
        return view('pages.merch', compact('merchandises'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail_link' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Merchandise::create($request->all());
        return redirect()->route('merch.index')->with('success', 'Merchandise added successfully');
    }

    public function checkout($merch_id) {
        $merch = Merchandise::where('id', $merch_id)->first();
        $user = auth()->user();
        $subtotal = $merch->price;
        $shipping_fee = 12000;
        $tax = $merch->price * 0.11;
        $total = $subtotal + $shipping_fee + $tax;
        return view('pages.checkout', compact('merch', 'user', 'subtotal', 'shipping_fee', 'tax', 'total'));
    }
}
