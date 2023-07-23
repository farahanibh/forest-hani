<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Graph;
use DB;

class VopController extends Controller
{
    public function index()
    {
        //vop according to location and date record
        $data = DB::table('graph')
            ->join('plot', 'plot.id', '=', 'graph.plot_id')
            ->select('vop', 'plot_name', 'location', 'date_record')
            ->orderBy('location')
            ->orderBy('date_record')
            ->get();
        
        $datasets = [];
        foreach ($data as $record) {
            $location = $record->location;
            $dateRecord = $record->date_record;
            
            if (!array_key_exists($location, $datasets)) {
                $datasets[$location] = [];
            }
            
            if (!array_key_exists($dateRecord, $datasets[$location])) {
                $datasets[$location][$dateRecord] = [];
            }
            
            $datasets[$location][$dateRecord][] = [
                'plot_name' => $record->plot_name,
                'vop' => $record->vop,
            ];
        }


        //average vop according to location and date record
        $averages = DB::table('graph')
                ->join('plot', 'graph.plot_id', '=', 'plot.id')
                ->select('plot.location', 'plot.date_record', DB::raw('AVG(graph.vop) as average_vop'))
                ->groupBy('plot.location', 'plot.date_record')
                ->get();


        //return datasets and average
        return view('vop.index', compact('datasets', 'averages'));
    }
}
