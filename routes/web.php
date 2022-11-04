<?php

use App\Http\Controllers\Comment\DeleteCommentController;
use App\Http\Controllers\Comment\StoreCommentController;
use App\Http\Controllers\Post\ShowPostController;
use App\Http\Controllers\Post\StorePostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TimelineController;
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
Route::get('/test', function () {
    return view('test');
});

Route::get('/dashboard', TimelineController::class)->middleware(['auth', 'verified'])->name('dashboard');
Route::post('post', StorePostController::class)->name('post.store');
Route::get('post/{post}', ShowPostController::class)->name('post.show');
Route::post('post/{post}/comment', StoreCommentController::class)->name('comment.store');
Route::delete('post/{post}/comment/{comment}', DeleteCommentController::class)->name('comment.destroy');

require __DIR__.'/auth.php';
