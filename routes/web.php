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

Route::get('/', [\App\Http\Controllers\DiscussionsController::class, 'index']);

Auth::routes(['verify' => true]);

//Auth only access routes
Route::resource('discussions', \App\Http\Controllers\DiscussionsController::class);
Route::resource('discussions/{discussion}/replies', \App\Http\Controllers\RepliesController::class);
Route::post('discussions/{discussion}/replies/{reply}/mark-as-best-reply', [\App\Http\Controllers\DiscussionsController::class, 'reply'])->name('discussions.bestReply');
Route::get('/users/notifications', [\App\Http\Controllers\UsersController::class, 'notifications'])->name('users.notifications');
