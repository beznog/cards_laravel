<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Words;
use App\Morphemes;
use App\Translates;
use App\AddParams;
use App\WordTypes;



use App\Services\CreateWordService;
use App\Services\EditWordService;

use App\Http\Requests\CreateWordRequest;

class WordsController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function list()
    {
        //$words = Words::get();
        //$morphemes = Morphemes::get();
        $words = Words::with('morphemes', 'translates', 'wordTypes', 'addParams')->get();
        //dd($words);
        return view('list', compact('words'));
    }
    /*
    public function translate($word)
    {
        $word = Words::where('word', $word)->get()->first();
        $translates = $word->translates;
        dd($translates);
        return view('list', compact('words'));
    }
    */
    /*
    public function addTranslate($word, $translate)
    {
        $word = Words::where('word', $word)->get()->first();

        $translate = new Translates(['translate' => $translate]);


        $word->translates()->save($translate);

        //$word->translates()->Translates::firstOrCreate(array('translate' => $translate));
        //$translates = $word->translates;
        //dd($translates);
        //return view('list', compact('words'));
    }
    */

    public function store(CreateWordRequest $request)
    {
        return CreateWordService::store($request);
    }

    public function autocompleteEditForm($wordId)
    {
        $word = EditWordService::getWordToFillForm($wordId);
        //$pictures = EditWordService::getPicturesToWord($word->morphemes['morpheme']);
        return view('edit', compact('word'));
    }

    public function edit(CreateWordRequest $request) {
        return EditWordService::edit($request);
    }
}
