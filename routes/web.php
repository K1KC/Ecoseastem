<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/articles', [ArticleController::class, 'articlesPage'])->name('articles');
Route::post('/category', [ArticleController::class, 'showArticlePerCategory'])->name('category.articles');
Route::post('/edit-bookmark', [BookmarkController::class, 'bookmark'])->name('edit.bookmark');
Route::get('/bookmark', [BookmarkController::class, 'getBookmarkedArticles'])->name('bookmark');

Route::get('/merch', function () {
    return view('pages.merch');
});

Route::get('/login', function () {
    return view('pages.login');
})->name('login');
Route::get('/signup', function () {
    return view('pages.signup');
});
Route::get('/checkout', function () {
    return view('pages.checkout');
});
Route::get('/checkout', function () {
    return view('pages.checkout');
});

Route::get('/profile', function () {
    return view('pages.profile');
});
Route::get('/landing', function () {
    return view('pages.landing');
});





// Testing
Route::get('/welcome', function() {
    return view('welcome');
});
