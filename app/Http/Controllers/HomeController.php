<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $articleController;
    protected $bookmarkController;
    protected $merchandiseController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleController $articleController, BookmarkController $bookmarkController, MerchandiseController $merchandiseController)
    {
        // $this->middleware('auth');
        $this->articleController = $articleController;
        $this->bookmarkController = $bookmarkController;
        $this->merchandiseController = $merchandiseController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = $this->articleController->articleOTD();
        $user_bookmarks = $this->bookmarkController->getThisUserBookmark();
        $merchs = $this->merchandiseController->getAllMerchs();
        return view('pages.landing', compact('articles', 'user_bookmarks', 'merchs'));
    }
}
