@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="max-w-6xl mx-auto my-10 p-6 rounded-lg shadow-lg flex flex-col gap-8 bg-white">
    <h1 class="text-3xl font-bold mb-4 text-gray-900">Your Bookmarked Articles</h1>
    <!-- First Section -->
    <div class="flex flex-col md:flex-row items-center gap-8">
        @foreach($articles as $article)
            @include('layout.article-postcard', [
                'title' => $article->title,
                'category'=>$article->category->name,
                'source_url'=>$article->source_url,
                'description'=>$article->description,
                'uploaded_date'=>$article->uploaded_date,
                'author_name'=>$article->author_name,
                'article_id'=>$article->id,
                'user_bookmarks'=>$user_bookmarks
            ])        
        @endforeach
    </div>
</div>

@endsection 

<!-- Base -->
    {{-- <!-- Image -->
    <div class="w-full md:w-1/2">
        <img src="https://via.placeholder.com/500x350" alt="Team Retreat" class="rounded-lg object-cover">
    </div>
    <!-- Content -->
    <div class="w-full md:w-1/2">
        <h2 class="text-3xl font-bold mb-4 text-gray-900">Join our team</h2>
        <p class="text-gray-600 mb-6 leading-relaxed">
            Lorem ipsum dolor sit amet consect adipisicing elit. Possimus magnam voluptatem cupiditate veritatis in accusamus quisquam.
        </p>
    </div> --}}