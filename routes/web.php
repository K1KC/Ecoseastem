<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/articles', [ArticleController::class, 'articlesPage'])->name('articles');

Route::post('/category', [ArticleController::class, 'showArticlePerCategory'])->name('category.articles');

Route::get('/merch', [MerchandiseController::class, 'index'])->name('merch');

Route::middleware(['auth'])->group(function () {
    Route::post('/edit-bookmark', [BookmarkController::class, 'bookmark'])->name('edit.bookmark');

    Route::get('/bookmark', [BookmarkController::class, 'getBookmarkedArticles'])->name('bookmark');

    Route::get('/buy-merch/{merch_id}', [MerchandiseController::class, 'buyMerch'])->name('buy.merch');

    // Route::post('/update-quantity', [MerchandiseController::class, 'updateQuantity'])->name('update.quantity');
    // Route::post('/confirm-order', [TransactionController::class])
    
    Route::get('/profile/{current_username}', [ProfileController::class, 'viewProfile'])->name('profile');
    Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.update.picture');
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

Route::get('/about-us', function() {
    return view('pages.about-us');
})->name('about.us');

// Testing
Route::get('/welcome', function() {
    return view('welcome');
});
