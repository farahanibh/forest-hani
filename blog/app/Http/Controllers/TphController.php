<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plot;
use App\Graph;
use DB;

class TphController extends Controller
{
    public function index()
    {
        //TPH according to location and date record
        $data = DB::table('graph')
            ->join('plot', 'plot.id', '=', 'graph.plot_id')
            ->select('tph', 'plot_name', 'location', 'date_record')
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
                'tph' => $record->tph,
            ];
        }


        //average TPH according to location and date record
        $averages = DB::table('graph')
                ->join('plot', 'graph.plot_id', '=', 'plot.id')
                ->select('plot.location', 'plot.date_record', DB::raw('AVG(graph.tph) as average_tph'))
                ->groupBy('plot.location', 'plot.date_record')
                ->get();



        //Average tph reported based on Forest Formation @ strata type
        $stratas = DB::select('
                  SELECT plot.strata_type, AVG(graph.tph) as average_tph 
                  FROM graph 
                  JOIN plot ON graph.plot_id = plot.id 
                  GROUP BY plot.strata_type
                ');
    
        $average_tphs = [];
        foreach ($stratas as $s) {
          $average_tphs[$s->strata_type] = $s->average_tph;
        } 

        //dd( $average_tphs);

        //return datasets and average
        return view('tph.index', compact('datasets', 'averages' , 'average_tphs'));
    }


}