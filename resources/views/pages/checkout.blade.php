@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    @if (session('error'))
        <div id="errorPopup" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h2 class="text-lg font-bold text-red-600 mb-4">Payment Failed</h2>
                <p class="text-gray-600">{{ session('error') }}</p>
                <button onclick="closePopup('errorPopup')" class="mt-4 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                    Close
                </button>
            </div>
        </div>
    @endif

    <form id="checkout-form" method="POST" action="{{ route('checkout') }}">
        @csrf
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Product Information</h2>

            @include('layout.checkout-merch-info',[
                'name'=>$merch->name,
                'thumbnail'=>$merch->thumbnail_link,
                'description'=>$merch->description,
                'price'=>$merch->price,
                'stock'=>$merch->stock
            ])
            <h2 class="text-xl font-semibold mb-4">Contact information</h2>
            <div class="mb-6">
                <label for="email" class="block text-gray-700">Email address</label>
                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" required
                       class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mt-4">
                <label for="name" class="block text-gray-700">Full Name</label>
                <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" required
                       class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="mt-4">
                <label for="phone" class="block text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" required
                       class="w-full mt-2 p-2 border rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>
            <input type="hidden" name="total" value="{{ $total }}">
            <div class="mt-6">
                <button type="button" id="pay-button" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">
                    Confirm Order
                </button>
            </div>
        </div>
    </form>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        fetch("{{ route('checkout') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                email: document.getElementById('email').value,
                name: document.getElementById('name').value,
                phone: document.getElementById('phone').value,
                merch_id: "{{ $merch_id }}",
                total: "{{ $total }}",
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.snapToken) {
                snap.pay(data.snapToken, {
                    onSuccess: function(result) {
                        window.location.href = "{{ route('payment.success') }}";
                    },
                    onPending: function(result) {
                        alert('Waiting for payment!');
                    },
                    onError: function(result) {
                        alert('Payment failed!');
                    }
                });
            }
        });
    });

    function closePopup(popupId) {
        const popup = document.getElementById(popupId);
        if (popup) {
            popup.style.display = 'none';
        }
    }
</script>
@endsection
