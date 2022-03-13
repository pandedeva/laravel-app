<?php

use App\Http\Controllers\AdminCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardPostController;

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
    return view('home', [
      "title" => "Home"
    ]);
});

Route::get('/about', function () {
    return view('about', [ //menggunakan closure
      "title" => "About",
      "name" => "Pande Deva",
      "email" => "devapande22@gmail.com",
      "image" => "profile.jpeg"
    ]);
});

// halaman all posts
Route::get('/posts', [PostController::class, 'index']); // menggunakan controller

// halaman single post
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

// halaman category
Route::get('/categories', [CategoriesController::class, 'index']);

// halaman login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// halaman register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// kalau ada request ke halaman register yang methodnya post, maka panggil controller yang methodnya store
Route::post('/register', [RegisterController::class, 'store']);

// halaman dashboard
Route::get('/dashboard', function() {
  return view('dashboard.index', [
    "title" => "Dashboard"
  ]);
})->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
// untuk CRUD dan halaman my posts
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('users');

// untuk CRUD dan halaman dashboard/categories
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');