<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\AdminController;

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
Route::get('/panel/profile/profile-picture',[ProfileController::class,'profilePictureView']);
Route::patch('/panel/profile/edit-profile-picture',[ProfileController::class,'editProfilePicture']);
Route::get('/panel/profile/bio-message',[ProfileController::class,'bioMessageView']);
Route::patch('/panel/profile/edit-bio-message',[ProfileController::class,'editBioMessage']);
Route::get('/panel/profile/change-password',[ProfileController::class,'changePasswordView']);
Route::patch('/panel/profile/change-password-action',[ProfileController::class,'changePassword']);
Route::get('/panel/profile/profile-status',[ProfileController::class,'displayProfileStatusView']);
Route::patch('/panel/profile/profile-status-action',[ProfileController::class,'editProfileStatus']);
Route::get('/panel/home/following-you',[FollowController::class,'allUsersFollowing']);
Route::get('/panel/home/users-you-follow',[FollowController::class,'allUsersFollowed']);
Route::get('/panel/home/username/{id}',[ProfileController::class,'privateProfileDisplay']);
Route::get('/',[ProfileController::class,'userPaginatedData']);
Route::get('/username/{id}',[ProfileController::class,'publicProfileDisplay']);
Route::post('/follow-user',[FollowController::class,'followUser']);
Route::delete('/unfollow-user/{id}',[FollowController::class, 'unFollowUser']);
Route::get('/admin/users',[AdminController::class, 'userList']);
Route::resource('admin',AdminController::class);



