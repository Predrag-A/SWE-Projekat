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

// Rute za autentifikaciju
Route::get('login', 'PagesController@index')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'PagesController@dashboard')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Rute za bazu
Route::resource('gradovi','CityController');
Route::resource('tereni','CourtController');
Route::resource('dogadjaji','EventController');
Route::resource('sportovi','SportController');
Route::resource('korisnici','UserController');
Route::resource('zahtevi','RequestController');
Route::resource('komentari','CommentController');
Route::resource('pridruzivanje', 'AttendsController');

// Rute za posebne stranice
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/', 'PagesController@index')->name('index');
Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');

Route::get('korisnici', 'UserController@index')->name('korisnici');
Route::get('dogadjaji', 'EventController@index')->name('dogadjaji');

// API rute
Route::get('api/tereni', function(){

  // Vraca sve terena u gradu sa id-jem option
  $input = Illuminate\Support\Facades\Input::get('option');
  $city = App\City::find($input);
  $courts = $city->courts();
  return Response::make($courts->get(['id', 'location']));
});

Route::get('api/sportovi', function(){

  // Vraca sve sportove na terenu sa id-jem option
  $input = Illuminate\Support\Facades\Input::get('option');
  $court = App\Court::find($input);
  
  $sports = $court->sports();
  return Response::make($sports);
});

Route::get('api/test', function(){
  
  return 0;
});

// Rute za Vue komponente (prethodne rute su za laravel)
// preko kojih se uzimaju podaci iz baze
Route::prefix('/web/api')->group(function () {
    Route::get('cities', 'DashboardController@getCities'); //getCities je samo funkcija u kontroleru
});

