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

Route::get('', 'WordsController@index');
Route::get('list', 'WordsController@list');

Route::get('add', 'WordsController@index');
Route::post('add',
    [
        'before' => 'csrf',
        'uses' => 'WordsController@store'
    ]
);

Route::get('edit/{wordId}', 'WordsController@autocompleteEditForm');
Route::post('edit/{wordId}', 'WordsController@edit');

Route::get('delete/{wordId}', 'WordsController@delete');

Route::get('api_services/lingvo/get_full_words/{word}', function ($word) {
    return LingvoAPI::getFullWords($word, 1031, 1049, 10, LingvoAPI::getToken());
});

Route::get('api_services/lingvo/get_word_card/{word}', function ($word) {
    return LingvoAPI::getWordCard($word, 1031, LingvoAPI::getToken());
});

Route::get('api_services/google_search/get_pictures/{word}', function ($word) {
    return GoogleSearchAPI::getPictures($word, 4, GoogleSearchAPI::$serverKey, GoogleSearchAPI::$searchId);
});

Route::get('get_all_collections', 'WordsController@getAllCollections');

Route::get('get_words', 'WordsController@getWordsByCollections');
// http://localhost:8000/get_words?collections[]=möbel&collections[]=wohnung&limit=20&offset=2