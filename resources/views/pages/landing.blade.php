@extends('layout.app')
@section('title', 'Home Page')
@section('content')
<div class="banner bg-cover bg-center text-white text-center py-64 relative overflow-hidden" style="background-image: url('banner.jpg')">
    <div class="banner-content w-full sm:max-w-md md:max-w-4xl lg:max-w-6xl mx-auto">
        <h1 class="text-4xl font-semibold mb-4">Ecoseastem</h1>
        <p class="text-lg mb-6">@lang('messages.motto')</p>
    </div>
    <div class="curve absolute bottom-0 left-0 right-0 h-32 bg-blue-500"></div>
</div>

    <p>Current locale: {{ App::getLocale() }}</p>
    <p>Session Locale: {{ session('locale') }}</p>
    <p>App Locale: {{ App::getLocale() }}</p>


    <section class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-10 ml-8 mr-8">
        <h3 class="text-2xl font-bold mb-6">{{__('messages.landing.articles.heading')}}</h3>
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

    <section class="mt-10 ml-8 mr-8">
        <h3 class="text-2xl font-bold mb-6">{{__('messages.landing.merch')}}</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($merchs as $merch)
                @include('layout.merch-card', [
                    'merch_id'=>$merch->id,
                    'name'=>$merch->name,
                    'thumbnail'=>$merch->thumbnail,
                    'description'=>$merch->description,
                    'stock'=>$merch->stock,
                    'price'=>$merch->price
                ])
            @endforeach
        </div>
    </section>
@endsection
