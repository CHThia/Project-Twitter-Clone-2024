<?php

use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Sample Url for learning
// Route::get('/profile', [ProfileController::class, 'index']);


// Root Url 
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('ideas.show');

Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.create');

Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy');

Route::get('/terms', function() {
  return view('terms');
});
