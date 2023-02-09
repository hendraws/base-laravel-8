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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

Route::get('/', function () {
    return view('layouts.master');
});

Route::get('/refresh', function () {
    \Artisan::call('optimize:clear');
    return redirect('/');
});

Route::resource('/management-users', 'UserController');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
