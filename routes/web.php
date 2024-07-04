<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthManager;
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
         ->name('index')->middleware('auth');

    Route::get('/posts/create', [PostController::class, 'create'])
         ->name('posts.create')->middleware('auth');
});


Route::get('/login', [AuthManager::class , 'login'])->name('login');
Route::post('/login', [AuthManager::class , 'loginPost'])->name('login.post');
Route::post('/logout', [AuthManager::class , 'logout'])->name('logout');
Route::get('/register', [AuthManager::class , 'registration'])->name('register');
Route::post('/register', [AuthManager::class , 'registrationPost'])->name('register.post');
Route::get('/logout', [AuthManager::class , 'logout'])->name('logout');


//Route::get('/', function () {   return view('projectPanel.layout.app'); });
Route::get('/' , [PostController::class , 'index'])->name('posts_main');
Route::get('/posts' , [PostController::class , 'index'])->name('posts_index');
Route::post('/posts' , [PostController::class , 'addPost'])->name('posts_addpost');
Route::post('/upload' , [PostController::class , 'upload'])->name('ckeditor.upload');



