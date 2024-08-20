<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Sample Url for learning
// Route::get('/profile', [ProfileController::class, 'index']);


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


Route::resource('users', UserController::class)->only(['show', 'edit', 'update'])->middleware('auth'); 

Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');


Route::get('/terms', function () {
    return view('terms');
});
