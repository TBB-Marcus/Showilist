<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $table = 'shows';

    protected $fillable = [
        'id',
        'show_id',
        'genre_ids',
        'name',
        'rating',
        'original_language',
        'release_date',
        'poster',
        'backdrop'
    ];
}
