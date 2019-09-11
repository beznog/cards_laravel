<?php 

namespace App\Services;

use Illuminate\Http\Request;

use App\Words;
use App\Morphemes;
use App\Translates;
use App\AddParams;
use App\WordTypes;

use App\Http\Requests\CreateWordRequest;

class CreateWordService
{
	public static function store(CreateWordRequest $request)
    {
        // TODO !!!
    	$validatedData = self::validate($request);
        $duplicateWords = self::getDuplicates($validatedData['morpheme']);
        if (!empty($duplicateWords)) {
            return json_encode($duplicateWords);
        }
        return self::save($validatedData);
    }

    public static function validate(CreateWordRequest $request)
    {
    	return $request->validated();
    }

    public static function getDuplicates($morpheme)
    {
        // TODO !!!!!!
        $morpheme = Morphemes::find($morpheme);
        if (!empty($morpheme)) {
            $duplicateWords = $morpheme->words;
            //dd($duplicateWords);
            $duplicateWordsInTextForm = array();
            foreach ($duplicateWords as $duplicateWord) {
                // TODO !!!
                array_push($duplicateWordsInTextForm, $duplicateWord->getInTextForm());
            }
            return $duplicateWordsInTextForm;
        }
        return [];
    }


    public static function save($params) {
        // TODO !!!!
        $word = new Words();

        if (!empty($params['morpheme'])) {
            $morpheme = Morphemes::add($params);
            $morpheme->words()->save($word);
        }

        if (!empty($params['translate'])) {
            $translate = Translates::add($params);
        }
        
        if (!empty($params['morpheme']) && !empty($params['translate'])) {
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