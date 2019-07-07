<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Words;
use App\Translates;
use App\AddParams;
use App\WordTypes;

class WordsController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function add()
    {
        $params = Input::all();
        $word = Words::add($params);
        $translate = Translates::add($params);
        $word->translates()->save($translate);
        $addParams = new AddParams($params);
        $word->addParams()->save($addParams);
        $wordType = WordTypes::where('word_type', $params['word_type'])->first();
        $wordType->words()->save($word);
        
        //$wordType->words()->save();
        //dd($word);
        return $word;
    }

    public function list()
    {
        $words = Words::get();
        return view('list', compact('words'));
    }

        public function translate($word)
    {
        $word = Words::where('word', $word)->get()->first();
        $translates = $word->translates;
        dd($translates);
        //return view('list', compact('words'));
    }
    
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
}
