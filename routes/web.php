<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookmarkController;

Route::get('/', function () {
    return view('pages.landing');
});

Route::post('/bookmark', [BookmarkController::class, 'bookmark'])->name('bookmark');