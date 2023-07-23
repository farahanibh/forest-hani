<?php

namespace App\Http\Controllers;

use App\Tree;
use App\Plot;
use App\Species;
use App\Graph;
use DB;
use Illuminate\Http\Request;

class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tree = Tree::with('plot' , 'species') ->orderBy('plot_id')-> get();

        //return view ('tree.index', compact('tree'));
        
        $treeCount = $tree->count();
    
        return view('tree.index', [
            'tree' => $tree,
            'treeCount' => $treeCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plot = Plot::pluck('plot_name', 'id');

        $species = Species::pluck( 'malay_name', 'id');

        return view('tree.create', compact('plot', 'species'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //-----------------RETRIEVE USER INPUT-----------------
        $plot_id = $request->input('plot_id');
        $species_id = $request->input('species_id');
        $dbh = $request->input('dbh');
        $scalling_factor = $request->input('scalling_factor');
        $wood_density = $request->input('wood_density');

        //-----------------DECLARE-----------------
        $size_nest = "-";
        $scalling_factor2 = "0";
        $biomass = "0";
        $biomass2 = "0";
        $volume = "0";
        $volume2 = "0";
        $basal_area = "0";
        $basal_area2 = "0";
        $density_tree = "0";

        //-----------------CALL FUNCTION-----------------
        $size_nest = $this->calculateSizeNest($dbh);
        $scalling_factor2 = $this->calculateScallingFactor($size_nest);
        $biomass = $this->calculateBiomass($wood_density, $dbh);
        $biomass2 = $this->calculateBiomass2($biomass, $scalling_factor2);
        $volume = $this->calculateVolume($dbh);
        $volume2 = $this->calculateVolume2($volume , $scalling_factor2);
        $basal_area = $this->calculateBasalArea($dbh);
        $basal_area2 = $this->calculateBasalArea2($basal_area , $scalling_factor2);
        $density_tree = $this->calculateDensityTree($scalling_factor2);

        //-----------------INSERT DATA TO DATABASE-----------------
        $tree = new Tree;

        $tree->plot_id = $plot_id;
        $tree->species_id = $species_id;
        $tree->dbh = $dbh;
        $tree->scalling_factor = $scalling_factor;
        $tree->wood_density = $wood_density;

        $tree->size_nest = $size_nest;
        $tree->scalling_factor2 = $scalling_factor2;
        $tree->biomass = $biomass;
        $tree->biomass2 = $biomass2;
        $tree->volume = $volume;
        $tree->volume2 = $volume2;
        $tree->basal_area = $basal_area;
        $tree->basal_area2 = $basal_area2;
        $tree->density_tree = $density_tree;
        $tree->save();

        return redirect()->route('tree.index')
                        ->with('success','Tree created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tree = Tree::with(['plot', 'species', 'graph'])->findOrFail($id);

        return view('tree.show', compact('tree'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function edit(Tree $tree)
    {
        $plot = Plot::pluck('plot_name', 'id');

        $species = Species::pluck( 'malay_name', 'id');

        return view('tree.edit',compact('plot', 'species', 'tree'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tree $tree)
    {
        $tree->update($request->all());

        return redirect()->route('tree.index')
                        ->with('success','Tree updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tree $tree)
    {
        $tree->delete();
  
        return redirect()->route('tree.index')
                        ->with('success','Tree deleted successfully');
    }

    //-----------------SEARCH-----------------
    public function filterByTree(Request $request)
    {
        $year = $request->input('year');
        $plot_name = $request->input('plot_name');
        $malay_name = $request->input('malay_name');
        $size_nest = $request->input('size_nest');
    
        $tree = Tree::join('plot', 'plot.id', '=', 'tree.plot_id')
            ->join('species', 'species.id', '=', 'tree.species_id')
            ->when($year, function ($query, $year) {
                return $query->whereYear('plot.date_record', '=', $year);
            })
            ->when($plot_name, function ($query, $plot_name) {
                return $query->where ('plot.plot_name', '=', $plot_name);
            })
            ->when($malay_name, function ($query, $malay_name) {
                return $query->where('species.malay_name', '=', $malay_name);
            })
            ->when($size_nest, function ($query, $size_nest) {
                return $query->where('tree.size_nest', '=', $size_nest);
            })
            ->get();
    
        $treeCount = $tree->count();
    
        return view('tree.index', [
            'tree' => $tree,
            'treeCount' => $treeCount,
        ]);
    }



    //-----------------PERFORM CALCULATION FUNCTION-----------------
    
    //1 - size of nest
    function calculateSizeNest($dbh)
    {
        switch($dbh){
                case ($dbh < 5):
                    return $size_nest = "Sapling";
                    break;
                case ($dbh >= 5 && $dbh <= 14.9):
                    return $size_nest = "Small";
                    break;
                case ($dbh >= 15 && $dbh <= 29.9):
                    return $size_nest = "Medium";
                    break;
                case ($dbh >= 30):
                    return $size_nest = "Large";
                    break;
                default:
                    return $size_nest = "-";
            }
    }

    //2 - scalling_factor2 = 10000/Area
    function calculateScallingFactor($size_nest)
    {
        $Area_s = 47.37;
        $Area_m = 426.32;
        $Area_l = 1184.23;

            switch($size_nest){
                case "Small":
                    return $scalling_factor2 = 10000 / $Area_s;
                    break;
                case "Medium":
                    return $scalling_factor2 = 10000 / $Area_m;
                    break;
                case "Large":
                    return $scalling_factor2 = 10000 / $Area_l;
                    break;
                default:
                    return $scalling_factor2 = "0";
            }
    }

    //3 - biomass = wood density x exp(-1.499 + 2.148ln(DBH) + 0.207(ln(DBH))^2 – 0.0281(ln(DBH))^3)
    function calculateBiomass($wood_density, $dbh)
    {
        return round ($wood_density * exp(-1.499 + 2.148 * log($dbh) + 0.207 * pow(log($dbh), 2) - 0.0281 * pow(log($dbh), 3)),2);
    }

    //4 - biomass2 = biomass * scalling_factor2
    function calculateBiomass2($biomass, $scalling_factor2)
    {
        return round (($biomass * $scalling_factor2), 2);
    }

    //5 - volume = 0.00026466 * dbh ^ 2.279212554
    function calculateVolume($dbh)
    {
        return round ((0.00026466 * pow($dbh, 2.279212554)), 2);
    }

    //6 - volume2 = volume * scalling_factor2
    function calculateVolume2($volume , $scalling_factor2)
    {
        return round (($volume * $scalling_factor2) , 2);
    }

    //7 - basal_area = (dbh ^ 2/40000) * 3.1416 
    function calculateBasalArea($dbh)
    {
        return round ((pow($dbh, 2)/40000 * 3.1416) , 2);
    }

    //8 - basal_area2 = basalArea_ * scalling_factor2  
    function calculateBasalArea2($basal_area , $scalling_factor2)
    {
        return round (($basal_area * $scalling_factor2) , 2);
    }

    //9 - density_tree = scalling_factor2
    function calculateDensityTree($scalling_factor2)
    {
        return round (($scalling_factor2) , 2);
    }

    //-----------------PERFORM GRAPH CALCULATION FUNCTION-----------------
    public function calculateDensity(Request $request)
    {
        // Perform calculations
        $totals = DB::table('tree')
                ->select('plot_id', DB::raw('SUM(density_tree) as density_total'), DB::raw('SUM(basal_area2) as area_total'), DB::raw('SUM(volume2) as volume_total'))
                ->groupBy('plot_id')
                ->get();

        // Insert new data into Graph table
        foreach ($totals as $total) {

            // Delete existing data from Graph table with the same plot_id
            DB::table('graph')->where('plot_id', $total->plot_id)->delete();

            DB::table('graph')->insert([
                'plot_id' => $total->plot_id,
                'tph' => $total->density_total,
                'bap' => $total->area_total,
                'vop' => $total->volume_total,
            ]);
        }
          
        return view ('home');
    }
}
