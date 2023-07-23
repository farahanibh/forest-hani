<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Calculation;
use App\Tree;

class Calculation extends Model
{
    public $table = 'calculation';
    
    protected $fillable = [
        'size_nest',
        'scalling_factor2',
        'biomass',
        'biomass2',
        'volume',
        'volume2',
        'basal_area',
        'basal_area2',
        'density_tree',
        'tree_id'
    ];

    public function tree(){
        return $this->belongsTo(Tree::class);
    }
}
