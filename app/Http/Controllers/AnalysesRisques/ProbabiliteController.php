<?php

namespace App\Http\Controllers\AnalysesRisques;

use App\Http\Controllers\Controller;
use App\Models\Probabilite;
use Illuminate\Http\Request;

class ProbabiliteController extends Controller
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
        $arr['probabilite']=Probabilite::all();
        return view('analysesrisques.probabilite.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('analysesrisques.probabilite.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Probabilite $probabilite)
    {
        $probabilite->Probabilite = $request->Probabilite;
        $probabilite->DefinitionProbabilite = $request->DefinitionProbabilite;
        $probabilite->NoteProbabilite = $request->NoteProbabilite;
        
        $probabilite->save();
        return redirect('AnalysesRisques/probabilite');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Probabilite  $probabilite
     * @return \Illuminate\Http\Response
     */
    public function show(Probabilite $probabilite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Probabilite  $probabilite
     * @return \Illuminate\Http\Response
     */
    //public function edit($idprobabilite, Probabilite $probabilite)
     public function edit(Probabilite $probabilite)
    {
        //$probabilite=Probabilite::find($idprobabilite);
        //dd($probabilite);
        $arr['probabilite']=$probabilite;
        return view('analysesrisques.probabilite.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Probabilite  $probabilite
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $idprobabilite, Probabilite $probabilite)
     public function update(Request $request, Probabilite $probabilite)
    {
        //dd($probabilite);
        //$probabilite=Probabilite::find($idprobabilite);
        $probabilite->Probabilite = $request->Probabilite;
        $probabilite->DefinitionProbabilite = $request->DefinitionProbabilite;
        $probabilite->NoteProbabilite = $request->NoteProbabilite;

        $probabilite->save();
        
        return redirect('AnalysesRisques/probabilite');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Probabilite  $probabilite
     * @return \Illuminate\Http\Response
     */
    public function destroy($idprobabilite)
    {
        Probabilite::destroy($idprobabilite);
        return redirect('AnalysesRisques/probabilite');
    }
}
