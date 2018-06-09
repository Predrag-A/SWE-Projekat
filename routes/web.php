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
Route::resource('korisnici','UserController');
Route::resource('komentari','CommentController');
Route::resource('pridruzivanje', 'AttendsController');

// Imenovane rute za posebne stranice
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/', 'PagesController@dashboard')->name('index');
Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');
Route::get('/admin_panel', 'PagesController@admin')->name('admin');
Route::get('/notifikacije', 'PagesController@notifications')->name('notifications');

Route::get('korisnici', 'UserController@index')->name('korisnici');
Route::get('dogadjaji', 'EventController@index')->name('dogadjaji');
Route::get('tereni', 'CourtController@index')->name('tereni');
Route::post('/korisnici', 'UserController@search')->name('usersearch');
Route::post('/tereni', 'CourtController@search')->name('courtsearch');

// API rute

Route::get('api/test', function(){
  
  return auth()->user()->courtRating(2);
});

// Prijateljstva
Route::post('api/dodaj_prijatelja', 'FriendsController@add');
Route::post('api/prihvati_prijatelja', 'FriendsController@accept');
Route::post('api/obrisi_prijatelja', 'FriendsController@delete');

// Ocene za teren
Route::post('api/oceniteren', 'GradesCourtController@grade');
Route::post('api/resetujteren', 'GradesCourtController@reset');

// Ocene za korisnika
Route::get('api/osoba_status/{id}', 'GradesUserController@status');
Route::post('api/osoba_like', 'GradesUserController@like');
Route::post('api/osoba_dislike', 'GradesUserController@dislike');
Route::post('api/osoba_cancel', 'GradesUserController@cancel');

// Notifikacije
Route::post('api/notifikacija_read', 'NotificationController@read');
Route::post('api/notifikacija_delete', 'NotificationController@delete');
Route::post('api/broadcast', 'NotificationController@broadcast');

// Zahtevi
Route::post('api/request_answer', 'RequestController@answer');
Route::post('api/request_send', 'RequestController@send')->name('request');

// Dogadjaji
Route::get('api/city_name', 'EventController@cityName');

// Tereni
Route::get('/api/tereni/{id}', 'CityController@courts');
Route::get('/api/sportovi/{id}', 'CourtController@sports');
Route::post('/api/delete_image', 'CourtController@deleteImage');

// Rute za Vue komponente (prethodne rute su za laravel)
// preko kojih se uzimaju podaci iz baze
Route::prefix('/web/api')->group(function () {
    Route::get('usercity', 'DashboardController@getUserCity'); //getUserCity je samo funkcija u kontroleru
    Route::get('cities', 'DashboardController@getCities');
    Route::get('citycourts/{cityid}', 'DashboardController@getCityCourts');
    Route::get('courtEvents/{courtid}', 'DashboardController@getCourtEvents');
    Route::get('sports', 'DashboardController@getSports');
    Route::get('eventAttend/{eventid}' , 'DashboardController@getEventAttends');
});

