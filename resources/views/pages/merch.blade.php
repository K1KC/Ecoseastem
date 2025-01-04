@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="container mx-auto px-4 py-16">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Shop by Collection</h2>
    <p class="text-lg text-gray-600 mb-12">Each season, we collaborate with world-class designers to create a collection inspired by the natural world.</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($merchandises as $merch)
            @include('layout.merch-card',[
                'merch_id'=>$merch->id,
                'name'=>$merch->name,
                'thumbnail'=>$merch->thumbnail_link,
                'description'=>$merch->description,
                'price'=>$merch->price,
                'stock'=>$merch->stock
            ])
        @endforeach
        

    </div>
</div>

@endsection