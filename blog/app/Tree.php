<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tree;
use App\Plot;
use App\Species;

class Tree extends Model
{
    public $table = 'tree';
    
    protected $fillable = [
        'dbh',
        'scalling_factor',
        'wood_density',

        'size_nest',
        'scalling_factor2',
        'biomass',
        'biomass2',
        'volume',
        'volume2',
        'basal_area',
        'basal_area2',
        'density_tree',
        
        'species_id',
        'plot_id',
    ];

    public function species(){
        //return $this->belongsTo(Species::class);
        return $this->belongsTo('App\Species', 'species_id');
    }

    public function plot(){
        //return $this->belongsTo(Plot::class);
        return $this->belongsTo('App\Plot', 'plot_id');
    }

    public function graph()
    {
        return $this->hasOne(Graph::class, 'plot_id', 'plot_id');
    }
}
