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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\PostController::class, 'index']);
Route::get('/create/Post', [App\Http\Controllers\PostController::class, 'create'])->middleware('auth')->name('post.create');
Route::post('/post/store', [App\Http\Controllers\PostController::class, 'store'])->middleware('auth')->name('post.store');
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');

Route::get('/post/edit/{post}', [App\Http\Controllers\PostController::class, 'edit'])->middleware('can:edit,post')->name('post.edit');
Route::patch('/post/update/{post}', [App\Http\Controllers\PostController::class, 'update'])->middleware('can:edit,post')->name('post.update');


Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->middleware('auth')->name('comment.store');
Route::post('/comment/replay', [App\Http\Controllers\CommentController::class, 'replyStore'])->middleware('auth')->name('comment.replay');

Route::delete('/comment/delete/{id}', [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');

//admin route
Route::middleware('admin')->group(function(){
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/post/{id}/delete', [App\Http\Controllers\AdminController::class, 'delete'])->name('admin.post.delete');
    Route::post('/admin/post/{id}/restore', [App\Http\Controllers\AdminController::class, 'restore'])->name('admin.post.restore');
});


