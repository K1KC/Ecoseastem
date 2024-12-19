<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Article;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function bookmark(Request $request) {
        $request->validate([
            'article_id' => 'required|exist:articles,id'
        ]);

        $userId = auth()->id();
        $articleId = $request->article_id;
        $bookmark = Bookmark::where('user_id', $userId)->where('article_id', $articleId)->first();

        if($bookmark) {
            $bookmark->delete();
            return redirect()->back()->with('message', 'Bookmark removed!');
        } else {
            Bookmark::create([
                'user_id' => $userId,
                'article_id' => $articleId,
            ]);
            return redirect()->back()->with('message', 'Added to bookmark!');
        }
    }

    public function getBookmark() {
        $user_id = auth()->id();
        return $user_bookmarks = Bookmark::where('user_id', $user_id)->pluck('article_id');
    }

    public function getBookmarkedArticles() {
        $user_bookmarks = $this->getBookmark();
        $articles = Article::whereIn('id', $user_bookmarks)->paginate(10);
        return view('pages.bookmark', compact('articles'));
    }
}
