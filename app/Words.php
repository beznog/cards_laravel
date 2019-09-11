<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Words extends Model
{
	protected $table = 'words';

    public function getInTextForm()
    {
        return [
            'id' => $this->id,
            'morpheme' => $this->morphemes->morpheme,
            'translate' => $this->translates->pluck('translate')->all(),
            'wordType' => $this->wordTypes->word_type,
            'addParams' => $this->addParams->attributes
        ];
    }

    public function morphemes() {
        return $this->belongsTo('App\Morphemes', 'morpheme_id');
    }

    public function translates() {
        return $this->belongsToMany('App\Translates', 'words_translates', 'word_id', 'translate_id');
    }

    public function addParams() {
        return $this->hasOne('App\AddParams', 'word_id');
    }

    public function wordTypes() {
        return $this->belongsTo('App\WordTypes', 'word_type_id');
    }
}