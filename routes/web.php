<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\URL;

Route::redirect('/', '/articles');
Route::resource('articles', PostController::class);
URL::forceScheme('https');
