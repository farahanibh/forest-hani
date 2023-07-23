<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Graph;

class Plot extends Model
{
    public $table = 'plot';
    
    protected $fillable = [
        'team_leader',
        'record_by',
        'date_record',
        'start_time',
        'end_time',
        'total_team',
        'plot_name',
        'location',
        'latitude',
        'longitude',
        'avg_slope',
        'strata_type',
        'gps_accuracy',
        'resam',
        'typography',
        'elevation',
    ];
    
   
}
