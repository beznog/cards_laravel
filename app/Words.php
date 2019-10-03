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
            'morpheme' => (!empty($this->morphemes->morpheme)) ? $this->morphemes->morpheme : null,
            'translate' => (!empty($this->translates->pluck('translate')->all())) ? $this->translates->pluck('translate')->all() : null,
            'wordType' => (!empty($this->wordTypes->word_type)) ? $this->wordTypes->word_type : null,
            'addParams' => (!empty($this->addParams->attributes)) ? $this->addParams->attributes : null,
            'collections' => (!empty($this->collections->pluck('collection')->all())) ? $this->collections->pluck('collection')->all() : null,
            'images' => (!empty($this->images->first())) ? array(
                array(
                    'selected' => true,
                    'url' => $this->images->first()['url'],
                    'thumbnail_url' => $this->images->first()['thumbnail_url']
                )
            ) : null
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

    public function images() {
        return $this->belongsToMany('App\Images', 'words_images', 'word_id', 'image_id');
    }

    public function collections() {
        return $this->belongsToMany('App\Collections', 'words_collections', 'word_id', 'collection_id');
    }
}