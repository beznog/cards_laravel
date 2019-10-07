<?php 

namespace App\Services;

use App\Words;


class DeleteWordService
{
    public static function softDelete($wordId)
    {
        //$word = Words::where('id', $wordId)->get()->first()->delete();
        Words::find($wordId)->delete();
        return ['result' => 'successfull'];
    }
}