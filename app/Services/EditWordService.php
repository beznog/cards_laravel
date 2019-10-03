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
use App\Helpers\APIHelpers\GoogleSearchAPI;

use App\Http\Requests\CreateWordRequest;



class EditWordService
{
    public static function edit(CreateWordRequest $request)
    {
        $validatedData = self::validate($request);
        return self::save($validatedData);
    }

    public static function getWordToFillForm($wordId)
    {
        $word = Words::where('id', $wordId)->get()->first()->getInTextForm();
        //$illustrations = self::getPicturesToWord($word['morpheme']);
        //$illustrations = Arr::where($illustrations, function ($value, $key) use ($word) {
        //    return $word['images'][0]['url']!=$value['url'];
        //});
        //$word['images'] = array_merge($word['images'], $illustrations);
        return $word;
    }

    public static function getPicturesToWord($word)
    {
        return GoogleSearchAPI::getPictures($word, 4, GoogleSearchAPI::$serverKey, GoogleSearchAPI::$searchId)['content']['images'];
    }

    public static function validate(CreateWordRequest $request)
    {
        return $request->validated();
    }

    public static function save($params)
    {
        
        $word = Words::where('id', $params['word_id'])->get()->first();

        $morpheme = $word->morphemes;
        $morpheme->update(['morpheme' => $params['morpheme']]);

        $paramsTranslates = explode(',', $params['translate']);
        $paramsTranslates = array_map('trim', $paramsTranslates);
        $paramsTranslates = collect($paramsTranslates)->unique();
        
        $word->translates->each(function($value, $key) use ($paramsTranslates, $params, $word){
            $keyToDel = $paramsTranslates->search($value['translate']);
            
            if(is_numeric($keyToDel)) {
                $paramsTranslates->forget($keyToDel);
            }
            else {
                $translateToDetach = $word->translates()->where('translate_id', $value['id'])->first();
                $word->translates()->detach($translateToDetach);
            }
        });

        $paramsTranslates->each(function($value, $key) use ($word) {
            $translate = Translates::add(['translate' => $value]);
            $word->translates()->save($translate);
        });

        if(empty($params['reflexive'])) {
            $params['reflexive'] = 0;
        }
        
        $addParams = $word->addParams()->first();
        $addParams->update($params);


        $wordType = WordTypes::where('word_type', $params['word_type'])->first();
        $wordType->words()->save($word);

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
            $picture->words()->save($word);
        }

        return ['result' => 'successfull'];
    }

}