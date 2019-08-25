<?php 

namespace App\Services;

use Illuminate\Http\Request;

use App\Words;
use App\Translates;
use App\AddParams;
use App\WordTypes;

use App\Http\Requests\CreateWordRequest;

class CreateWordService
{
	public static function store(CreateWordRequest $request)
    {
    	$validatedData = self::validate($request);
        //dd($validatedData);
        $duplicateWords = self::getDuplicates($validatedData['word']);
        if (!empty($duplicateWords)) {
            dd($duplicateWords);
        }
        return self::save($validatedData);
    }

    public static function validate(CreateWordRequest $request)
    {
    	return $request->validated();
    }

    public static function getDuplicates($morpheme)
    {
        $duplicateMorphemes = Words::getDuplicates($morpheme);
        $duplicateWords = array();
        foreach ($duplicateMorphemes as $duplicateMorpheme) {
            array_push($duplicateWords, self::getFullWord($duplicateMorpheme));
        }
        return $duplicateWords;
    }

    public static function getFullWord(Words $morpheme)
    {
        $word = array();
        $word['word'] = $morpheme->word;
        $word['translate'] = $morpheme->translates;
        $word['addParams'] = $morpheme->addParams;
        $word['wordType'] = $morpheme->wordTypes;
        return $word;
    }

    public static function save($params) {
        if (!empty($params['word'])) {
            $word = Words::add($params);
        }

        if (!empty($params['translate'])) {
            $translate = Translates::add($params);
        }
        
        if (!empty($params['word']) && !empty($params['translate'])) {
            $word->translates()->save($translate);
            $addParams = new AddParams($params);
            $word->addParams()->save($addParams);
        }

        if (!empty($params['word_type'])) {
            $wordType = WordTypes::where('word_type', $params['word_type'])->first();
            $wordType->words()->save($word);
        }

        return ['result' => 'successfull'];
    }
}