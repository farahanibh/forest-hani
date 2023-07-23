<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    public $table = 'species';
    
    protected $fillable = [
        'eng_name',
        'malay_name',
        'family',
    ];
}
