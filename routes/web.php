<?php

use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Sample Url for learning
// Route::get('/profile', [ProfileController::class, 'index']);


// Root Url 
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/idea', [IdeaController::class, 'store']) ->name('idea.create');

Route::get('/terms', function() {
  return view('terms');
});