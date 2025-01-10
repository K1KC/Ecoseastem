<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    protected $categoryController;
    protected $bookmarkController;

    public function __construct(CategoryController $categoryController, BookmarkController $bookmarkController)
    {
        $this->categoryController = $categoryController;
        $this->bookmarkController = $bookmarkController;
    }

    public function articlesPage() {
        $articles = Article::orderBy('created_at', 'desc')->with('category')->paginate(10);
        $categories = $this->categoryController->getAllCategories();
        $user_bookmarks = $this->bookmarkController->getThisUserBookmark();
        $category_ph = "Select Category";
        return view('pages.articles', compact('articles', 'categories', 'category_ph', 'user_bookmarks'));
    }

    public function articleOTD() {
        return $articlesOTD = Article::orderBy('created_at', 'desc')->get();
    }
    public function showArticlePerCategory(Request $request) {
        $category_id = $request->input('category_id');

        if($category_id == 0) {
            return redirect()->route('articles');
        }
        $articles = Article::where('category_id', $category_id)->paginate(5);
        $categories = $this->categoryController->getAllCategories();
        $user_id = auth()->id();
        $current_category = Category::find($category_id);
        $category_ph = $current_category->name;
        $user_bookmarks = $this->bookmarkController->getThisUserBookmark();
        return view('pages.articles', compact('articles', 'categories', 'category_ph', 'user_bookmarks'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::where('title', 'like', '%' . $query . '%')->get();

        $user_bookmarks = $this->bookmarkController->getThisUserBookmark();
        return view('pages.articles-search', compact('articles', 'user_bookmarks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'source_url' => 'required|url',
            'author_name' => 'required|string|max:255',
            'description' => 'required|string',
            'uploaded_date' => 'nullable|date'
        ]);

        Log::info('Validated data:', $validated);

        $uploadDate = $validated['upload_date'] ?? Carbon::now()->format('Y-m-d');

        $article = new Article();
        $article->title = $validated['title'];
        $article->category_id = $validated['category_id'];
        $article->source_url = $validated['source_url'];
        $article->author_name = $validated['author_name'];
        $article->description = $validated['description'];
        $article->uploaded_date = $uploadDate;
        $article->save();

        Log::info('Article saved:', ['article' => $article]);

        return redirect()->route('articles')->with('message', __('messages.upload.article.success'));
    }
}
