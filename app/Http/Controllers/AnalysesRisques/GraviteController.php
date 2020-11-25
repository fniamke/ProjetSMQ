<?php

namespace App\Http\Controllers\AnalysesRisques;

use App\Http\Controllers\Controller;
use App\Models\Gravite;
use Illuminate\Http\Request;

class GraviteController extends Controller
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
        $arr['gravite']=Gravite::all();
        return view('analysesrisques.gravite.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('analysesrisques.gravite.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Gravite $gravite)
    {
        $gravite->Gravite = $request->Gravite;
        $gravite->DefinitionGravite = $request->DefinitionGravite;
        $gravite->NoteGravite = $request->NoteGravite;
        
        $gravite->save();
        return redirect('AnalysesRisques/gravite');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gravite  $gravite
     * @return \Illuminate\Http\Response
     */
    public function show(Gravite $gravite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gravite  $gravite
     * @return \Illuminate\Http\Response
     */
    //public function edit($idgravite, Gravite $gravite)
     public function edit(Gravite $gravite)
    {
        //$gravite=Gravite::find($idgravite);
        //dd($gravite);
        $arr['gravite']=$gravite;
        return view('analysesrisques.gravite.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gravite  $gravite
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $idgravite, Gravite $gravite)
     public function update(Request $request, Gravite $gravite)
    {
        //dd($gravite);
        //$gravite=Gravite::find($idgravite);
        $gravite->Gravite = $request->Gravite;
        $gravite->DefinitionGravite = $request->DefinitionGravite;
        $gravite->NoteGravite = $request->NoteGravite;
        
        $gravite->save();
        
        return redirect('AnalysesRisques/gravite');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gravite  $gravite
     * @return \Illuminate\Http\Response
     */
    public function destroy($idgravite)
    {
        Gravite::destroy($idgravite);
        return redirect('AnalysesRisques/gravite');
    }
}
