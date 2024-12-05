<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1>{{ $title }}</h1>
            <h3>{{ $description }}</h3>
            <p>{{ $author_name }}</p>
            <form action="{{ route('bookmark') }}" method="POST">
                @csrf
                <input type="hidden" name="article_id" id="{{ $article_id }}">
                <button type="submit">
                    Bookmark
                </button>
            </form>
        </div>
    </div>
</div>