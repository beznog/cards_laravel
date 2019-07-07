<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddParams extends Model
{
	protected $table = 'add_parameters';
    protected $fillable = ['article_type','plural','reflexive','preposition','modal_verb','regularity','prasens','prateritum','partizip','importance','complexity','knowledge','examples'];

    public static function add($params) {
        return this::save($params);
    }

    public function words() {
        return $this->belongsTo('App\Words');
    }
}