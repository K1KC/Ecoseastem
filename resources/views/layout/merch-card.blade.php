<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <img class="w-full h-64 object-cover" src="https://via.placeholder.com/400x400" alt="Handcrafted Collection">
    <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">{{$name}}</h3>
        <p class="text-gray-600">{{$desc}}</p>
        <h4 class="text-xl font-bold mb-2">Stock: {{$merch_stock}}</h4>
        <button>Buy for Rp{{ $merch_price }}</button>
    </div>
</div>