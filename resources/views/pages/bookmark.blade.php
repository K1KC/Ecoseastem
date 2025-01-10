@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="max-w-6xl mx-auto my-10 p-6 rounded-lg shadow-lg flex flex-col gap-8 bg-white">
    <h1 class="text-3xl font-bold mb-4 text-gray-900">{{__('messages.bookmark.page.heading')}}</h1>
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

@endsection 
