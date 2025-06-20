<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['user_id', 'show_id', 'rating'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
