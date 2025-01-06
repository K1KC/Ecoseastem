<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/articles', [ArticleController::class, 'articlesPage'])->name('articles');

Route::get('/articles/search', [ArticleController::class, 'search'])->name('articles.search');

Route::post('/category', [ArticleController::class, 'showArticlePerCategory'])->name('category.articles');

Route::get('/merch', [MerchandiseController::class, 'index'])->name('merch');
Route::get('/about-us', function() {
    return view('pages.about-us');
})->name('about.us');

Route::middleware(['auth'])->group(function () {
    Route::post('/edit-bookmark', [BookmarkController::class, 'bookmark'])->name('edit.bookmark');

    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('edit.profile');

    Route::get('/bookmark', [BookmarkController::class, 'getBookmarkedArticles'])->name('bookmark');

    Route::get('/buy-merch/{merch_id}', [MerchandiseController::class, 'buyMerch'])->name('buy.merch');

    // Route::post('/update-quantity', [MerchandiseController::class, 'updateQuantity'])->name('update.quantity');
    // Route::post('/confirm-order', [TransactionController::class])
    
    Route::get('/upload', function() {
        return view('pages.upload');
    })->name('upload.articles');

    Route::get('/transaction-history', [TransactionController::class, 'showHistory'])->name('transactions.history');

    Route::post('/send-receipt/{transactionId}', [PaymentController::class, 'getAndSendReceipt'])->name('send.receipt');

    Route::post('/article/upload', [ArticleController::class, 'store'])->name('article.store');

    Route::get('/profile', [ProfileController::class, 'viewProfile'])->name('profile');
    Route::post('/update-profile', [ProfileController::class, 'update'])->name('update.profile');
    Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');


    Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
    Route::get('/payment/unfinish', [PaymentController::class, 'unfinish'])->name('payment.unfinish');


    // Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

// Route::get('/login', function () {
//     return view('pages.login');
// })->name('login');

// Route::get('/register', function () {
//     return view('pages.register');
// })->name('register');



// Testing
Route::get('/welcome', function() {
    return view('welcome');
});
