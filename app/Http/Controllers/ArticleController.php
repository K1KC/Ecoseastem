<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $categoryController;
    protected $bookmarkController;

    public function __construct(CategoryController $categoryController)
    {
        $this->categoryController = $categoryController;
    }



    public function getUser_bookmarks() {
        $user_id = auth()->id();
        return $user_bookmarks = Bookmark::where('user_id', $user_id)->pluck('article_id')->toArray();
    }

    public function articlesPage() {
        $articles = Article::orderBy('created_at', 'desc')->with('category')->paginate(10);
        $categories = $this->categoryController->getAllCategories();
        $user_id = auth()->id();
        $user_bookmarks = $this->getUser_bookmarks();
        $category_ph = "Select Category";
        return view('pages.articles', compact('articles', 'categories', 'category_ph', 'user_bookmarks'));
    }

    public function articleOTD() {
        return $articlesOTD = Article::inRandomOrder()->take(5)->get();
    }
    public function showArticlePerCategory(Request $request) {
        $category_id = $request->input('category_id');

        if($category_id == 0) {
            return $this->articlesPage();
        }

        $articles = Article::where('category_id', $category_id)->paginate(10);
        $categories = $this->categoryController->getAllCategories();
        $user_id = auth()->id();
        $current_category = Category::find($category_id);
        $category_ph = $current_category->name;
        $user_bookmarks = $this->getUser_bookmarks();
        return view('pages.articles', compact('articles', 'categories', 'category_ph', 'user_bookmarks'));
    }

}
