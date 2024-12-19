<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $articleController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleController $articleController)
    {
        // $this->middleware('auth');
        $this->articleController = $articleController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = $this->articleController->articleOTD();
        $user_bookmarks = $this->articleController->getUser_bookmarks();
        return view('pages.landing', compact('articles', 'user_bookmarks'));
    }
}
