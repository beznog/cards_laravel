<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collections extends Model
{
	protected $table = 'collections';
    protected $fillable = ['collection'];

    public static function add($params) {
        return self::firstOrCreate(array('collection' => $params));
    }

    public function words() {
        return $this->belongsToMany('App\Words', 'words_collections', 'collection_id', 'word_id');
    }
}