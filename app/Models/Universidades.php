<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universidades extends Model
{
    //use HasFactory;

    protected $table = 'universidades';

    //protected $fillable = 'status';

    protected $casts = [
        'alpha_two_code'  => 'array',
        'country' => 'array',
        'domains' => 'array',
        'name' => 'array',
        'state_province' => 'array',
        'web_pages' => 'array',
        ];

        protected $fillable = [
            'status',
        ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function subscription()
    {
        return $this->hasMany(\App\Models\Subscription::class);
    }



}
