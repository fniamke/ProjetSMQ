<?php

namespace App\Http\Controllers\Taches;

use App\Http\Controllers\Controller;
use App\Models\Taches;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\TypeMoyen;
use App\Models\Processus;

use App\Models\PlanActions;
use App\Models\user;

use Illuminate\Support\Facades\Auth;
use App\Models\Societe;
use App\Models\Mouchard;
use App\Models\Messages;

use Illuminate\Support\Facades\Mail;
use App\Mail\MessageAEnvoyer;

class TachesController extends Controller
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

     //->join('users', 'processus.IdPilote','users.id')
    public function index()
    {
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        /*
        SELECT taches.*, LibPlanaction, LibProcessus, users.name as Intervenant, users_1.name as Demandeur

FROM ((((taches INNER JOIN planactions ON taches.IdPlanaction = planactions.IdPlanaction) INNER JOIN users ON taches.IdIntervenant = users.id) INNER JOIN users AS users_1 ON taches.IdDemandeur = users_1.id) INNER JOIN processus ON planactions.IdProcessus = processus.id) INNER JOIN typemoyen ON taches.IdTypeMoyen = typemoyen.IdTypeMoyen
*/

        //$arr['Taches']=DB::select('call ListeTaches(?).array($idsociete)');
        $arr['Taches']=DB::select('call ListeTaches('. $idsociete . ')');
        //dd($arr);
        /*
        $arr['Taches']=DB::table('taches')
                        ->join('planactions', 'taches.IdPlanaction','planactions.IdPlanaction')
                        ->join('processus', 'planactions.IdProcessus','processus.id')
                        ->join('users', 'taches.IdIntervenant','users.id')
                        ->join('typemoyen', 'taches.IdTypeMoyen','typemoyen.IdTypeMoyen')
                        ->select('taches.*', 'planactions.LibPlanaction', 'processus.LibProcessus', 'users.name', 'typemoyen.LibTypeMoyen')
                        ->where('users.IdSociete', '=', $idsociete)
                        ->get();
        */

        $mouchard = Mouchard::create([
                            'DateEvmt'=>now(),
                            'NomEmploye' => Auth::user()->name,
                            'TypeAction' => 1,
                            'Action' => 'Visualisation de la liste des tâches de la société '. $societe->NomSociete,
                            'ValAncienne' => '',
                            'ValNouveau' => '',
                            'Poste' => '',
                            ]);

        

        return view('taches.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $PlanActions=PlanActions::all();
        $Intervenant=DB::table('users')
                            ->select('users.*')
                            ->get();
                            
        $TypeMoyen=TypeMoyen::all();
        return view('taches.ajout', compact('PlanActions', 'Intervenant', 'TypeMoyen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Taches $Taches)
    {
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        $Taches->IdPlanaction = $request->IdPlanaction;
        $Taches->LibTaches = $request->LibTaches;
        $Taches->IdIntervenant = $request->IdIntervenant;
        $Taches->IdTypeMoyen = $request->IdTypeMoyen;
        $Taches->DateDebut = $request->DateDebut;
        $Taches->DateFin = $request->DateFin;
        $Taches->Etat =0;
        $Taches->IdSociete = $idsociete;
        $Taches->IdDemandeur = $request->IdDemandeur;
        
        $Taches->save();

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Création de la tâche '. $Taches->LibTaches . chr(13) . chr(10) . 'IdPlanaction ='. $Taches->IdPlanaction . chr(13) . chr(10) . 'IdIntervenant ='. $Taches->IdIntervenant .chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        $expediteur=user::find($Taches->IdIntervenant);
        $destinataire=user::find($Taches->IdDemandeur);

        $messages = Messages::create([
            'IdSociete' => $idsociete,
            'IdOrigine' => $Taches->IdTaches,
            'IdExpediteur'=> $Taches->IdDemandeur,
            'Expediteur' => $expediteur->name,
            'emailExpediteur' => $expediteur->email,
            'IdDestinataire' => $Taches->IdIntervenant,
            'Destinataire' => $destinataire->name,
            'emailDestinataire' => $destinataire->email,
            'message' => 'Bonjour Mr/Mme ' . $destinataire->name . ',' .chr(13).chr(13).chr(10). 'Mr/Mme '. $expediteur->name . ' vous a envoyé une tâche.',
            'statut' =>0,
            ]);

        $mailable = new MessageAEnvoyer($messages);
        //Mail::to(env('ADMIN_EMAIL'))->send($mailable);
        Mail::to($destinataire->email)->send($mailable);

        return redirect('Taches/taches');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taches  $taches
     * @return \Illuminate\Http\Response
     */
    public function show($IdProcessus, Taches $taches)
    {
        $processus=Processus::find($IdProcessus);
        $pilote=user::find($processus->IdPilote);

        $Listetaches=DB::table('processus')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->join('indicateurs', 'processus.id','indicateurs.IdProcessus')
                            ->join('planactions', 'processus.id','planactions.IdProcessus')
                            ->join('taches', 'planactions.IdPlanaction','taches.IdPlanaction')
                            ->join('typemoyen', 'taches.IdTypeMoyen','typemoyen.IdTypeMoyen')
                            ->select('processus.LibProcessus', 'users.name', 'indicateurs.LibIndicateur', 'planactions.LibPlanaction', 'taches.*', 'typemoyen.LibTypeMoyen')
                            ->where('users.pilote', '=', '1')
                            ->where('processus.id', '=', $IdProcessus)
                            ->get();

        return view('taches.show', compact('Listetaches', 'processus', 'pilote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Taches  $taches
     * @return \Illuminate\Http\Response
     */
    public function edit($vparams, Taches $Taches)
    {
        $pos=strrpos($vparams,"¤"); //déterminer la position du caractère ¤ dans la variable vparams
        $IdTaches=substr($vparams,0,$pos); 

        $IdTaches=(int)$IdTaches;

        $TypeAction=substr($vparams,-1,1); 

        $Taches=Taches::find($IdTaches);
        $PlanActions=PlanActions::all();
        $Intervenant=DB::table('users')
                            ->select('users.*')
                            ->get();

        $TypeMoyen=TypeMoyen::all();

        if ($TypeAction==1)
        {
            //Affichage de la tâche à modifier
            return view('taches.modifier', compact('Taches', 'PlanActions','Intervenant', 'TypeMoyen', 'TypeAction'));
        }
        elseif ($TypeAction==2)
        {
            //Affichage de la tâche à traiter
            return view('taches.traiter', compact('Taches', 'PlanActions','Intervenant', 'TypeMoyen', 'TypeAction'));
        }
        else
        {
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Taches  $taches
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vparams, Taches $Taches)
    {
        $pos=strrpos($vparams,"¤"); //déterminer la position du caractère ¤ dans la variable vparams 

        $IdTaches=substr($vparams,0,$pos); 

        $IdTaches=(int)$IdTaches;

        $TypeAction=substr($vparams,-1,1); 

        $Taches=Taches::find($IdTaches);

        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);

        if ($TypeAction==1)
        {
            $ValAncienne='';
            $ValNouveau='';
            $LibTaches=$Taches->LibTaches;

            if ($Taches->IdPlanaction != $request->IdPlanaction)
            {
                $ValAncienne='IdPlanaction ='. $Taches->IdPlanaction .chr(13).chr(10);
                $ValNouveau='IdPlanaction :'. $request->IdPlanaction .chr(13).chr(10);
            }
            
            if ($Taches->LibTaches != $request->LibTaches)
            {
                $ValAncienne=$ValAncienne .'LibTaches ='. $Taches->LibTaches .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'LibTaches ='. $request->LibTaches .chr(13).chr(10);
            }
            
            if ($Taches->IdIntervenant != $request->IdIntervenant)
            {
                $ValAncienne=$ValAncienne .'IdIntervenant ='. $Taches->IdIntervenant .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'IdIntervenant ='. $request->IdIntervenant .chr(13).chr(10);
            }

            if ($Taches->IdTypeMoyen != $request->IdTypeMoyen)
            {
                $ValAncienne=$ValAncienne .'IdTypeMoyen ='. $Taches->IdTypeMoyen .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'IdTypeMoyen ='. $request->IdTypeMoyen .chr(13).chr(10);
            }

            if ($Taches->DateDebut != $request->DateDebut)
            {
                $ValAncienne=$ValAncienne .'DateDebut ='. $Taches->DateDebut .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'DateDebut ='. $request->DateDebut .chr(13).chr(10);
            }

            if ($Taches->DateFin != $request->DateFin)
            {
                $ValAncienne=$ValAncienne .'DateFin ='. $Taches->DateFin .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'DateFin ='. $request->DateFin .chr(13).chr(10);
            }

            if ($Taches->IdDemandeur != $request->IdDemandeur)
            {
                $ValAncienne=$ValAncienne .'IdDemandeur ='. $Taches->IdDemandeur .chr(13).chr(10);
                $ValNouveau=$ValNouveau .'IdDemandeur ='. $request->IdDemandeur .chr(13).chr(10);
            }

            $Taches->IdPlanaction = $request->IdPlanaction;
            $Taches->LibTaches = $request->LibTaches;
            $Taches->IdIntervenant = $request->IdIntervenant;
            $Taches->IdTypeMoyen = $request->IdTypeMoyen;
            $Taches->DateDebut = $request->DateDebut;
            $Taches->DateFin = $request->DateFin;
            $Taches->Etat =0;
            $Taches->IdSociete = $idsociete;
            $Taches->IdDemandeur = $request->IdDemandeur;

            $Taches->save();

            $mouchard = Mouchard::create([
                    'DateEvmt'=>now(),
                    'NomEmploye' => Auth::user()->name,
                    'TypeAction' => 1,
                    'Action' => 'Modification de la tâche '. $LibTaches . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
                    'ValAncienne' => $ValAncienne,
                    'ValNouveau' => $ValNouveau,
                    'Poste' => '',
                    ]);

            $expediteur=user::find($Taches->IdIntervenant);
            $destinataire=user::find($Taches->IdDemandeur);
            
            $messages=DB::table('messages')
                                ->select('id')
                                ->where('IdSociete', '=', $idsociete)
                                ->where('IdOrigine', '=', $Taches->IdTaches)
                                ->get();

            foreach($messages as $C)
            {
                $idmessage=$C->id;
            }

            //dd($idmessage);

            Messages::destroy($idmessage);

            $messages = Messages::create([
                'IdSociete' => $idsociete,
                'IdOrigine' => $Taches->IdTaches,
                'IdExpediteur'=> $Taches->IdDemandeur,
                'Expediteur' => $expediteur->name,
                'emailExpediteur' => $expediteur->email,
                'IdDestinataire' => $Taches->IdIntervenant,
                'Destinataire' => $destinataire->name,
                'emailDestinataire' => $destinataire->email,
                'message' => 'Bonjour Mr/Mme ' . $destinataire->name . ',' .chr(13).chr(10). 'Mr/Mme '. $expediteur->name .'vous a envoyé une tâche.'.chr(13).chr(10). 'Veuillez consulter vos mails SVP!',
                'statut' =>0,
                ]);

            return redirect('Taches/taches');    
        }
        else
        {
            $Taches->Etat =1;
            
            $Taches->save();  

            $mouchard = Mouchard::create([
                    'DateEvmt'=>now(),
                    'NomEmploye' => Auth::user()->name,
                    'TypeAction' => 1,
                    'Action' => 'Traitement de la tâche '. $Taches->LibTaches . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
                    'ValAncienne' => '',
                    'ValNouveau' => '',
                    'Poste' => '',
                    ]); 

            $expediteur=user::find($Taches->IdIntervenant);
            $destinataire=user::find($Taches->IdDemandeur);

            $messages = Messages::create([
                'IdSociete' => $idsociete,
                'IdOrigine' => $Taches->IdTaches,
                'IdExpediteur'=> $Taches->IdIntervenant,
                'Expediteur' => $destinataire->name,
                'emailExpediteur' => $destinataire->email,
                'IdDestinataire' => $Taches->IdDemandeur,
                'Destinataire' => $expediteur->name,
                'emailDestinataire' => $expediteur->email,
                'message' => 'Bonjour Mr/Mme ' . $expediteur->name . ',' .chr(13).chr(10). 'Mr/Mme '. $destinataire->name .'vous a envoyé une tâche.'.chr(13).chr(10). 'Veuillez consulter vos mails SVP!',
                'statut' =>0,
                ]);

            return redirect('Taches/taches');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taches  $taches
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdTaches)
    {
        $taches=Taches::find($IdTaches);
        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);


        $messages=DB::table('messages')
                            ->select('messages.*')
                            ->where('IdSociete', '=', $idsociete)
                            ->where('IdOrigine', '=', $taches->IdTaches)
                            ->get();

        foreach($messages as $C)
        {
            $idmessage=$C->id;
        }

        Messages::destroy($idmessage);

        Taches::destroy($IdTaches);

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Suppression de la tâche ' . $taches->LibTaches . chr(13) . chr(10) . 'Société '. $societe->NomSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Taches/taches');
    }
}
