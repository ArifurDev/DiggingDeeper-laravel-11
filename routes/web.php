<?php

use App\Http\Controllers\LearnHttpController;
use App\Http\Controllers\NoticesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd(in_image("https://vai.placholder.500"));
    return view('welcome');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Notice Controller
     */
    Route::resource('/notices', NoticesController::class);
    /**
     * LearnHttpController
     */
    Route::get('/learn/http', LearnHttpController::class);
});

require __DIR__.'/auth.php';
