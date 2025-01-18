@extends('layout.app')
@section('title', 'Upload')
@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-semibold text-indigo-600 mb-6">@lang('messages.upload.article.heading')</h1>
        
        <form action="{{ route('article.store') }}" method="POST">
            @csrf

            <!-- Title Field -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-lg font-medium">@lang('messages.upload.article.title')</label>
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
                <label for="category_id" class="block text-gray-700 text-lg font-medium">@lang('messages.upload.article.category')</label>
                <select 
                    name="category_id" 
                    id="category_id" 
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required
                >
                    <option value="1" {{ old('category_id') == '1' ? 'selected' : '' }}>Facts</option>
                    <option value="2" {{ old('category_id') == '2' ? 'selected' : '' }}>Education</option>
                    <option value="3" {{ old('category_id') == '3' ? 'selected' : '' }}>News</option>
                </select>
                @error('category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
       
            <!-- Source URL Field -->
            <div class="mb-4">
                <label for="source_url" class="block text-gray-700 text-lg font-medium">@lang('messages.upload.article.source')</label>
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
                <label for="author_name" class="block text-gray-700 text-lg font-medium">@lang('messages.upload.article.author')</label>
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
                <label for="description" class="block text-gray-700 text-lg font-medium">@lang('messages.upload.article.description')</label>
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
                <label for="uploaded_date" class="block text-gray-700 text-lg font-medium">@lang('messages.upload.article.upload.date')</label>
                <input 
                    type="date" 
                    name="uploaded_date" 
                    id="uploaded_date" 
                    class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('uploaded_date') }}"
                >
                @error('uploaded_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @lang('messages.upload.article.submit')
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
