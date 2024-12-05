<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    private function bookmark(Request $request) {
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
}
