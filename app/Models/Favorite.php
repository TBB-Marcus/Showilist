<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';

    protected $fillable = [
        'user_id',
        'show_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
