<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Words;
use App\Morphemes;
use App\Translates;
use App\AddParams;
use App\WordTypes;
use App\Collections;

use App\Services\CreateWordService;
use App\Services\EditWordService;
use App\Services\DeleteWordService;
use App\Services\GetWordsService;

use App\Http\Requests\CreateWordRequest;
use App\Http\Requests\GetWordsRequest;

use Illuminate\Database\Eloquent\Builder;

class WordsController extends Controller
{
    public function index()
    {
        return view('add');
    }

    public function list()
    {
        $words = Words::with('morphemes', 'translates', 'wordTypes', 'addParams', 'collections', 'images')->get();
        return view('list', compact('words'));
    }

    public function store(CreateWordRequest $request)
    {
        return CreateWordService::store($request);
    }

    public function autocompleteEditForm($wordId)
    {
        $word = EditWordService::getWordToFillForm($wordId);
        return view('edit', compact('word'));
    }

    public function edit(CreateWordRequest $request) {
        return EditWordService::edit($request);
    }

    public function delete($wordId) {
        return DeleteWordService::softDelete($wordId);
    }

    public function getAllCollections() {
        return EditWordService::getCollections();
    }

    public function getWordsByCollections(GetWordsRequest $request) {
        return GetWordsService::retrieve($request);

        //dump($request);
        //$request->validated();


        //$collectionsIds = Collections::with('words')->whereIn('collection', ['wohnung', 'möbel'])->pluck('id')->all();

        //$words = Words::whereHas('collections', function (Builder $query) use ($collectionsIds) {
        //    $query->whereIn('collection_id', $collectionsIds);
        //})->skip(2)->take(5)->get();

        //return $words;
    }
}