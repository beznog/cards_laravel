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

use App\Http\Requests\GetWordsRequest;



class GetWordsService
{
    public static function retrieve(GetWordsRequest $request)
    {
        $validatedData = self::validate($request);
        //dd($validatedData);
        return view('cards');
        //return $validatedData;
    }

    public static function validate(GetWordsRequest $request)
    {
        return $request->validated();
    }
}