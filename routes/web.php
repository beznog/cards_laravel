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
Route::get('/lingvo-test', function () {
    return LingvoAPI::get_full_words("tisc", 1031, 1049, 10, LingvoAPI::get_token());
});

Route::get('/google-search-test', function () {
    return GoogleSearchAPI::getPictures("tisch", 4, GoogleSearchAPI::$serverKey, GoogleSearchAPI::$searchId);
});