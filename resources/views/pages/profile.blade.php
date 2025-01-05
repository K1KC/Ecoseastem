@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<section id="profile" class="bg-white mt-8 p-6 rounded-lg shadow-md text-center">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ $current_username }}</h2>
    <div class="mt-4">
        @if(auth()->user()->profile_picture)
            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" class="w-24 h-24 mx-auto rounded-full object-cover">
        @else
            <img class="w-24 h-24 mx-auto rounded-full object-cover" src="{{ asset('avatar-icon.png')}}" alt="Profile Picture">
        @endif
    </div>
    <div class="mt-4 text-gray-600">
        <p><span class="font-semibold">Name:</span> {{ $current_username }}</p>
        <p><span class="font-semibold">Email:</span> {{ auth()->user()->email }}</p>
        <p><span class="font-semibold">Total Transaction:</span> Rp{{ $totalPrice }}</p>
    </div>
</section>
@endsection