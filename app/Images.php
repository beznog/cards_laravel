<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
     public function words() {
        return $this->belongsToMany('App\Words', 'words_images', 'image_id', 'word_id');
    }
}
