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

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;



class GetWordsService
{
    public static function retrieve(GetWordsRequest $request)
    {

        $validatedData = self::validate($request);
        $limit = (!empty($validatedData['limit'])) ? $validatedData['limit'] : 10;
        $offset = (!empty($validatedData['offset'])) ? $validatedData['offset'] : 0;

        if(!empty($collections = $validatedData['collections'])) {

            $collectionsIds = Collections::with('words')->whereIn('collection', $collections)->pluck('id')->all();
            
            $words = Words::whereHas('collections', function (Builder $query) use ($collectionsIds) {
                $query->whereIn('collection_id', $collectionsIds);
            })->skip($offset)->take($limit)->get();
        }
        else {
            $words = Words::all()->take($limit);
        }

        
        $cards = self::formatWordsToCards($words);
        
        return view('cards', compact('cards'));
    }

    public static function formatWordsToCards(Collection $words)
    {
        $cards = collect([]);
        $words->each(function ($item, $key) use ($words, $cards) {
            $cards->push([
                'id' => $item->id,
                'morpheme' => (!empty($item->morphemes->morpheme)) ? $item->morphemes->morpheme : null,
                'translate' => (!empty($item->translates->pluck('translate')->all())) ? $item->translates->pluck('translate')->all() : null,
                'wordType' => (!empty($item->wordTypes->word_type)) ? $item->wordTypes->word_type : null,
                'addParams' => (!empty($item->addParams->getAttributes())) ? $item->addParams->getAttributes() : null,
                'collections' => (!empty($item->collections->pluck('collection')->all())) ? $item->collections->pluck('collection')->all() : null,
                'images' => (!empty($item->images->first())) ? array(
                    array(
                        'url' => $item->images->first()['url'],
                        'thumbnail_url' => $item->images->first()['thumbnail_url']
                    )
                ) : null
            ]);
        });
        
        return $cards;
    }

    public static function validate(GetWordsRequest $request)
    {
        return $request->validated();
    }
}