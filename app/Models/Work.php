<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'start_work',
        'end_work',
    ];

    public function rests(){
        return $this->hasMany('App\Models\Rest');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}

