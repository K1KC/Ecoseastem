<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

Route::middleware([App\Http\Middleware\SetLocale::class])->group(function() {{
    Auth::routes();
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    Route::get('/locale/{lang}', [LocaleController::class, 'setLocale'])->name('lang.switch');
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
    
        Route::get('/buy-merch/{merch_id}', [MerchandiseController::class, 'checkoutPage'])->name('buy.merch');
    
        // Route::post('/update-quantity', [MerchandiseController::class, 'updateQuantity'])->name('update.quantity');
        // Route::post('/confirm-order', [TransactionController::class])
        
        Route::get('/upload', function() {
            return view('pages.upload');
        })->name('upload.articles');
    
        Route::post('/article/upload', [ArticleController::class, 'store'])->name('article.store');
    
        Route::get('/transaction-history', [TransactionController::class, 'showHistory'])->name('transactions.history');
        Route::post('/send-receipt/{transactionId}', [TransactionController::class, 'getAndSendReceipt'])->name('send.receipt');
    
        Route::get('/profile', [ProfileController::class, 'viewProfile'])->name('profile');
        Route::post('/update-profile', [ProfileController::class, 'update'])->name('update.profile');
        Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
        Route::post('/payment/callback', [TransactionController::class, 'notification']);
    
    
        Route::post('/payment/notification', [TransactionController::class, 'notification'])->name('payment.notification');
        Route::get('/payment/success', [TransactionController::class, 'success'])->name('payment.success');
        Route::get('/payment/failed', [TransactionController::class, 'failed'])->name('payment.failed');
        Route::get('/payment/unfinish', [TransactionController::class, 'unfinish'])->name('payment.unfinish');
    
    });
    
    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::get('/upload-merch', function() {
            return view('pages.upload-merch');
        })->name('upload.merch');
    
        Route::post('/merch/upload', [MerchandiseController::class, 'store'])->name('merch.store');
    });
}});




// Testing
Route::get('/welcome', function() {
    return view('welcome');
});
