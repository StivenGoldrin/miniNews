<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\UserController;

//This line redirects any requests to the root URL / to /articles.
Route::redirect('/', '/articles');
//This creates resourceful routes for the PostController. 
//It includes all standard routes for a resource 
//(index, create, store, show, edit, update, destroy).
Route::resource('articles', PostController::class);
//This forces all generated URLs to use the HTTPS scheme.
URL::forceScheme('https');

// This redirects /dashboard to /articles if the user is authenticated 
//and their email is verified.
Route::get('/dashboard', function () {
    return redirect()->route('articles.index');
})->middleware(['auth', 'verified'])->name('dashboard');

//This defines a group of routes that require the user to be authenticated.
Route::middleware('auth')->group(function () {
    //This defines a route to edit the user's profile.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //This defines a route to update the user's profile.
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //This defines a route to delete the user's profile.
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//This includes the routes defined in the auth.php file, 
//which typically contains the authentication routes provided 
//by Laravel's authentication scaffolding.
require __DIR__.'/auth.php';

//Route for the download functionality
Route::get('articles/{id}/download', [PostController::class, 'downloadPDF'])->name('articles.download');

// This ensures that resourceful routes for the PostController are only available to authenticated users.
Route::middleware('auth')->group(function () {
    Route::resource('articles', PostController::class)->except(['index', 'show']);
});

//Routes for viewing, editing, and deleting users
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::post('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
