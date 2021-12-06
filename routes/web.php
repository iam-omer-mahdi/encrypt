<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

// Login Page
Route::get('/', function () { return view('auth.login'); })->middleware(['guest']);
// Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->middleware('guest')->name('password.request');
// Auth Routes
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    // Home Page
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Memberships
    Route::resource('membership', HomeController::class);
    // Users
    Route::resource('users', UserController::class);
    // Change Password
    Route::get('users/{id}/pass', [UserController::class, 'changePass'])->name('changePass');
    Route::patch('users/{id}/pass', [UserController::class, 'updatePass'])->name('updatePass');
});
