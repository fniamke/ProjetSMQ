<?php

namespace App\Http\Controllers\PartiesInteressees;

use App\Http\Controllers\Controller;
use App\Models\NiveauRelation;
use Illuminate\Http\Request;

class NiveauRelationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['niveaurelation']=NiveauRelation::all();
        return view('partiesinteressees.niveaurelation.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partiesinteressees.niveaurelation.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, NiveauRelation $niveaurelation)
    {
        $niveaurelation->LibNivRelation = $request->LibNivRelation;
        $niveaurelation->ValeurNivRelation = $request->ValeurNivRelation;
        $niveaurelation->save();
        return redirect('PartiesInteressees/niveaurelation');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NiveauRelation  $niveauRelation
     * @return \Illuminate\Http\Response
     */
    public function show(NiveauRelation $niveauRelation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NiveauRelation  $niveauRelation
     * @return \Illuminate\Http\Response
     */
    public function edit($IdNivRelation, NiveauRelation $niveauRelation)
    {
        $niveauRelation=NiveauRelation::find($IdNivRelation);
        $arr['niveaurelation']=$niveauRelation;
        return view('partiesinteressees.niveaurelation.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NiveauRelation  $niveauRelation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdNivRelation, NiveauRelation $niveauRelation)
    {
        $niveauRelation=NiveauRelation::find($IdNivRelation);
        $niveauRelation->LibNivRelation = $request->LibNivRelation;
        $niveauRelation->ValeurNivRelation = $request->ValeurNivRelation;
        $niveauRelation->save();
        
        return redirect('PartiesInteressees/niveaurelation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NiveauRelation  $niveauRelation
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdNivRelation)
    {
        NiveauRelation::destroy($IdNivRelation);
        return redirect('PartiesInteressees/niveaurelation');
    }
}
