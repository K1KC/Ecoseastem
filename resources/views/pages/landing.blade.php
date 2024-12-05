@extends('layout.master')

@section('body')

    @include('layout.articles-postcard', [
        'title' => $articles->title,
        'category_name' => $articles->category->name,
        'source_url' => $articles->source_url,
        'author_name' => $articles->author_name,
        'description' => $articles->description,
        'article_id' => $articles->id
    ])
    
@endsection