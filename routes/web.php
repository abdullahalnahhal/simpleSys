<?php

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
    return view('index');
});

Route::get('/login', function () {
    return view('index');
})->name('login');

Route::post('/login','UsersController@login')->name('login.submit');

Route::middleware(['web', 'auth'])->get('/index', 'HomeController@index')->name('home');
