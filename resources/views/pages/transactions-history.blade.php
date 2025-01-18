@extends('layout.app')
@section('title', 'Transaction History Page')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">{{__('messages.transaction.history')}}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($transactions as $transaction)
                @include('layout.transaction-card', ['transaction' => $transaction])
            @endforeach
        </div>
    </div>
@endsection