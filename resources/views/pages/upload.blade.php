@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-semibold text-indigo-600 mb-6">Upload New Article</h1>
        
        <form action="{{ route('articles.store') }}" method="POST">
            @csrf

            <!-- Title Field -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-lg font-medium">Title</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('title') }}"
                    required
                >
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Category Field -->
            <div class="mb-4">
                <label for="category" class="block text-gray-700 text-lg font-medium">Category</label>
                <select 
                    name="category" 
                    id="category" 
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required
                >
                    <option value="facts" {{ old('category') == 'facts' ? 'selected' : '' }}>Facts</option>
                    <option value="education" {{ old('category') == 'education' ? 'selected' : '' }}>Education</option>
                    <option value="news" {{ old('category') == 'news' ? 'selected' : '' }}>News</option>
                </select>
                @error('category')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Source URL Field -->
            <div class="mb-4">
                <label for="source_url" class="block text-gray-700 text-lg font-medium">Source URL</label>
                <input 
                    type="url" 
                    name="source_url" 
                    id="source_url" 
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('source_url') }}"
                    required
                >
                @error('source_url')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Author Name Field -->
            <div class="mb-4">
                <label for="author_name" class="block text-gray-700 text-lg font-medium">Author Name</label>
                <input 
                    type="text" 
                    name="author_name" 
                    id="author_name" 
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('author_name') }}"
                    required
                >
                @error('author_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description Field -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-lg font-medium">Description</label>
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

            <!-- Upload Date Field -->
            <div class="mb-4">
                <label for="upload_date" class="block text-gray-700 text-lg font-medium">Upload Date</label>
                <input 
                    type="date" 
                    name="upload_date" 
                    id="upload_date" 
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('upload_date') }}"
                    required
                >
                @error('upload_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Upload Article
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
