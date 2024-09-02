<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;


// Root Url
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Route::group([ 'prefix'=>'ideas/','as'=>'ideas.' ], function(){

    Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');
    
    Route::group([ 'middleware'=>['auth'] ], function(){

        Route::post('', [IdeaController::class, 'store'])->name('store');

        Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit');
    
        Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');
    
        Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy');
    
        Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
    });

});


//* The 3 route lines below is a refractor version of the ones listed above
// Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show'])->middleware('auth');
// Route::resource('ideas', IdeaController::class)->only(['show']);
// Route::resource('ideas.comments', IdeaController::class)->only(['store'])->middleware('auth');


Route::resource('users', UserController::class)->only('show');
Route::resource('users', UserController::class)->only('edit', 'update')->middleware('auth');

Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->middleware('auth')->name('ideas.like');
Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->middleware('auth')->name('ideas.unlike');

//* Use for 1 purpose only; No need '[ ]' in the controller class
Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');

Route::get('/terms', function() {
    return view('terms');
})->name('terms');
