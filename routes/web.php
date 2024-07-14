<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/', [PostController::class, 'admin_index'])->name('index')->middleware('auth');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');
    Route::post('/posts', [PostController::class, 'addPost'])->name('posts.addpost');
    Route::post('/upload', [PostController::class, 'upload'])->name('ckeditor.upload');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
    Route::get('/details/{id}', [PostController::class, 'admin_details'])->name('admin_details')->middleware('auth');
});

// Auth Başlangıç
Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::get('/register', [AuthManager::class, 'registration'])->name('register');
Route::post('/register', [AuthManager::class, 'registrationPost'])->name('register.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
// Auth Bitiş


// Post İşlemleri Başlangıç
<<<<<<< HEAD
Route::get('/' , [PostController::class , 'index'])->name('posts.main');
Route::get('/posts' , [PostController::class , 'index'])->name('posts.index');
Route::get('/details/{id}' , [PostController::class , 'details'])->name('posts.details');
Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
=======
Route::get('/', [PostController::class, 'index'])->name('posts.main');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/details/{id}', [PostController::class, 'details'])->name('posts.details');
>>>>>>> f00d9a913db9d357122496df229a1bb617940d85
// Post İşlemleri Bitiş
