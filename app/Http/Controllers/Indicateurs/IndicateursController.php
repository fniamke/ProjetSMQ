<?php

namespace App\Http\Controllers\Indicateurs;

use App\Http\Controllers\Controller;
use App\Models\Indicateurs;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Processus;
use App\Models\SousProcessus;
use App\Models\user;

use Illuminate\Support\Facades\Auth;
use App\Models\Societe;
use App\Models\Mouchard;

use Carbon\Carbon;
//use Carbon\DateTime;

class IndicateursController extends Controller
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
        /*
        $arr['Indicateurs']=DB::table('indicateurs')
                            ->join('processus', 'indicateurs.IdProcessus','processus.id')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->select('indicateurs.*', 'processus.LibProcessus', 'users.name')
                            ->where('users.pilote', '=', '1')
                            ->get();
*/
/*
        $arr['Indicateurs']=DB::table('indicateurs')
                            ->leftJoin('processus', 'indicateurs.IdProcessus','processus.id')
                            ->leftJoin('sousprocessus', 'indicateurs.IdSousProcessus','sousprocessus.IdSousProcessus')
                            ->leftJoin('users', 'sousprocessus.IdSousPilote','users.id')                    
                            ->select('indicateurs.*', 'processus.LibProcessus', 'users.name', 'sousprocessus.LibSousProcessus')
                            ->where(['users.SousPilote', '=', '1'], ['users.pilote', '=', '1'])
                            ->get();
where([
    ['status', '=', '1'],
    ['subscribed', '<>', '1'],
    */
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        $Indicateurs1=DB::table('indicateurs')
                    ->join('processus', 'indicateurs.IdProcessus','processus.id')
                    ->join('users', 'processus.IdPilote','users.id')
                    ->select('indicateurs.*', 'processus.LibProcessus', 'users.name')
                    ->where('users.pilote',  '1')
                    ->where('users.IdSociete', '=', $idsociete)
                    ->where('Archiver', '=', '0')
                    ->Orderby('processus.LibProcessus', 'asc')
                    ->Orderby('indicateurs.NumLigne', 'asc');
            
        $arr['Indicateurs']=DB::table('indicateurs')
                            ->join('sousprocessus', 'indicateurs.IdSousProcessus','sousprocessus.IdSousProcessus')
                            ->join('users', 'sousprocessus.IdSousPilote','users.id')
                            ->select('indicateurs.*', 'sousprocessus.LibSousProcessus as LibProcessus', 'users.name')
                            ->where('users.SousPilote', '=', '1')
                            ->where('Archiver', '=', '0')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->Orderby('sousprocessus.LibSousProcessus', 'asc')
                            ->Orderby('indicateurs.NumLigne', 'asc')
                            ->union($Indicateurs1)
                            ->get();

        $mouchard = Mouchard::create([
                            'DateEvmt'=>now(),
                            'NomEmploye' => Auth::user()->name,
                            'TypeAction' => 1,
                            'Action' => 'Visualisation de la liste des indicateurs de la société '. $societe->NomSociete,
                            'ValAncienne' => '',
                            'ValNouveau' => '',
                            'Poste' => '',
                            ]);

        return view('indicateurs.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$arr['processus']=Processus::all();
        //$processus=Processus::all();
        //$sousprocessus=SousProcessus::all();

        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        $processus=DB::table('Processus')
                            ->select('Processus.*')
                            ->where('processus.IdSociete', '=', $idsociete)
                            ->get();

        $sousprocessus=DB::table('SousProcessus')
                            ->select('SousProcessus.*')
                            ->where('SousProcessus.IdSociete', '=', $idsociete)
                            ->get();
        
        return view('indicateurs.ajout', compact('processus', 'sousprocessus'));;
        //return view('indicateurs.ajout')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Indicateurs $Indicateurs)
    {
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        $IdIndicateur=DB::table('indicateurs')
                                ->select('IdIndicateur')
                                ->max('IdIndicateur');
                                //->get();
        
        $IdIndicateur= ($IdIndicateur==null) ? 0 : $IdIndicateur ;                 
        $IdIndicateur=$IdIndicateur+1;
        //dd($IdIndicateur);

        $Indicateurs->IdIndicateur = $IdIndicateur;
        $Indicateurs->IdProcessus = $request->IdProcessus;
        $Indicateurs->IdSousProcessus = $request->IdSousProcessus;
        
        $Indicateurs->LibIndicateur = $request->LibIndicateur;
        $Indicateurs->Periodicite = $request->Periodicite;
        $Indicateurs->DateDebutPeriode= $request->DateDebutPeriode;
        $Indicateurs->DebutPeriode = $request->DebutPeriode;
        $Indicateurs->FinPeriode = $request->FinPeriode;
        $Indicateurs->Objectif = $request->Objectif;
        $Indicateurs->Resultat =0;
        $Indicateurs->Etat = 0;
        $Indicateurs->Observation ='';
        $Indicateurs->NumLigne =1;
        $Indicateurs->Archiver=0;
        $Indicateurs->IdSociete = $idsociete;

        $Indicateurs->save();

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Création de l'. "'" . 'indicateur '. $Indicateurs->LibIndicateur . chr(13) . chr(10) . 'IdProcessus ='. $Indicateurs->IdProcessus . chr(13) . chr(10) . 'IdSousProcessus ='. $Indicateurs->IdSousProcessus . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Indicateurs/indicateurs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Indicateurs  $indicateurs
     * @return \Illuminate\Http\Response
     */
    public function show($IdProcessus, Indicateurs $indicateurs)
    {
        //$indicateurs=Indicateurs::find($IdProcessus);
        $processus=Processus::find($IdProcessus);
        $pilote=user::find($processus->IdPilote);
        /*$pilote=DB::table('users')
                    ->where('id', '=', $processus->IdPilote)
                    ->get();
*/
        /*
        $arr['ListeIndicateursProcessus']=DB::table('indicateurs')
                            ->join('processus', 'indicateurs.IdProcessus','processus.id')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->select('indicateurs.*', 'processus.LibProcessus', 'users.name')
                            ->where('users.pilote', '=', '1')
                            ->where('processus.id', '=', $IdProcessus)
                            ->get();
        

        $ListeIndicateursProcessus=DB::table('indicateurs')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->leftJoin('processus', 'indicateurs.IdProcessus','processus.id')
                            ->leftJoin('sousprocessus', 'indicateurs.IdSousProcessus','sousprocessus.IdSousProcessus')
                            ->select('indicateurs.*', 'processus.LibProcessus', 'users.name', 'sousprocessus.LibSousProcessus')
                            ->where('users.pilote', '=', '1')
                            ->where('processus.id', '=', $IdProcessus)
                            ->get();
        */
        //return view('indicateurs.show')->with($arr);

        $ListeIndicateursProcessus1=DB::table('indicateurs')
                    ->join('processus', 'indicateurs.IdProcessus','processus.id')
                    ->join('users', 'processus.IdPilote','users.id')
                    ->select('indicateurs.*', 'processus.LibProcessus', 'users.name')
                    ->where('users.pilote',  '1')
                    ->where('processus.id',  $IdProcessus)
                    ;
                    
                    
                    
//dd($Indicateurs1->put('TypeProcessus',1)); //Permet d'arrêter l'exécution à ce niveau et afficher le contenu de la varaiable

    $ListeIndicateursProcessus=DB::table('indicateurs')
                            ->join('sousprocessus', 'indicateurs.IdSousProcessus','sousprocessus.IdSousProcessus')
                            ->join('users', 'sousprocessus.IdSousPilote','users.id')
                            ->join('processus', 'sousprocessus.IdProcessus','processus.id')
                            ->select('indicateurs.*', 'sousprocessus.LibSousProcessus as LibProcessus', 'users.name')
                            ->where('users.SousPilote', '=', '1')
                            ->where('processus.id',  $IdProcessus)
                            ->union($ListeIndicateursProcessus1)
                            ->get();

        return view('indicateurs.show', compact('ListeIndicateursProcessus', 'processus', 'pilote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Indicateurs  $indicateurs
     * @return \Illuminate\Http\Response
     */
    public function edit($vparams, Indicateurs $indicateurs)
    {
        //dd($vparams);

        $pos=strrpos($vparams,"¤"); //déterminer la position du caractère ¤ dans la variable $vparams
        $IdIndicateur=substr($vparams,0,$pos); 
        //dd($IdIndicateur);

        $IdIndicateur=(int)$IdIndicateur;

        //dd($IdIndicateur);

        $TypeAction=substr($vparams,-1,1); 
        //dd($TypeAction);

        $indicateurs=Indicateurs::find($IdIndicateur);
        //dd($indicateurs);

        $processus=Processus::all();
        $sousprocessus=SousProcessus::all();

        if ($TypeAction==1)
        {
            //Affichage de l'indicateur à modifier
            return view('indicateurs.modifier', compact('indicateurs', 'processus', 'sousprocessus', 'TypeAction'));
        }
        elseif ($TypeAction==2)
        {
            //Affichage de l'indicateur à traiter
            return view('indicateurs.traiter', compact('indicateurs', 'processus', 'sousprocessus', 'TypeAction'));
        }
        else
        {
            //Affichage de l'historique des indicateurs
            $idsociete=Auth::user()->IdSociete;
            $societe=Societe::find($idsociete);

            //dd($indicateurs->IdIndicateur);
            $Indicateurs1=DB::table('indicateurs')
                        ->join('processus', 'indicateurs.IdProcessus','processus.id')
                        ->join('users', 'processus.IdPilote','users.id')
                        ->select('indicateurs.*', 'processus.LibProcessus', 'users.name')
                        ->where('users.pilote',  '1')
                        ->where('users.IdSociete', '=', $idsociete)
                        ->where('Archiver', '=', '1')
                        ->where('indicateurs.IdIndicateur', '=', $indicateurs->IdIndicateur)
                        ->Orderby('processus.LibProcessus', 'asc')
                        ->Orderby('indicateurs.NumLigne', 'asc');
                        //->get();
            //dd($Indicateurs1);
            $HistoriqueIndicateurs=DB::table('indicateurs')
                                ->join('sousprocessus', 'indicateurs.IdSousProcessus','sousprocessus.IdSousProcessus')
                                ->join('users', 'sousprocessus.IdSousPilote','users.id')
                                ->select('indicateurs.*', 'sousprocessus.LibSousProcessus as LibProcessus', 'users.name')
                                ->where('users.SousPilote', '=', '1')
                                ->where('Archiver', '=', '1')
                                ->where('users.IdSociete', '=', $idsociete)
                                ->where('indicateurs.IdIndicateur', '=', $indicateurs->IdIndicateur)
                                ->Orderby('sousprocessus.LibSousProcessus', 'asc')
                                ->Orderby('indicateurs.NumLigne', 'asc')
                                ->union($Indicateurs1)
                                ->get();

            $mouchard = Mouchard::create([
                                'DateEvmt'=>now(),
                                'NomEmploye' => Auth::user()->name,
                                'TypeAction' => 1,
                                'Action' => 'Visualisation de l'. "'" . 'historique de l'. "'" . 'indicateur '. $indicateurs->LibIndicateur . ' de la société '. $societe->NomSociete,
                                'ValAncienne' => '',
                                'ValNouveau' => '',
                                'Poste' => '',
                                ]);

            //return view('indicateurs.index')->with($arr);

            return view('indicateurs.historique', compact('indicateurs', 'HistoriqueIndicateurs', 'TypeAction'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Indicateurs  $indicateurs
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $IdIndicateur, $TypeAction, Indicateurs $indicateurs)
    public function update(Request $request, $vparams, Indicateurs $indicateurs)
    //$IdIndicateur
    {
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        $pos=strrpos($vparams,"¤"); //déterminer la position du caractère ¤ dans la variable 

        $IdIndicateur=substr($vparams,0,$pos); 
        //dd($IdIndicateur);

        $IdIndicateur=(int)$IdIndicateur;

        //dd($IdIndicateur);

        $TypeAction=substr($vparams,-1,1); 
        //dd($TypeAction);

        //dd($TypeAction);

        $indicateurs=Indicateurs::find($IdIndicateur);
        //dd($indicateurs);

        if ($TypeAction==1)
        {
            $ValAncienne='';
            $ValNouveau='';

            if ($indicateurs->IdProcessus != $request->IdProcessus)
            {
                $ValAncienne='IdProcessus ='. $indicateurs->IdProcessus .chr(13).chr(10);
                $ValNouveau='IdProcessus :'. $request->IdProcessus .chr(13).chr(10);
            }
            
            if ($indicateurs->IdSousProcessus != $request->IdSousProcessus)
            {
                $ValAncienne=$ValAncienne .'IdSousProcessus ='. $indicateurs->IdSousProcessus .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'IdSousProcessus ='. $request->IdSousProcessus .chr(13).chr(10);
            }
            
            if ($indicateurs->LibIndicateur != $request->LibIndicateur)
            {
                $ValAncienne=$ValAncienne .'LibIndicateur ='. $indicateurs->LibIndicateur .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'LibIndicateur ='. $request->LibIndicateur .chr(13).chr(10);
            }

            if ($indicateurs->Periodicite != $request->Periodicite)
            {
                $ValAncienne=$ValAncienne .'Periodicite ='. $indicateurs->Periodicite .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'Periodicite ='. $request->Periodicite .chr(13).chr(10);
            }
            
            if ($indicateurs->DateDebutPeriode != $request->DateDebutPeriode)
            {
                $ValAncienne=$ValAncienne .'DateDebutPeriode ='. $indicateurs->DateDebutPeriode .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'DateDebutPeriode ='. $request->DateDebutPeriode .chr(13).chr(10);
            }
            
            if ($indicateurs->DebutPeriode != $request->DebutPeriode)
            {
                $ValAncienne=$ValAncienne .'DebutPeriode ='. $indicateurs->DebutPeriode .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'DebutPeriode ='. $request->DebutPeriode .chr(13).chr(10);
            }

            if ($indicateurs->FinPeriode != $request->FinPeriode)
            {
                $ValAncienne=$ValAncienne .'FinPeriode ='. $indicateurs->FinPeriode .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'FinPeriode ='. $request->FinPeriode .chr(13).chr(10);
            }

            if ($indicateurs->Objectif != $request->Objectif)
            {
                $ValAncienne=$ValAncienne .'Objectif ='. $indicateurs->Objectif .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'Objectif ='. $request->Objectif .chr(13).chr(10);
            }

            $indicateurs->IdProcessus = $request->IdProcessus;
            $indicateurs->IdSousProcessus = $request->IdSousProcessus;
            $indicateurs->LibIndicateur = $request->LibIndicateur;
            $indicateurs->Periodicite = $request->Periodicite;
            $indicateurs->DateDebutPeriode= $request->DateDebutPeriode;
            $indicateurs->DebutPeriode = $request->DebutPeriode;
            $indicateurs->FinPeriode = $request->FinPeriode;
            $indicateurs->Objectif = $request->Objectif;
            $indicateurs->IdSociete = $idsociete;

            $mouchard = Mouchard::create([
                'DateEvmt'=>now(),
                'NomEmploye' => Auth::user()->name,
                'TypeAction' => 1,
                'Action' => 'Modification de l'. "'" . 'indicateur '. $indicateurs->LibIndicateur . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
                'ValAncienne' => $ValAncienne,
                'ValNouveau' => $ValNouveau,
                'Poste' => '',
                ]);
           
            $indicateurs->save();    
        }
        else
        {
            if ($indicateurs->Periodicite=='M')
            {
                $nbrejours=30;
            }
            elseif ($indicateurs->Periodicite=='T')
            {
                $nbrejours=90;   
            }
            else
            {
                $nbrejours=180;
            }

            //$DateDebutPeriode = Carbon::parse($indicateurs->DateDebutPeriode);
                        
            //dd($date1);

            //dd($DateDebutPeriode);

            //dd($indicateurs->Resultat);
            $indicateurs->Resultat =$request->Resultat;
            $indicateurs->Etat =1;
            $indicateurs->Observation =$request->Observation;

            $indicateurs->save();    
            //dd($idsociete);

            $mouchard = Mouchard::create([
                'DateEvmt'=>now(),
                'NomEmploye' => Auth::user()->name,
                'TypeAction' => 1,
                'Action' => 'Traitement de l'. "'" . 'indicateur '. $indicateurs->LibIndicateur . ' (ligne n° '. $indicateurs->NumLigne . ')'. chr(13) . chr(10) . 'Société '. $societe->NomSociete,
                'ValAncienne' => 'Resultat='. $indicateurs->Resultat . chr(13) . chr(10) .'Observation='. $indicateurs->Observation ,
                'ValNouveau' => '',
                'Poste' => '',
                ]);

            $maxnumligne=DB::table('indicateurs')
                                ->select('NumLigne')
                                ->where('IdIndicateur','=', $indicateurs->IdIndicateur)
                                ->max('NumLigne');

            //dd($maxnumligne);                    
            $maxnumligne= ($maxnumligne==null) ? 0 : $maxnumligne ;                 
            $maxnumligne=$maxnumligne+1;
            
            //dd($maxnumligne);

            // A revoir date debut période et autres
            
            //$date = now()->addDays(60);
            //dd($date);
            
            $DateDebutPeriode = Carbon::parse($request->DateDebutPeriode);
            $DateDebutPeriode=$DateDebutPeriode->addDays($nbrejours);
            $DebutPeriode=$DateDebutPeriode->format('M'). ' ' .$DateDebutPeriode->format('Y');
            
            $DateFinPeriode=$DateDebutPeriode->addDays($nbrejours);
            $FinPeriode=$DateFinPeriode->format('M'). ' ' .$DateFinPeriode->format('Y');
            //dd(mb_strtoupper($DateDebutPeriode));

            $indicateur = Indicateurs::create([
                'IdIndicateur' =>$indicateurs->IdIndicateur,
                'IdProcessus' => $indicateurs->IdProcessus,
                'IdSousProcessus' => $indicateurs->IdSousProcessus,
                'LibIndicateur' => $indicateurs->LibIndicateur,
                'Periodicite' => $indicateurs->Periodicite,
                'DateDebutPeriode' => $DateDebutPeriode,
                'DebutPeriode' => $DebutPeriode,
                'FinPeriode' => $FinPeriode,
                'Objectif' => $indicateurs->Objectif,
                'Resultat' => 0,
                'usage' => $indicateurs->IdProcessus,
                'Etat' => 0,
                'Observation' => '',
                'NumLigne' => $maxnumligne,
                'Archiver' => 0,
                'IdSociete' => $idsociete,
            ]);
            
            //dd($idsociete);

            //dd($indicateurs->LibIndicateur);

            $mouchard = Mouchard::create([
                'DateEvmt'=>now(),
                'NomEmploye' => Auth::user()->name,
                'TypeAction' => 1,
                'Action' => 'Création de la ligne n° '. $maxnumligne . ' de l'. "'" . 'indicateur '. $indicateurs->LibIndicateur . ' après traitement de la période '. $indicateurs->DebutPeriode. chr(13) . chr(10) . 'Société '. $societe->NomSociete,
                'ValAncienne' => '' ,
                'ValNouveau' => '',
                'Poste' => '',
                ]);
            
            //$maxnumligne=$maxnumligne+1;

            if($maxnumligne>2)
            {
                $maxnumligne=$maxnumligne-2;
                //dd($maxnumligne);
                $indicateur = DB::table('indicateurs')
                                ->select('indicateurs.*')
                                ->where('IdIndicateur', '=', $indicateurs->IdIndicateur)
                                ->where('NumLigne', '<=' , $maxnumligne)
                                ->where('Archiver', '=' , 0)
                                ->where('IdSociete', '=' , $idsociete)
                                ->update(['Archiver' => 1]);   
                
                //dd($indicateur);

                $mouchard = Mouchard::create([
                    'DateEvmt'=>now(),
                    'NomEmploye' => Auth::user()->name,
                    'TypeAction' => 1,
                    'Action' => 'Archivage de la ligne n° '. $maxnumligne . ' de l'. "'" . 'indicateur '. $indicateurs->LibIndicateur . ' après traitement de la période'. $indicateurs->DebutPeriode. chr(13) . chr(10) . 'Société '. $societe->NomSociete,
                    'ValAncienne' => '' ,
                    'ValNouveau' => '',
                    'Poste' => '',
                    ]);
            }

        }

        return redirect('Indicateurs/indicateurs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Indicateurs  $indicateurs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $indicateurs=Indicateurs::find($id);
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        Indicateurs::destroy($id);

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Suppression de l'. "'" . 'indicateur '. $indicateurs->LibIndicateur . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Indicateurs/indicateurs');
    }


}
