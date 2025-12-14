<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LandingController;


Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');

Route::get('/news/category/{slug}', [NewsController::class, 'category'])->name('news.category');

Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');