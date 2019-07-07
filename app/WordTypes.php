<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WordTypes extends Model
{
	protected $table = 'word_types';
    protected $fillable = ['word_type'];

    public function words() {
        return $this->hasOne('App\Words', 'word_type_id');
    }
}
