@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="container mx-auto px-4 py-16">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Shop by Collection</h2>
    <p class="text-lg text-gray-600 mb-12">Each season, we collaborate with world-class designers to create a collection inspired by the natural world.</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Handcrafted Collection -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img class="w-full h-64 object-cover" src="https://via.placeholder.com/400x400" alt="Handcrafted Collection">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Handcrafted Collection</h3>
                <p class="text-gray-600">Keep your phone, keys, and wallet together, so you can lose everything at once.</p>
            </div>
        </div>

        <!-- Organized Desk Collection -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img class="w-full h-64 object-cover" src="https://via.placeholder.com/400x400" alt="Organized Desk Collection">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Organized Desk Collection</h3>
                <p class="text-gray-600">The rest of the house will still be a mess, but your desk will look great.</p>
            </div>
        </div>

        <!-- Focus Collection -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img class="w-full h-64 object-cover" src="https://via.placeholder.com/400x400" alt="Focus Collection">
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Focus Collection</h3>
                <p class="text-gray-600">Be more productive than enterprise project managers with a single piece of paper.</p>
            </div>
        </div>
    </div>
</div>

@endsection