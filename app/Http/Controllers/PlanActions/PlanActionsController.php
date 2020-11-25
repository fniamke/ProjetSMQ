<?php

namespace App\Http\Controllers\PlanActions;

use App\Http\Controllers\Controller;
use App\Models\PlanActions;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Processus;

use App\Models\user;
use Illuminate\Support\Facades\Auth;
use App\Models\Societe;
use App\Models\Mouchard;

class PlanActionsController extends Controller
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
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        $arr['planactions']=DB::table('planactions')
                            ->join('processus', 'planactions.IdProcessus','processus.id')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->select('planactions.*', 'processus.LibProcessus', 'users.name')
                            ->where('users.pilote', '=', '1')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->get();

        $mouchard = Mouchard::create([
                            'DateEvmt'=>now(),
                            'NomEmploye' => Auth::user()->name,
                            'TypeAction' => 1,
                            'Action' => 'Visualisation de la liste des plans d'. "'" . 'actions de la société '. $societe->NomSociete,
                            'ValAncienne' => '',
                            'ValNouveau' => '',
                            'Poste' => '',
                            ]);

        return view('planactions.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['processus']=Processus::all();
        
        return view('planactions.ajout')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Planactions $planactions)
    {
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        $planactions->IdProcessus = $request->IdProcessus;
        $planactions->LibPlanaction = $request->LibPlanaction;
        $planactions->CodePlanaction = $request->CodePlanaction;
        $planactions->IdSociete = $idsociete;
        
        $planactions->save();

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Création du plan d' . "'" . 'action '. $planactions->LibPlanaction . chr(13) . chr(10) . 'IdProcessus ='. $planactions->IdProcessus . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Planactions/planactions');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanActions  $planActions
     * @return \Illuminate\Http\Response
     */
    public function show($IdProcessus, PlanActions $planActions)
    {
        $processus=Processus::find($IdProcessus);
        $pilote=user::find($processus->IdPilote);

        $Listeplanactions=DB::table('planactions')
                            ->join('processus', 'planactions.IdProcessus','processus.id')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->select('planactions.*', 'processus.LibProcessus', 'users.name')
                            ->where('users.pilote', '=', '1')
                            ->where('processus.id', '=', $IdProcessus)
                            ->get();

        //return view('planactions.show')->with($arr);
        return view('planactions.show', compact('Listeplanactions', 'processus', 'pilote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanActions  $planActions
     * @return \Illuminate\Http\Response
     */
    public function edit($IdPlanaction, PlanActions $planActions)
    {
        $planActions=PlanActions::find($IdPlanaction);
        $processus=Processus::all();
        
        return view('planactions.modifier', compact('planActions', 'processus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlanActions  $planActions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdPlanaction, PlanActions $planActions)
    {
        $planActions=PlanActions::find($IdPlanaction);
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        $ValAncienne='';
        $ValNouveau='';
        $LibPlanaction=$planActions->LibPlanaction;

        if ($planActions->IdProcessus != $request->IdProcessus)
        {
            $ValAncienne='IdProcessus ='. $planActions->IdProcessus .chr(13).chr(10);
            $ValNouveau='IdProcessus :'. $request->IdProcessus .chr(13).chr(10);
        }
        
        if ($planActions->LibPlanaction != $request->LibPlanaction)
        {
            $ValAncienne=$ValAncienne .'LibPlanaction ='. $planActions->LibPlanaction .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'LibPlanaction ='. $request->LibPlanaction .chr(13).chr(10);
        }
        
        if ($planActions->CodePlanaction != $request->CodePlanaction)
        {
            $ValAncienne=$ValAncienne .'LibIndicateur ='. $planActions->CodePlanaction .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'LibIndicateur ='. $request->CodePlanaction .chr(13).chr(10);
        }

        $planActions->IdProcessus = $request->IdProcessus;
        $planActions->LibPlanaction = $request->LibPlanaction;
        $planActions->CodePlanaction = $request->CodePlanaction;
        $planActions->IdSociete = $idsociete;

        $planActions->save();

        $mouchard = Mouchard::create([
                'DateEvmt'=>now(),
                'NomEmploye' => Auth::user()->name,
                'TypeAction' => 1,
                'Action' => 'Modification du plan d' . "'" . 'action '. $LibPlanaction . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
                'ValAncienne' => $ValAncienne,
                'ValNouveau' => $ValNouveau,
                'Poste' => '',
                ]);

        return redirect('Planactions/planactions');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanActions  $planActions
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdPlanaction)
    {
        $planActions=PlanActions::find($IdPlanaction);
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        PlanActions::destroy($IdPlanaction);

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Suppression du plan d'. "'" . 'action ' . $planActions->LibPlanaction . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Planactions/planactions');
    }
}
