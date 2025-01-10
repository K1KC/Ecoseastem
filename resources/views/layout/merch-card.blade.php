<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <form method="GET" action="{{ route('buy.merch', $merch_id)}}">
        @csrf
        <img class="w-auto h-auto object-cover " src="{{ asset('storage/'.$thumbnail) }}" alt="{{$name}}">
        <div class="p-6">
            <h3 class="text-xl font-semibold text-center text-gray-800 mb-4">{{$name}}</h3>
            <br>
            <p class="text-gray-600">{{$description}}</p>
            <p class="text-l font-bold mb-2">{{__('messages.upload.merch.stock')}} {{$stock}}</p>
            <button class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200" type="submit">Rp {{ $price }}</button>
        </div>        
    </form>

</div>