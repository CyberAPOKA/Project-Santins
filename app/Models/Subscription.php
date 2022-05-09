<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'universidade_id', 'universidade_name'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function universidades()
    {
        return $this->belongsTo(\App\Models\Universidades::class);
    }


}
