<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
	protected $table = 'images';
    protected $fillable = ['url', 'thumbnail_url'];

    public static function add($params) {
        return self::firstOrCreate(array('url' => $params->url, 'thumbnail_url' => $params->thumbnail_url));
    }

     public function words() {
        return $this->belongsToMany('App\Words', 'words_images', 'image_id', 'word_id');
    }
}
