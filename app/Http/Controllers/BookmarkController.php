<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Article;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function bookmark(Request $request) {

        $request->validate([
            'article_id' => 'required|exists:articles,id'
        ]);

        $userId = auth()->id();
        $articleId = $request->article_id;
        $bookmark = Bookmark::where('user_id', $userId)->where('article_id', $articleId)->first();

        if($bookmark) {
            $bookmark->delete();
            return redirect()->back()->with('message', __('messages.bookmark.remove'));
        } else {
            Bookmark::create([
                'user_id' => $userId,
                'article_id' => $articleId,
            ]);
            return redirect()->back()->with('message', __('messages.bookmark.added'));
        }
    }

    public function getThisUserBookmark() {
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            return Bookmark::where('user_id', $user_id)->pluck('article_id')->toArray();
        }

        return [];
    }

    public function getBookmarkedArticles() {
        $user_bookmarks = $this->getThisUserBookmark();
        $articles = Article::whereIn('id', $user_bookmarks)->paginate(10);
        return view('pages.bookmark', compact('articles', 'user_bookmarks'));
    }
}
