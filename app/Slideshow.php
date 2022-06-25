<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    protected $table = "slideshows";
    protected $fillable = [
        'foto',
        'caption_title',
        'caption_content',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
