@extends('layout.app')
@section('title', 'Edit Profile Page')
@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center text-gray-900">Edit Profile</h2>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 my-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Profile Picture -->
        <div class="mb-4">
            <label for="profile_picture" class="block text-sm font-medium text-gray-700">{{__('messages.profile.picture')}}</label>
            <input type="file" name="profile_picture" id="profile_picture" class="mt-2 p-2 border border-gray-300 rounded-md w-full" accept="image/*">
            @if ($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="mt-4 rounded-full w-24 h-24 mx-auto">
            @endif
            @error('profile_picture')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">{{__('messages.profile.name')}}</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">{{__('messages.profile.email')}}</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">{{__('messages.profile.phone')}}</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="mt-2 p-2 border border-gray-300 rounded-md w-full" required>
            @error('phone')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4 flex justify-center">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500">{{__('messages.edit.profile')}}</button>
        </div>
    </form>
</div>
@endsection