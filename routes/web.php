<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminCategoryController;
use Illuminate\Support\Facades\URL;

Route::redirect('/', '/articles');
Route::resource('articles', ArticleController::class);
URL::forceScheme('https');

Route::get('/categories', [AdminCategoryController::class, 'index']);
Route::post('/categories', [AdminCategoryController::class, 'store']);
Route::get('/articles/{category}', [ArticleController::class, 'index']);
