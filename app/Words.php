<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Words extends Model
{
	protected $table = 'words';
    protected $fillable = ['word'];

    public static function addWord($params) {
        $result = self::firstOrCreate(array('word' => $params['word']));

        if (!$result->wasRecentlyCreated) {
            $duplicates = self::getDuplicates($params['word']);
            return [
                'result' => 'cancelled',
                'duplicates' => $duplicates
            ];
        }
        else {
            return ['result' => 'success'];
        }
    }

    public static function getDuplicates($word) {
        return self::where('word', $word)->take(10)->get();
    }

    public function translates() {
        return $this->belongsToMany('App\Translates', 'words_translates', 'word_id', 'translate_id');
    }
}