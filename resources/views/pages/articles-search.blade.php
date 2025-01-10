@extends('layout.app')
@section('title', 'Home Page')
@section('content')
    <section class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-10 ml-8 mr-8">
        <h3 class="text-2xl font-bold mb-6">{{__('messages.articles.pages.heading')}}</h3>
        @foreach ($articles as $article)
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
    </section>
@endsection