<?php

namespace App\Http\Controllers;

use App\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $species = Species::all();
        //$total = Species::count();

        //return view('species.index',compact('species','total'));
        return view('species.index',compact('species'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('species.create');
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
            'eng_name' => 'required',
            'malay_name' => 'required',
            'family' => 'required'
        ]);

        Species::create($request->all());
   
        return redirect()->route('species.index')
                        ->with('success','Species created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function show(Species $species)
    {
        return view('species.show',compact('species'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function edit(Species $species)
    {
        return view('species.edit',compact('species'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Species $species)
    {
        $request->validate([
            'eng_name' => 'required',
            'malay_name' => 'required',
            'family' => 'required'
        ]);

        $species->update($request->all());
  
        return redirect()->route('species.index')
                        ->with('success','Species updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function destroy(Species $species)
    {
        $species->delete();
  
        return redirect()->route('species.index')
                        ->with('success','Species deleted successfully');

    }
    
    //-----------------SEARCH-----------------

    public function filterBySpecies(Request $request) 
    {
        $malay_name = $request->input('malay_name');
        $eng_name = $request->input('eng_name');
    
        /*$species = Species::where(function($query) use ($malay_name, $eng_name) {
            $query->where('malay_name', 'like', '%' . $malay_name . '%')
                ->orWhere('eng_name', 'like', '%' . $eng_name . '%');
        })->get();*/
        
        $species = Species::where(function($query) use ($malay_name, $eng_name) {
            if($malay_name) {
                $query->where('malay_name', $malay_name);
            }
            if($eng_name) {
                $query->where('eng_name', $eng_name);
            }
        })->get();
    
        return view('species.index', compact('species'));
    }
}
