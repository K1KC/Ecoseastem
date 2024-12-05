<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookmarkController;

Route::get('/', function () {
    return view('pages.landing');
});

Route::post('/bookmark', [BookmarkController::class, 'add_bookmark'])->name('add.bookmark');