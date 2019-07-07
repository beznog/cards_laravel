<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collections extends Model
{
	protected $table = 'collections';
    protected $fillable = ['name'];

    public static function add($params) {
        return self::firstOrCreate(array('name' => $params['name']));
    }

    public function words() {
        return $this->belongsToMany('App\Collections', 'words_collections', 'word_id', 'collection_id');
    }
}