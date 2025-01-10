@extends('layout.app')
@section('title', 'Home Page')
@section('content')
    <section class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-10 ml-8 mr-8">
        <h3 class="text-2xl font-bold mb-6">{{__('messages.articles.pages.heading')}}</h3>
        <div class="max-w-md mx-auto">
            <div class="relative">
                <form id="category_form" method="POST" action="{{ route('category.articles') }}">
                    @csrf
                    <input type="hidden" name="category_id" id="category_id">
                
                    <select id="category_select" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm px-4 py-2 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                        <option value="" disabled selected>{{ $category_ph }}</option>
                        <option value="0">{{__('messages.all.category')}}</option> 
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        @foreach ($articles as $article)
            @include('layout.article-postcard', [               
                'title' => $article->title,
                'category' => $article->category->name,
                'source_url' => $article->source_url,
                'description' => $article->description,
                'uploaded_date' => $article->uploaded_date,
                'author_name' => $article->author_name,
                'article_id' => $article->id,
                'user_bookmarks' => $user_bookmarks
            ])
        @endforeach

        {{-- Pagination --}}
        @if ($articles->hasPages())
            <div class="flex justify-center mt-4">
                <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    {{-- Previous Page Link --}}
                    @if ($articles->onFirstPage())
                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-lg cursor-not-allowed" aria-disabled="true">
                            {!! __('pagination.previous') !!}
                        </span>
                    @else
                        <a href="{{ $articles->previousPageUrl() }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {!! __('pagination.previous') !!}
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                        @if ($page == $articles->currentPage())
                            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-100 border border-indigo-300 cursor-default">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($articles->hasMorePages())
                        <a href="{{ $articles->nextPageUrl() }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {!! __('pagination.next') !!}
                        </a>
                    @else
                        <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-lg cursor-not-allowed" aria-disabled="true">
                            {!! __('pagination.next') !!}
                        </span>
                    @endif
                </nav>
            </div>
        @endif

    </section>

    <script>
        document.getElementById('category_select').addEventListener('change', function() {

            document.getElementById('category_id').value = this.value;

            document.getElementById('category_form').submit();
        });
    </script>
@endsection
