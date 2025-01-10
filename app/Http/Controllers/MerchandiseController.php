<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|min:1',
            'description' => 'required|string',
            'stock' => 'required|integer|min:1',
        ]);

        Log::info('Validated data:', $validated);
        $merch = new Merchandise();
        $merch->name = $validated['name'];

        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        $merch->thumbnail = $thumbnailPath;
        
        $merch->price = $validated['price'];
        $merch->description = $validated['description'];
        $merch->stock = $validated['stock'];
        $merch->save();

        Log::info('Merch added:', ['merch' => $validated]);

        return redirect()->route('merch')->with('message', __('messages.upload.merch.success'));
    }

    public function checkoutPage($merch_id) {
        $merch = Merchandise::where('id', $merch_id)->first();
        $user = auth()->user();
        $subtotal = $merch->price;
        $shipping_fee = 12000;
        $tax = $merch->price * 0.11;
        $total = $subtotal + $shipping_fee + $tax;
        return view('pages.checkout', compact('merch', 'merch_id', 'user', 'subtotal', 'shipping_fee', 'tax', 'total'));
    }
}
