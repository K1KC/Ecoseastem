<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <form method="GET" action="{{ route('buy.merch', $merch_id)}}">
        @csrf
        <img class="w-full h-64 object-cover" src="{{$thumbnail}}" alt="Handcrafted Collection">
        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">{{$name}}</h3>
            <p class="text-gray-600">{{$description}}</p>
            <h4 class="text-xl font-bold mb-2">Stock: {{$stock}}</h4>
            <button type="submit">Buy for Rp{{ $price }}</button>
        </div>        
    </form>

</div>