<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plot;
use App\Tree;
use App\Species;
use App\Graph;
use DB;

class MapController extends Controller
{
    public function index()
    {
        $maps = DB::table('plot')->get()->toArray();

        $maps = json_decode(json_encode($maps), true);

        //dd($maps);
        
        return view('map.index',compact('maps'));
    }    
}