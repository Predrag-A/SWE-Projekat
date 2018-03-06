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

// Routes everyone can access
Route::get('/about', 'PagesController@about')->name('about');

// Routes logged users can't access
Route::group(['middleware' => ['guest']], function() {  
  Route::get('/', 'PagesController@index')->name('index');
});


// Routes guests can't access
Route::group(['middleware' => ['auth']], function() {
  Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');
});

// Authentication routes
Route::get('login', 'PagesController@index')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration routes
Route::get('register', 'PagesController@dashboard')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Auth::routes();