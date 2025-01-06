@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<section id="profile" class="bg-white mt-8 p-6 rounded-lg shadow-md text-center">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ $user->name }}</h2>
    <div class="mt-4">
        @if(auth()->user()->profile_picture)
            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="w-32 h-32 mx-auto rounded-full object-cover">
        @else
            <img class="w-32 h-32 mx-auto rounded-full object-cover" src="{{ asset('avatar-icon.png')}}" alt="Profile Picture">
        @endif
    </div>
    <div class="mt-4 text-gray-600">
        <p><span class="font-semibold">Name:</span> {{ $user->name }}</p>
        <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
        <p><span class="font-semibold">Phone:</span> {{ $user->phone }}</p>
        <p><span class="font-semibold">Total Transaction:</span> Rp{{ $totalPrice }}</p>
        <a href="{{ route('edit.profile') }}" class="inline-block bg-indigo-600 text-white mt-5 py-2 px-4 rounded-md hover:bg-indigo-500">
            <button>Edit Profile</button>
        </a>
    </div>
</section>
@endsection