<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translates extends Model
{

	protected $table = 'translates';
    protected $fillable = ['translate'];

    public function words() {
        return $this->belongsToMany('App\Words', 'words_translates', 'translate_id', 'word_id');
    }
}
