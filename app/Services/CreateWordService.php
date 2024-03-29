<?php 

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Words;
use App\Morphemes;
use App\Translates;
use App\AddParams;
use App\WordTypes;
use App\Images;
use App\Collections;

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
        
        if (!empty($params['collections'])) {
            $collectionsToSync = array();
            foreach($params['collections'] as $key => &$value) {
                $collection = Collections::add($value);
                $collectionsToSync = Arr::add($collectionsToSync, $key, $collection->id);
            }
            $word->collections()->sync($collectionsToSync);
        }

        if (!empty($params['picture'])) {
            $picture = Images::add(json_decode($params['picture']));
            $word->images()->sync($picture->id);
        }

        return ['result' => 'successfull'];
    }
}