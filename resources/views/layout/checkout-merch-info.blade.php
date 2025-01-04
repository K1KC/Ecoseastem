<div class="flex justify-between items-center border-b pb-4 mb-4">
    <div class="flex items-center space-x-4">
        <img src="{{ $thumbnail }}" class="w-12 h-12 rounded">
        <div>
            <p class="text-gray-700">{{$name}}</p>
            <p class="text-sm text-gray-500">{{$description}}</p>
        </div>
    </div>
    <p class="text-gray-700">Stock: {{$stock}}</p>
    <p class="text-gray-700">Rp {{$price}}</p>
</div>


