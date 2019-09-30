<?php 

namespace App\Services;

use Illuminate\Http\Request;

use App\Words;
use App\Morphemes;
use App\Translates;
use App\AddParams;
use App\WordTypes;
use App\Helpers\APIHelpers\GoogleSearchAPI;

use App\Http\Requests\CreateWordRequest;

class EditWordService
{
	public static function edit(CreateWordRequest $request)
    {
        
    }

    public static function getWordToFillForm($wordId)
    {
        //return Words::where('id', $wordId)->with('morphemes', 'translates', 'wordTypes', 'addParams', 'images')->get()->first();
        $word = Words::where('id', $wordId)->get()->first();
        $word = $word->getInTextForm();
        //dd($word);
        return $word;
    }

    public static function getPicturesToWord($word)
    {
        return GoogleSearchAPI::getPictures($word, 4, GoogleSearchAPI::$serverKey, GoogleSearchAPI::$searchId);
    }


    public static function validate(CreateWordRequest $request)
    {
    	return $request->validated();
    }

}