<?php

use App\Http\Controllers\dashboardcontroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Root Url 
Route::get('/', [DashboardController::class, 'index']);

// Sample Url for learning
// Route::get('/profile', [ProfileController::class, 'index']);

Route::get('/terms', function() {
  return view('terms');
});