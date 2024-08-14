<?php

use App\Http\Controllers\LearnHttpController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NoticesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('home');
});
Route::get('/locale/{lang}',[LocaleController::class,'setLocale']);



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

    /**
     * LearnLocalizationController
     */


});

require __DIR__.'/auth.php';
