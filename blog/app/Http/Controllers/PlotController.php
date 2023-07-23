<?php

namespace App\Http\Controllers;

use App\Plot;
use App\Tree;
use App\Species;
use App\Graph;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plot = Plot::all();

        return view('plot.index',compact('plot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plot.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_record'=>'required',
            'total_team'=>'required',
            'team_leader'=>'required',
            'record_by'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'plot_name' => 'required',
            'location' => 'required',
            'latitude' => ['required', 'numeric', function ($attribute, $value, $fail) {
                if ($value < -5.0 || $value > 7.5) {
                    $fail($attribute . ' is outside of the valid range for Malaysia.');
                }
            }],
            'longitude' => ['required', 'numeric', function ($attribute, $value, $fail) {
                if ($value < 100.0 || $value > 119.0) {
                    $fail($attribute . ' is outside of the valid range for Malaysia.');
                }
            }],
            'avg_slope' => 'required',
            'strata_type' => 'required',
            'gps_accuracy' => 'required',
            'resam' => 'required',
            'typography' => 'required',
            'elevation' => 'required',
        ]);

        Plot::create($request->all());

        return redirect()->route('plot.index')
                        ->with('success','Plot created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plot  $plot
     * @return \Illuminate\Http\Response
     */
    public function show($plot_id)
    {
        $plot = Plot::find($plot_id);
        $trees = Tree::where('plot_id', $plot_id)->get();
        $species = Species::all();
        $graphs = Graph::where('plot_id', $plot_id)->get();

        return view('plot.show', [
            'plot' => $plot,
            'trees' => $trees,
            'species' => $species,
            'graphs' => $graphs,
        ]);
        //return view('plot.show',compact('plot'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plot  $plot
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plot = Plot::find($id);
        
        return view('plot.edit',compact('plot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plot  $plot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $request->validate([
        // Validation rules for each field
        'date_record' => 'required',
        'total_team' => 'required',
        'team_leader' => 'required',
        'record_by' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'plot_name' => 'required',
        'location' => 'required',
        'latitude' => ['required', 'numeric', function ($attribute, $value, $fail) {
            if ($value < -5.0 || $value > 7.5) {
                $fail($attribute . ' is outside of the valid range for Malaysia.');
            }
        }],
        'longitude' => ['required', 'numeric', function ($attribute, $value, $fail) {
            if ($value < 100.0 || $value > 119.0) {
                $fail($attribute . ' is outside of the valid range for Malaysia.');
            }
        }],
        'avg_slope' => 'required',
        'strata_type' => 'required',
        'gps_accuracy' => 'required',
        'resam' => 'required',
        'typography' => 'required',
        'elevation' => 'required',
    ]);

    

    //$record = Plot::findOrFail($id);
    $record = Plot::find($id);
    $record->date_record = $request->input('date_record');
    $record->total_team = $request->input('total_team');
    $record->team_leader = $request->input('team_leader');
    $record->record_by = $request->input('record_by');
    $record->start_time = $request->input('start_time');
    $record->end_time = $request->input('end_time');
    $record->plot_name = $request->input('plot_name');
    $record->location = $request->input('location');
    $record->latitude = $request->input('latitude');
    $record->longitude = $request->input('longitude');
    $record->avg_slope = $request->input('avg_slope');
    $record->strata_type = $request->input('strata_type');
    $record->gps_accuracy = $request->input('gps_accuracy');
    $record->resam = $request->input('resam');
    $record->typography = $request->input('typography');
    $record->elevation = $request->input('elevation');
    $record->update();
    //$record->save();

    return redirect()->route('plot.index')->with('success', 'Plot updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plot  $plot
     * @return \Illuminate\Http\Response
     */
    public function destroy($plot_id)
    {
        $plot = Plot::find($plot_id);
        $graphs = Graph::where('plot_id', $plot_id)->get();
        if (is_array($graphs)) {
            $graphs = $plot->graphs;
                foreach ($graphs as $graph) {
                    $graph->delete();
                }
            }
        $plot->delete();
  
        return redirect()->route('plot.index')
                        ->with('success','Plot deleted successfully');

    }

    public function filterByYear(Request $request)
    {
        $year = $request->input('year');
        $location = $request->input('location');
        $strata_type = $request->input('strata_type');
        $plot_name = $request->input('plot_name');
        
        $plot = Plot::where(function($query) use ($year, $location, $strata_type, $plot_name) {
            if($year) {
                $query->whereYear('plot.date_record', $year);
            }
            if($location) {
                $query->where('location', $location);
            }
            if($strata_type) {
                $query->where('strata_type', $strata_type);
            }
            if($plot_name) {
                $query->where('plot_name', $plot_name);
            }
        })->get();

        return view('plot.index', compact('plot'));
    }
}
