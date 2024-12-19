@extends('layout.app')
@section('title', 'Home Page')
@section('content')
        <section class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-10 ml-8 mr-8">
            <h3 class="text-2xl font-bold mb-6">Our Knowledges</h3>
            <div class="max-w-md mx-auto">
                <div class="relative">
                    <form id="category_form" method="POST" action="{{ route('category.articles') }}">
                        @csrf
                        <input type="hidden" name="category_id" id="category_id">
                    
                        <select id="category_select" class="block w-full bg-white border border-gray-300 rounded-md shadow-sm px-4 py-2 text-gray-700 focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                            <option value="" disabled selected>{{ $category_ph }}</option>
                            <option value="0">All</option> 
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
                'category'=>$article->category->name,
                'source_url'=>$article->source_url,
                'description'=>$article->description,
                'uploaded_date'=>$article->uploaded_date,
                'author_name'=>$article->author_name,
                'article_id'=>$article->article_id,
                'user_bookmarks'=>$user_bookmarks
                ])
            @endforeach
        </section>

        <script>
            document.getElementById('category_select').addEventListener('change', function() {
                // Set the value of the hidden input to the selected category_id
                document.getElementById('category_id').value = this.value;
                // Submit the form
                document.getElementById('category_form').submit();
            });
        </script>
@endsection
