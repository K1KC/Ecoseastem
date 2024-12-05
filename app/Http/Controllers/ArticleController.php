<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private function showAllArticles() {
        $articles = Article::orderBy('created_at', 'desc')->with('category')->paginate(10);
        return view('pages.landing', compact('articles'));
    }

    private function showArticlePerCategory() {
        //
    }


}
