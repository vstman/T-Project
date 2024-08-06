<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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
Route::middleware(['role:1,2'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [PostController::class, 'admin_index'])->name('index');
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{uuid}', [PostController::class, 'update'])->name('posts.update');
        Route::post('/posts', [PostController::class, 'addPost'])->name('posts.addpost');
        Route::post('/upload', [PostController::class, 'upload'])->name('ckeditor.upload');
        Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/details/{uuid}', [PostController::class, 'admin_details'])->name('admin_details');
    });
});


    Route::middleware(['role:1'])->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });

// Post İşlemleri Başlangıç

Route::get('/' , [PostController::class , 'index'])->name('posts.main');
Route::get('/posts' , [PostController::class , 'index'])->name('posts.index');
Route::get('/details/{id}' , [PostController::class , 'details'])->name('posts.details');
Route::get('/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/', [PostController::class, 'index'])->name('posts.main');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/details/{uuid}', [PostController::class, 'details'])->name('posts.details');

// Post İşlemleri Bitiş


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

