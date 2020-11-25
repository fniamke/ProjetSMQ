<?php

namespace App\Http\Controllers\IndicateursParProcessus;

use App\Http\Controllers\Controller;
use App\Models\IndicateursParProcessus;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Typesprocessus;
use App\Models\Processus;
use App\Models\SousProcessus;
use App\Models\Indicateurs;

class IndicateursParProcessusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$arr['listeprocessus']=DB::table('processus')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->join('indicateurs', 'processus.id','indicateurs.IdProcessus')
                            ->select('processus.*', 'users.name', 'indicateurs.LibIndicateur')
                            ->where('users.pilote', '=', '1')
                            ->get();
                            */
        /*
        $arr['listeprocessus']=DB::table('processus')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->join('indicateurs', 'processus.id','indicateurs.IdProcessus')
                            ->select('processus.*', 'users.name', 'indicateurs.LibIndicateur')
                            ->where('users.pilote', '=', '1')
                            ->get();
        */
        
        /*
            $arr['listeprocessus']=DB::table('processus')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->join('indicateurs', 'processus.id','indicateurs.IdProcessus')
                            ->join('planactions', 'processus.id','planactions.IdProcessus')
                            ->join('taches', 'planactions.IdPlanaction','taches.IdPlanaction')
                            ->select('processus.*', 'users.name', 'indicateurs.LibIndicateur', 'planactions.LibPlanaction', 'taches.LibTaches')
                            ->where('users.pilote', '=', '1')
                            ->get();

                            */

                        
        $arr['listeprocessus']=DB::select('call IndicateursParProcessus()');

        //dd($arr);

        return view('indicateursparprocessus.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndicateursParProcessus  $indicateursParProcessus
     * @return \Illuminate\Http\Response
     */
    public function show($vparams, IndicateursParProcessus $indicateursParProcessus)
    {
        
        $pos=strrpos($vparams,"¤"); //déterminer la position du caractère ¤ dans la variable $IdIndicateurs
        $id=substr($vparams,0,$pos); 
        //dd($IdIndicateur);

        $id=(int)$id;

        //dd($IdIndicateur);

        $TypeAction=substr($vparams,-1,1); 
        //dd($TypeAction);

        $processus=Processus::find($id);
            
        //dd($processus);
        $Typesprocessus=Typesprocessus::all();
        $Pilote=DB::table('users')
                            ->select('users.*')
                            ->where('users.pilote', '=', '1')
                            ->get();

        if($TypeAction==1)
        {
            //$id=(int)$id;
            
            
            $sousprocessus=SousProcessus::all();
            
            $Indicateurs1=DB::table('indicateurs')
                        ->join('processus', 'indicateurs.IdProcessus','processus.id')
                        ->join('users', 'processus.IdPilote','users.id')
                        ->select('indicateurs.*', 'processus.LibProcessus', 'users.name')
                        ->where('users.pilote',  '1')
                        ->where('Etat', '=', '0')
                        ->where('indicateurs.IdProcessus', '=', $id)
                        ->orderBy('LibIndicateur', 'asc')
                        ->where('Archiver', '=', '0');
                        
                       
            $Indicateurs=DB::table('indicateurs')
                                ->join('sousprocessus', 'indicateurs.IdSousProcessus','sousprocessus.IdSousProcessus')
                                ->join('users', 'sousprocessus.IdSousPilote','users.id')
                                ->select('indicateurs.*', 'sousprocessus.LibSousProcessus as LibProcessus', 'users.name')
                                ->where('users.SousPilote', '=', '1')
                                ->where('Etat', '=', '0')
                                ->where('sousprocessus.IdProcessus', '=', $id)
                                ->where('Archiver', '=', '0')
                                ->orderBy('LibProcessus', 'asc')
                                ->orderBy('LibSousProcessus', 'asc')
                                ->union($Indicateurs1)
                                ->get();

            $planactions=DB::table('planactions')
                                ->join('processus', 'planactions.IdProcessus','processus.id')
                                ->join('users', 'processus.IdPilote','users.id')
                                ->select('planactions.*', 'processus.LibProcessus', 'users.name')
                                ->where('users.pilote', '=', '1')
                                ->where('planactions.IdProcessus', '=', $id)
                                ->orderBy('LibProcessus', 'asc')
                                ->orderBy('LibPlanaction', 'asc')
                                ->get();

            $Taches=DB::table('taches')
                            ->join('planactions', 'taches.IdPlanaction','planactions.IdPlanaction')
                            ->join('processus', 'planactions.IdProcessus','processus.id')
                            ->join('users', 'taches.IdIntervenant','users.id')
                            ->join('typemoyen', 'taches.IdTypeMoyen','typemoyen.IdTypeMoyen')
                            ->select('taches.*', 'planactions.LibPlanaction', 'processus.LibProcessus', 'users.name', 'typemoyen.LibTypeMoyen')
                            ->where('users.pilote', '=', '1')
                            ->where('planactions.IdProcessus', '=', $id)
                            ->orderBy('LibPlanaction', 'asc')
                            ->orderBy('LibTaches', 'asc')
                            ->get();

            $partiesinteressees=DB::table('partiesinteressees')
                            ->join('Processus', 'partiesinteressees.IdProcessus','Processus.id')
                            ->join('NiveauImportance', 'partiesinteressees.IdNivImportance','NiveauImportance.IdNivImportance')
                            ->join('NiveauRelation', 'partiesinteressees.IdNivRelation','NiveauRelation.IdNivRelation')
                            ->join('Cotation', 'partiesinteressees.IdCotation','Cotation.IdCotation')
                            ->select('partiesinteressees.*', 'NiveauImportance.ValeurNivImportance', 'NiveauRelation.ValeurNivRelation', 'Cotation.ValeurCotation', 'Processus.LibProcessus')
                            ->where('partiesinteressees.IdProcessus', '=', $id)
                            ->get();

            $analyserisques=DB::table('analyserisques')
                            ->join('processus', 'analyserisques.IdProcessus','processus.id')
                            ->join('gravite', 'analyserisques.IdGravite','gravite.IdGravite')
                            ->join('probabilite', 'analyserisques.IdProbabilite','probabilite.IdProbabilite')
                            ->join('criticite', 'analyserisques.IdCriticite','criticite.IdCriticite')
                            ->join('detection', 'analyserisques.IdDetection','detection.IdDetection')
                            ->select('analyserisques.*', 'gravite.NoteGravite', 'probabilite.NoteProbabilite', 'criticite.NoteCriticite', 'detection.NoteDetection', 'processus.LibProcessus')
                            ->where('analyserisques.IdProcessus', '=', $id)
                            ->get();

            return view('indicateursparprocessus.show', compact('processus', 'Typesprocessus', 'Pilote', 'planactions', 'Indicateurs', 'Taches', 'partiesinteressees', 'analyserisques'));
        }
        else
        {
            $Indicateurs1=DB::table('indicateurs')
                        ->join('processus', 'indicateurs.IdProcessus','processus.id')
                        ->join('users', 'processus.IdPilote','users.id')
                        ->select('indicateurs.*', 'processus.LibProcessus', 'users.name')
                        ->where('users.pilote',  '1')
                        ->where('Etat', '=', '1')
                        ->where('indicateurs.IdProcessus', '=', $id)
                        ->orderBy('LibIndicateur', 'asc');
                        
                       
            $Indicateurs=DB::table('indicateurs')
                                ->join('sousprocessus', 'indicateurs.IdSousProcessus','sousprocessus.IdSousProcessus')
                                ->join('users', 'sousprocessus.IdSousPilote','users.id')
                                ->select('indicateurs.*', 'sousprocessus.LibSousProcessus as LibProcessus', 'users.name')
                                ->where('users.SousPilote', '=', '1')
                                ->where('Etat', '=', '1')
                                ->where('sousprocessus.IdProcessus', '=', $id)
                               ->orderBy('LibProcessus', 'asc')
                                ->orderBy('LibSousProcessus', 'asc')
                                ->union($Indicateurs1)
                                ->get();

            return view('indicateursparprocessus.indicateursarchives', compact('processus', 'Pilote', 'Indicateurs', 'Typesprocessus'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndicateursParProcessus  $indicateursParProcessus
     * @return \Illuminate\Http\Response
     */
    public function edit(IndicateursParProcessus $indicateursParProcessus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndicateursParProcessus  $indicateursParProcessus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndicateursParProcessus $indicateursParProcessus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndicateursParProcessus  $indicateursParProcessus
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndicateursParProcessus $indicateursParProcessus)
    {
        //
    }
}
