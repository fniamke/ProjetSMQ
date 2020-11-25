<?php

namespace App\Http\Controllers\Processus;

use App\Http\Controllers\Controller;
use App\Models\Processus;
use Illuminate\Http\Request;

use App\Models\Typesprocessus;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Societe;
use App\Models\Mouchard;

class ProcessusController extends Controller
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
        //$arr['Processus']=Processus::all();

        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);
        /*
        $Processus1=DB::table('processus')
                            ->join('societe', 'processus.IdSociete','societe.IdSociete')
                            ->join('typesprocessus', 'processus.IdTypeProcessus','typesprocessus.id')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->join('fonctions', 'users.Idfonction','fonctions.id')
                            ->select('processus.*', 'societe.NomSociete', 'typesprocessus.LibTypesProcessus', 'users.name', 'fonctions.LibFonction')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->OrderBy('typesprocessus.LibTypesProcessus', 'asc');
        
        $Processus=DB::table('processus')
                            ->join('societe', 'processus.IdSociete','societe.IdSociete')
                            ->join('typesprocessus', 'processus.IdTypeProcessus','typesprocessus.id')
                            ->join('users', 'processus.IdSousPilote','users.id')
                            ->join('fonctions', 'users.Idfonction','fonctions.id')
                            ->select('processus.*', 'societe.NomSociete', 'typesprocessus.LibTypesProcessus', 'users.name', 'fonctions.LibFonction')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->OrderBy('typesprocessus.LibTypesProcessus', 'asc')
                            ->union($Processus1)
                            ->get();
                        */

        $Processus=DB::table('processus')
                        ->join('societe', 'processus.IdSociete','societe.IdSociete')
                        ->join('typesprocessus', 'processus.IdTypeProcessus','typesprocessus.id')
                        ->join('users', 'processus.IdPilote','users.id')
                        ->join('fonctions', 'users.Idfonction','fonctions.id')
                        ->select('processus.*', 'societe.NomSociete', 'typesprocessus.LibTypesProcessus', 'users.name', 'fonctions.LibFonction')
                        ->where('users.IdSociete', '=', $idsociete)
                        ->OrderBy('typesprocessus.LibTypesProcessus', 'asc')
                        ->get();
                            
        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Visualisation de la liste des processus de la société '. $societe->NomSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);


        return view('processus.processus.index', compact('Processus', 'societe'));
    }

    //->join('typesprocessus', 'processus.IdTypeProcessus','typesprocessus.id')
    //->join('fonctions', 'users.Idfonction','fonctions.id')
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$arr['Typesprocessus']=Typesprocessus::all();
        //return view('processus.processus.ajout')->with($arr);

        $idsociete=Auth::user()->IdSociete;

        $Typesprocessus=Typesprocessus::all();
        $Pilote=DB::table('users')
                            ->select('users.*')
                            ->where('users.pilote', '=', '1')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->get();
        $SousPilote=DB::table('users')
                            ->select('users.*')
                            ->where('users.SousPilote', '=', '1')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->get();    

        return view('processus.processus.ajout', compact('Typesprocessus', 'Pilote', 'SousPilote'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Processus $processus)
    {
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        
        $processus->IdTypeProcessus = $request->Id;
        $processus->LibProcessus = $request->LibProcessus;
        $processus->ChampApplication = $request->ChampApplication;
        $processus->IdPilote = $request->IdPilote;
        $processus->IdSousPilote = 0;
        $processus->IdSociete = $idsociete;
        
        $processus->save();

        //dd($processus->IdPilote);
        /*
        if ($processus->IdPilote==null)
        {
            $pilote='IdPilote ='. $processus->IdPilote;
        }
        else
        {
            $pilote='IdSousPilote ='. $processus->IdSousPilote;
        }
        */

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Création du processus '. $processus->LibProcessus . ' - '. $processus->ChampApplication . chr(13) . chr(10) . 'IdPilote ='. $processus->IdPilote . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Processus/processus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Processus  $processus
     * @return \Illuminate\Http\Response
     */
    public function show(Processus $processus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Processus  $processus
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Processus $processus)
    {
        $processus=Processus::find($id);
        $Typesprocessus=Typesprocessus::all();

        $idsociete=Auth::user()->IdSociete;
        
        $Pilote=DB::table('users')
                            ->select('users.*')
                            ->where('users.pilote', '=', '1')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->get();
        $SousPilote=DB::table('users')
                            ->select('users.*')
                            ->where('users.SousPilote', '=', '1')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->get();    

        return view('processus.processus.modifier', compact('processus', 'Typesprocessus', 'Pilote', 'SousPilote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Processus  $processus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Processus $processus)
    {
        $processus=Processus::find($id);
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        $ValAncienne='';
        $ValNouveau='';

        if ($processus->IdTypeProcessus != $request->IdTypeProcessus)
        {
            $ValAncienne='IdTypeProcessus ='. $processus->IdTypeProcessus .chr(13).chr(10);
            $ValNouveau='IdTypeProcessus :'. $request->Id .chr(13).chr(10);
        }
        
        if ($processus->LibProcessus != $request->LibProcessus)
        {
            $ValAncienne=$ValAncienne .'LibProcessus ='. $processus->LibProcessus .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'LibProcessus ='. $request->LibProcessus .chr(13).chr(10);
        }
        
        if ($processus->ChampApplication != $request->ChampApplication)
        {
            $ValAncienne=$ValAncienne .'ChampApplication ='. $processus->ChampApplication .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'ChampApplication ='. $request->ChampApplication .chr(13).chr(10);
        }

        if ($processus->IdPilote != $request->IdPilote)
        {
            $ValAncienne=$ValAncienne .'IdPilote ='. $processus->IdPilote .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'IdPilote ='. $request->IdPilote .chr(13).chr(10);
        }
        
        $processus->IdTypeProcessus = $request->Id;
        $processus->LibProcessus = $request->LibProcessus;
        $processus->ChampApplication = $request->ChampApplication;
        $processus->IdPilote = $request->IdPilote;
        $processus->IdSousPilote = 0;
        $processus->IdSociete = $idsociete;

        $processus->save();

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Modification du processus '. $processus->LibProcessus . ' - '. $processus->ChampApplication . chr(13) . chr(10) . 'IdPilote ='. $processus->IdPilote . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => $ValAncienne,
            'ValNouveau' => $ValNouveau,
            'Poste' => '',
            ]);

        return redirect('Processus/processus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Processus  $processus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $processus=Processus::find($id);
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        Processus::destroy($id);
        
        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Suppression du processus '. $processus->LibProcessus . ' - '. $processus->ChampApplication . chr(13) . chr(10) . 'IdPilote ='. $processus->IdPilote . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Processus/processus');
    }
    
    public function listeprocessus()
    {
        $arr['listeprocessus']=DB::table('processus')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->join('indicateurs', 'processus.id','indicateurs.IdProcessus')
                            ->select('processus.LibProcessus, processus.ChampApplication', 'users.name', 'indicateurs.LibIndicateur')
                            ->where('users.pilote', '=', '1')
                            ->get();
        return view('processus.processus.listeprocessus')->with($arr);
                                         
    }
    
}
