<?php

namespace App\Http\Controllers\Processus;

use App\Http\Controllers\Controller;
use App\Models\SousProcessus;
use Illuminate\Http\Request;

use App\Models\Processus;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Models\Societe;
use App\Models\Mouchard;

class SousProcessusController extends Controller
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
        
        $arr['SousProcessus']=DB::table('sousprocessus')
                            ->join('processus', 'sousprocessus.IdProcessus','processus.id')
                            ->join('users', 'sousprocessus.IdSousPilote','users.id')
                            ->join('fonctions', 'users.Idfonction','fonctions.id')
                            ->select('sousprocessus.*', 'processus.LibProcessus', 'users.name', 'fonctions.LibFonction')
                            ->where('users.SousPilote', '=', '1')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->get();

        $mouchard = Mouchard::create([
                            'DateEvmt'=>now(),
                            'NomEmploye' => Auth::user()->name,
                            'TypeAction' => 1,
                            'Action' => 'Visualisation de la liste des sous processus de la société '. $societe->NomSociete,
                            'ValAncienne' => '',
                            'ValNouveau' => '',
                            'Poste' => '',
                            ]);

        return view('processus.sousprocessus.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $processus=Processus::all();
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);
        
        $SousPilote=DB::table('users')
                            ->select('users.*')
                            ->where('users.SousPilote', '=', '1')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->get();    

        return view('processus.sousprocessus.ajout', compact('processus', 'SousPilote'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SousProcessus $SousProcessus)
    {
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        $SousProcessus->IdProcessus = $request->IdProcessus;
        $SousProcessus->CodeSousProcessus = $request->CodeSousProcessus;
        $SousProcessus->LibSousProcessus = $request->LibSousProcessus;
        $SousProcessus->IdSousPilote = $request->IdSousPilote;
        $SousProcessus->IdSociete = $idsociete;
        
        $SousProcessus->save();

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Création du sous processus '. $SousProcessus->CodeSousProcessus . ' - '. $SousProcessus->LibSousProcessus . chr(13) . chr(10) . 'IdSousPilote ='. $SousProcessus->IdSousPilote . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Processus/sousprocessus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SousProcessus  $sousProcessus
     * @return \Illuminate\Http\Response
     */
    public function show(SousProcessus $sousProcessus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SousProcessus  $sousProcessus
     * @return \Illuminate\Http\Response
     */
    
    public function edit($IdSousProcessus, SousProcessus $sousProcessus)
    {
        $sousProcessus=SousProcessus::find($IdSousProcessus);
        $processus=Processus::all();
        $idsociete=Auth::user()->IdSociete;

        $SousPilote=DB::table('users')
                            ->select('users.*')
                            ->where('users.SousPilote', '=', '1')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->get();    

        return view('processus.sousprocessus.modifier', compact('sousProcessus', 'processus', 'SousPilote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SousProcessus  $sousProcessus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdSousProcessus, SousProcessus $SousProcessus)
    {
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        $SousProcessus=SousProcessus::find($IdSousProcessus);

        $ValAncienne='';
        $ValNouveau='';

        if ($SousProcessus->IdProcessus != $request->IdProcessus)
        {
            $ValAncienne='IdProcessus ='. $SousProcessus->IdProcessus .chr(13).chr(10);
            $ValNouveau='IdProcessus :'. $request->IdProcessus .chr(13).chr(10);
        }
        
        if ($SousProcessus->CodeSousProcessus != $request->CodeSousProcessus)
        {
            $ValAncienne=$ValAncienne .'CodeSousProcessus ='. $SousProcessus->CodeSousProcessus .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'CodeSousProcessus ='. $request->CodeSousProcessus .chr(13).chr(10);
        }
        
        if ($SousProcessus->LibSousProcessus != $request->LibSousProcessus)
        {
            $ValAncienne=$ValAncienne .'LibSousProcessus ='. $SousProcessus->LibSousProcessus .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'LibSousProcessus ='. $request->LibSousProcessus .chr(13).chr(10);
        }

        if ($SousProcessus->IdSousPilote != $request->IdSousPilote)
        {
            $ValAncienne=$ValAncienne .'IdSousPilote ='. $SousProcessus->IdSousPilote .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'IdSousPilote ='. $request->IdSousPilote .chr(13).chr(10);
        }

        $SousProcessus->IdProcessus = $request->IdProcessus;
        $SousProcessus->CodeSousProcessus = $request->CodeSousProcessus;
        $SousProcessus->LibSousProcessus = $request->LibSousProcessus;
        $SousProcessus->IdSousPilote = $request->IdSousPilote;
        $SousProcessus->IdSociete = $idsociete;

        $SousProcessus->save();

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Modification du sous processus '. $SousProcessus->CodeSousProcessus . ' - '. $SousProcessus->LibSousProcessus . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => $ValAncienne,
            'ValNouveau' => $ValNouveau,
            'Poste' => '',
            ]);

        return redirect('Processus/sousprocessus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SousProcessus  $sousProcessus
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdSousProcessus)
    {
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);
        $sousProcessus=SousProcessus::find($IdSousProcessus);

        SousProcessus::destroy($IdSousProcessus);

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Suppression du sous processus '. $sousProcessus->CodeSousProcessus . ' - '. $sousProcessus->LibSousProcessus . chr(13) . chr(10) . 'IdPilote ='. $sousProcessus->IdSousPilote . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Processus/sousprocessus');
    }
}
