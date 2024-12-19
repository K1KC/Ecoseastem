<div class="bg-white p-6 shadow-lg rounded-lg">
    <div>
        <div class="bg-gray-300 h-32 w-full mb-4"></div>
        <h3><a class="text-xl font-bold mb-2" href="{{ $source_url }}">{{$title}}</a></h3>
        <h4 class="pb-3">{{$category}}</h4>
        <p class="text-gray-600">{{$description}}</p>
        <h4 class="text-gray-600">{{ $uploaded_date }} | by {{$author_name}}</h4>  
    </div>

    <div class="pt-5">
        <form action="{{ route('edit.bookmark') }}" method="POST">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article_id }}">

            @if(in_array($article_id, $user_bookmarks))
                <button type="submit" name="action" value="remove">Remove from Bookmark</button>
            @else
                <button type="submit" name="action" value="add">Bookmark</button>
            @endif
        </form>       
    </div>

</div>