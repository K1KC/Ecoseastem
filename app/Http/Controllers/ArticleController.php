<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private function showAllArticles() {
        $articles = Article::all();
        return view('pages.landing', compact('articles'));
    }
}
