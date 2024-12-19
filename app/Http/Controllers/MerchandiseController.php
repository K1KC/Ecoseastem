<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;

class MerchandiseController extends Controller
{
    public function index()
    {
        $merchandises = Merchandise::all();
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
}
