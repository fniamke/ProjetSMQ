<?php

namespace App\Http\Controllers\AnalysesRisques;

use App\Http\Controllers\Controller;
use App\Models\AnalyseRisques;
use Illuminate\Http\Request;

use App\Models\Criticite;
use App\Models\Detection;
use App\Models\Gravite;
use App\Models\Probabilite;
use App\Models\Processus;

use Illuminate\Support\Facades\DB;

class AnalyseRisquesController extends Controller
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
        $arr['analyserisques']=DB::table('analyserisques')
                            ->join('processus', 'analyserisques.IdProcessus','processus.id')
                            ->join('gravite', 'analyserisques.IdGravite','gravite.IdGravite')
                            ->join('probabilite', 'analyserisques.IdProbabilite','probabilite.IdProbabilite')
                            ->join('criticite', 'analyserisques.IdCriticite','criticite.IdCriticite')
                            ->join('detection', 'analyserisques.IdDetection','detection.IdDetection')
                            ->select('analyserisques.*', 'gravite.NoteGravite', 'probabilite.NoteProbabilite', 'criticite.NoteCriticite', 'detection.NoteDetection', 'processus.LibProcessus')
                            ->get();

        return view('analysesrisques.analyserisques.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Processus=Processus::all();
        $gravite=Gravite::all();
        $probabilite=Probabilite::all();
        $criticite=Criticite::all();
        $detection=Detection::all();

        return view('analysesrisques.analyserisques.ajout', compact('Processus', 'gravite', 'probabilite', 'criticite', 'detection'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AnalyseRisques $analyserisques)
    {
        $analyserisques->IdProcessus = $request->IdProcessus;
        $analyserisques->IdGravite = $request->IdGravite;
        $analyserisques->IdProbabilite = $request->IdProbabilite;
        $analyserisques->IdDetection = $request->IdDetection;
        $analyserisques->IdCriticite = $request->IdCriticite;
        $analyserisques->LibRisqueOpportunite = $request->LibRisqueOpportunite;
        $analyserisques->Nature = $request->Nature;
        $analyserisques->Effets = $request->Effets;

        $analyserisques->Causes = $request->Causes;
        $analyserisques->DescriptionMA = $request->DescriptionMA;
        $analyserisques->EvaluationMA = $request->EvaluationMA;
        $analyserisques->EvaluationRR = $request->EvaluationRR;
        $analyserisques->DateRevision = $request->DateRevision;

        $analyserisques->Archiver = 0;

        $analyserisques->save();

        return redirect('AnalysesRisques/analyserisques');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnalyseRisques  $analyseRisques
     * @return \Illuminate\Http\Response
     */
    public function show( AnalyseRisques $analyseRisques)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnalyseRisques  $analyseRisques
     * @return \Illuminate\Http\Response
     */
    public function edit($idanalyserisques, AnalyseRisques $analyseRisques)
    {
         $analyserisques=AnalyseRisques::find($idanalyserisques);
        //dd($analyserisques);
        $arr['analyserisques']=$analyserisques;

        $Processus=Processus::all();
        $gravite=Gravite::all();
        $probabilite=Probabilite::all();
        $criticite=Criticite::all();
        $detection=Detection::all();

        return view('analysesrisques.analyserisques.modifier', compact('analyserisques', 'Processus', 'gravite', 'probabilite', 'criticite', 'detection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnalyseRisques  $analyseRisques
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idanalyserisques, AnalyseRisques $analyserisques)
    {
        $analyserisques=AnalyseRisques::find($idanalyserisques);

        $analyserisques->IdProcessus = $request->IdProcessus;
        $analyserisques->IdGravite = $request->IdGravite;
        $analyserisques->IdProbabilite = $request->IdProbabilite;
        $analyserisques->IdDetection = $request->IdDetection;
        $analyserisques->IdCriticite = $request->IdCriticite;
        $analyserisques->LibRisqueOpportunite = $request->LibRisqueOpportunite;
        $analyserisques->Nature = $request->Nature;
        $analyserisques->Effets = $request->Effets;

        $analyserisques->Causes = $request->Causes;
        $analyserisques->DescriptionMA = $request->DescriptionMA;
        $analyserisques->EvaluationMA = $request->EvaluationMA;
        $analyserisques->EvaluationRR = $request->EvaluationRR;
        $analyserisques->DateRevision = $request->DateRevision;

        $analyserisques->Archiver = 0;

        $analyserisques->save();

        return redirect('AnalysesRisques/analyserisques');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnalyseRisques  $analyseRisques
     * @return \Illuminate\Http\Response
     */
    public function destroy($idanalyserisques)
    {
        AnalyseRisques::destroy($idanalyserisques);
        return redirect('AnalysesRisques/analyserisques');
    }
}
