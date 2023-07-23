<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{
    public $table = 'graph';
    
    protected $fillable = [
        'tph',
        'bap',
        'vop',
        'carbon_stock',
        'plot_id',
    ];

    public function plot(){
        return $this->belongsTo('App\Plot', 'plot_id');
    }
}
