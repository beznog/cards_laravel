<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Words extends Model
{
	protected $table = 'words';
    protected $fillable = ['word'];

    public static function add($params) {
        return self::firstOrCreate(array('word' => $params['word']));
    }

    public static function getDuplicates($word) {
        return self::where('word', $word)->take(10)->get();
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