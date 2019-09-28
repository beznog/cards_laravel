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

Route::get('/', 'WordsController@index');
Route::get('/list', 'WordsController@list');
Route::get('/add', 'WordsController@store');
Route::get('/edit/{word}', 'WordsController@edit');
//Route::get('/translate/{word}','WordsController@translate');
//Route::get('/add_translate/{word}/{translate}','WordsController@addTranslate');

Route::get('api_services/lingvo/get_full_words/{word}', function ($word) {
    return LingvoAPI::getFullWords($word, 1031, 1049, 10, LingvoAPI::getToken());
});

Route::get('api_services/google_search/{word}', function ($word) {
    return GoogleSearchAPI::getPictures($word, 4, GoogleSearchAPI::$serverKey, GoogleSearchAPI::$searchId);
});