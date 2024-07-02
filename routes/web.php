<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/', [PostController::class, 'index'])
         ->name('admin.index')->middleware('auth');

    Route::get('/posts/create', [PostController::class, 'create'])
         ->name('posts.create')->middleware('auth');
});


Route::get('/', function () {   return view('projectPanel.layout.app'); });
Route::get('/posts' , [PostController::class , 'index'])->name('posts_index');
Route::post('/posts' , [PostController::class , 'addPost'])->name('posts_addpost');
Route::post('/upload' , [PostController::class , 'upload'])->name('ckeditor.upload');


