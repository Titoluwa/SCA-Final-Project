<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

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
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [PostController::class, 'dashboard'])->name('dashboard')->middleware(['auth']);

Route::get('tags', [TagController::class, 'index'])->name('tags')->middleware(['auth']);
Route::post('tag/store', [TagController::class, 'store'])->name('tag.store')->middleware(['auth']);
Route::delete('tag/delete/{$id}', [TagController::class, 'destroy'])->name('tag.delete')->middleware(['auth']);

Route::get('categories', [CategoryController::class, 'index'])->name('categories')->middleware(['auth']);
Route::get('category/{id}', [CategoryController::class, 'show'])->name('category.show')->middleware(['auth']);
Route::post('category/store', [CategoryController::class, 'store'])->name('category.store')->middleware(['auth']);
Route::delete('category/delete/{$id}', [CategoryController::class, 'destroy'])->middleware(['auth']);

Route::get('posts', [PostController::class, 'index'])->name('posts')->middleware(['auth']);
Route::get('post/create', [PostController::class, 'create'])->name('post.create')->middleware(['auth']);
Route::get('post/{id}', [PostController::class, 'show'])->name('post.show')->middleware(['auth']);
Route::post('post/store', [PostController::class, 'store'])->name('post.store')->middleware(['auth']);

Route::post('comment/store', [CommentController::class, 'store'])->name('comment.store')->middleware(['auth']);
