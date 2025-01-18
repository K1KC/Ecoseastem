@extends('layout.app')
@section('title', 'Upload Merch Page')
@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-semibold text-indigo-600 mb-6">{{ __('messages.upload.merch.heading') }}</h1>
        
        <form action="{{ route('merch.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name Field -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-lg font-medium">{{ __('messages.upload.merch.name') }}</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Thumbnail Field -->
            <div class="mb-4">
                <label for="thumbnail" class="block text-lg font-medium text-gray-700">{{ __('messages.upload.merch.thumbnail') }}</label>
                
                <div class="mt-2 relative">
                    <!-- Hidden file input -->
                    <input type="file" name="thumbnail" id="thumbnail" class="hidden" accept="image/*" onchange="updateThumbnailLabel(this)">
            
                    <!-- Custom label -->
                    <label for="thumbnail" class="flex items-center justify-between p-2 border border-gray-300 rounded-md w-full cursor-pointer bg-white">
                        <span id="thumbnail-label" class="text-gray-500">{{ __('messages.upload.merch.choose.file') }}</span>
                    </label>
                </div>
            
                @error('thumbnail')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
       

            <!-- Price Field -->
            <div class="mb-4">
                <label for="price" class="block text-gray-700 text-lg font-medium">{{ __('messages.upload.merch.price') }}</label>
                Rp <input 
                    type="number" 
                    name="price" 
                    id="price" 
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('price') }}"
                    required
                >
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Stock Field -->
            <div class="mb-4">
                <label for="stock" class="block text-gray-700 text-lg font-medium">{{ __('messages.upload.merch.stock') }}</label>
                <input 
                    type="number" 
                    name="stock" 
                    id="stock" 
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('stock') }}"
                    required
                >
                @error('stock')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-lg font-medium">{{ __('messages.upload.merch.description') }}</label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4" 
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    {{ __('messages.upload.merch.submit') }}
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function updateThumbnailLabel(input) {
        const label = document.getElementById('thumbnail-label');
        if (input.files.length > 0) {
            label.textContent = input.files[0].name;
        } else {
            label.textContent = 'Choose file';
        }
    }
</script>
@endsection
