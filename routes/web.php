<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/news/{id}', [FrontController::class, 'showSingleNews'])->name('home.news');

Auth::routes(['reset' => false, 'confirm' => false]);


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
  Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
  Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
  ]);
  Route::resource('news', NewsController::class)->except(['show']);

  Route::get('/reset-password', [UserController::class, 'resetPassword'])->name('reset.password');
  Route::put('/reset-password', [UserController::class, 'resetPasswordPost'])->name('post.reset.password');
});


