<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Morphemes extends Model
{
	protected $table = 'morphemes';
    protected $fillable = ['morpheme'];

    public static function get($morpheme) {
        return self::where('morpheme', $morpheme)->take(10)->first();
    }

    public static function add($params) {
        return self::firstOrCreate(array('morpheme' => $params['morpheme']));
    }

    public function words() {
        return $this->hasOne('App\Words', 'morpheme_id');
    }
}
