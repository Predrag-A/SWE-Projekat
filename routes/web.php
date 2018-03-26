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

// Rute kojima svi imaju pristup
Route::get('/about', 'PagesController@about')->name('about');

// Rute kojima mogu pristupiti samo gosti
Route::group(['middleware' => ['guest']], function() {  
  Route::get('/', 'PagesController@index')->name('index');
});


// Rute kojima mogu pristupiti samo ulogovani korisnici
Route::group(['middleware' => ['auth']], function() {
  Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');
});

// Rute za autentifikaciju
Route::get('login', 'PagesController@index')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'PagesController@dashboard')->name('register');
Route::post('register', 'Auth\RegisterController@register');
