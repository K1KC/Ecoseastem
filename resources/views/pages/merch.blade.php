@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="container mx-auto px-4 py-16">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Eco Friendly Merchandises</h2>
    
    {{-- Success Popup --}}
    @if (session('status'))
        <div id="successPopup" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-lg font-bold text-green-600 mb-4">{{ session('status') }}</h2>
                <p class="text-gray-600">{{__('messages.t.thanks')}}</p>
                <button onclick="closePopup()" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Close
                </button>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($merchandises as $merch)
            @include('layout.merch-card',[
                'merch_id'=>$merch->id,
                'name'=>$merch->name,
                'thumbnail'=>$merch->thumbnail,
                'description'=>$merch->description,
                'price'=>$merch->price,
                'stock'=>$merch->stock
            ])
        @endforeach
        

    </div>
</div>
<script>
    function closePopup() {
        const popup = document.getElementById('successPopup');
        if (popup) {
            popup.style.display = 'none';
        }
    }
</script>
@endsection