<?php

use App\Http\Controllers\LearnHttpController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\NoticesController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Notifications\mailNotification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('home');
});
Route::get('/locale/{lang}',[LocaleController::class,'setLocale']);

//send-simple notice all user with laravel notifiaction
Route::get('/send-notice',function (){
    //get all users
    $users = User::all();
    //simple notice
    $notice = [
        'title' => 'simple notice',
        'message' => 'this is simple notice',
    ];
    //send notice to all users
    foreach ($users as $user) {
        Notification::send($user,new mailNotification($notice));
    }

    dd('done');
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

    /**
     * LearnLocalizationController
     */


});

require __DIR__.'/auth.php';
