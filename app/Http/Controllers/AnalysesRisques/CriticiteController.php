<?php

namespace App\Http\Controllers\AnalysesRisques;

use App\Http\Controllers\Controller;
use App\Models\Criticite;
use Illuminate\Http\Request;

class CriticiteController extends Controller
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
        $arr['criticite']=Criticite::all();
        return view('analysesrisques.criticite.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('analysesrisques.criticite.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Criticite $criticite)
    {
        $criticite->Criticite = $request->Criticite;
        $criticite->NoteCriticite = $request->NoteCriticite;
        
        $criticite->save();
        return redirect('AnalysesRisques/criticite');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Criticite  $criticite
     * @return \Illuminate\Http\Response
     */
    public function show(Criticite $criticite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Criticite  $criticite
     * @return \Illuminate\Http\Response
     */
    //public function edit($idcriticite, Criticite $criticite)
    public function edit(Criticite $criticite)
    {
        //$criticite=Criticite::find($idcriticite);
        //dd($criticite);
        $arr['criticite']=$criticite;
        return view('analysesrisques.criticite.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Criticite  $criticite
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $idcriticite, Criticite $criticite)
    public function update(Request $request, Criticite $criticite)
    {
        //dd($criticite);
        //$criticite=Detection::find($idcriticite);
        $criticite->Criticite = $request->Criticite;
        $criticite->NoteCriticite = $request->NoteCriticite;
        
        $criticite->save();

        return redirect('AnalysesRisques/criticite');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Criticite  $criticite
     * @return \Illuminate\Http\Response
     */
    public function destroy($idcriticite)
    {
        Criticite::destroy($idcriticite);
        return redirect('AnalysesRisques/criticite');
    }
}
