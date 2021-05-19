<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes([
    'verify'=>true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile-picture',[\App\Http\Controllers\ProfileController::class,'profilePictureView']);
Route::patch('/edit-profile-picture',[\App\Http\Controllers\ProfileController::class,'editProfilePicture']);
Route::get('/bio-message',[\App\Http\Controllers\ProfileController::class,'bioMessageView']);
Route::patch('/edit-bio-message',[\App\Http\Controllers\ProfileController::class,'editBioMessage']);
Route::get('/change-password',[\App\Http\Controllers\ProfileController::class,'changePasswordView']);
Route::patch('/change-password-action',[\App\Http\Controllers\ProfileController::class,'changePassword']);
