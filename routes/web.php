<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

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



Auth::routes([
    'verify'=>true
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile-picture',[ProfileController::class,'profilePictureView']);
Route::patch('/edit-profile-picture',[ProfileController::class,'editProfilePicture']);
Route::get('/bio-message',[ProfileController::class,'bioMessageView']);
Route::patch('/edit-bio-message',[ProfileController::class,'editBioMessage']);
Route::get('/change-password',[ProfileController::class,'changePasswordView']);
Route::patch('/change-password-action',[ProfileController::class,'changePassword']);
Route::get('/profile-status',[ProfileController::class,'displayProfileStatusView']);
Route::patch('/profile-status-action',[ProfileController::class,'editProfileStatus']);
Route::get('/',[ProfileController::class,'userPaginatedData']);
Route::get('/username/{id}',[ProfileController::class,'publicProfileDisplay']);
