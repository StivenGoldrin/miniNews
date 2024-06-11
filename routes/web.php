<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\URL;

//This line redirects any requests to the root URL / to /articles.
Route::redirect('/', '/articles');
//This creates resourceful routes for the PostController. 
//It includes all standard routes for a resource 
//(index, create, store, show, edit, update, destroy).
Route::resource('articles', PostController::class);
//This forces all generated URLs to use the HTTPS scheme.
URL::forceScheme('https');

//This defines a route for /dashboard that returns the dashboard view, 
//but only if the user is authenticated and their email is verified.
Route::get('/dashboard', function () {
    return view('dashboard');
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
