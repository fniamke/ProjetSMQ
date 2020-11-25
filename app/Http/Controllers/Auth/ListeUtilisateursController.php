<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ListeUtilisateurs;
use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Fonctions;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use App\Models\Societe;
use App\Models\Mouchard;
use Illuminate\Support\Facades\Auth;

class ListeUtilisateursController extends Controller
{
   
   /*public function __construct()
    {
        $this->middleware('auth');
    }
*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$arr['ListUsers']=user::all();
        $idsociete=Auth::user()->IdSociete;
        
        $societe=Societe::find($idsociete);
        //dd($societe);

        $ListUsers=DB::table('users')
                            ->Join('societe', 'users.IdSociete','societe.IdSociete')
                            ->leftJoin('fonctions', 'users.Idfonction','fonctions.id')
                            ->select('users.*', 'fonctions.LibFonction','societe.NomSociete')
                            ->where('users.IdSociete', '=', $idsociete)
                            ->orderBy('users.name', 'asc')
                            ->get();
       //dd($arr);

       $mouchard = Mouchard::create([
                            'DateEvmt'=>now(),
                            'NomEmploye' => Auth::user()->name,
                            'TypeAction' => 1,
                            'Action' => 'Visualisation de la liste des utilisateurs de la société '. $societe->NomSociete,
                            'ValAncienne' => '',
                            'ValNouveau' => '',
                            'Poste' => '',
                            ]);

        //return view('auth.listusers')->with($arr);
        return view('auth.listusers', compact('ListUsers', 'societe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fonctions=Fonctions::all();
        $ListeUtilisateurs=user::all();
        $societe=Societe::all();

        //dd($fonctions);
        
        return view('auth.userajout', compact('ListeUtilisateurs', 'fonctions', 'societe'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ListeUtilisateurs $ListeUtilisateurs)
    {
        //dd($request->IdSociete);
        //$IdSociete=(int)$request->IdSociete;

        //dd($listeUtilisateurs->IdSociete);

        $ListeUtilisateurs->name = $request->name;
        $ListeUtilisateurs->email = $request->email;
        $ListeUtilisateurs->password = Hash::make($request->password);
        $ListeUtilisateurs->pilote = $request->pilote;
        $ListeUtilisateurs->Idfonction = $request->Idfonction;
        $ListeUtilisateurs->SousPilote = $request->SousPilote;
        $ListeUtilisateurs->Auditeur = $request->Auditeur;
        $ListeUtilisateurs->IdSociete = (int)$request->IdSociete;

        $ListeUtilisateurs->save();

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Création de lutilisateur '.$ListeUtilisateurs->name.' ayant id '.$ListeUtilisateurs->id . ' pour la société ayant lid '. $ListeUtilisateurs->IdSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListeUtilisateurs  $listeUtilisateurs
     * @return \Illuminate\Http\Response
     */
    public function show(ListeUtilisateurs $listeUtilisateurs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListeUtilisateurs  $listeUtilisateurs
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ListeUtilisateurs $ListeUtilisateurs)
    {
        $ListeUtilisateurs=user::find($id);
        //$arr['ListeUtilisateurs']=$listeUtilisateurs;
        $fonctions=Fonctions::all();
        $societe=Societe::all();
        
        //dd($ListeUtilisateurs);

        //return view('auth.useredit')->with($arr);
        return view('auth.useredit', compact('ListeUtilisateurs', 'fonctions', 'societe'));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListeUtilisateurs  $listeUtilisateurs
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, ListeUtilisateurs $listeUtilisateurs)
    {
        $listeUtilisateurs=user::find($id);
        $ValAncienne='';
        $ValNouveau='';

        if ($listeUtilisateurs->name != $request->name)
        {
            $ValAncienne='Name :'. $listeUtilisateurs->name .chr(13).chr(10);
            $ValNouveau='Name :'. $request->name .chr(13).chr(10);
        }
        
        if ($listeUtilisateurs->email != $request->email)
        {
            $ValAncienne=$ValAncienne .'email :'. $listeUtilisateurs->email .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'email :'. $request->email .chr(13).chr(10);
        }
        
        if ($listeUtilisateurs->pilote != $request->pilote)
        {
            $ValAncienne=$ValAncienne .'pilote :'. $listeUtilisateurs->pilote .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'pilote :'. $request->pilote .chr(13).chr(10);
        }

        //dd($listeUtilisateurs->Idfonction . '  '. $request->Idfonction);

        if ($listeUtilisateurs->Idfonction != $request->Idfonction)
        {
            $ValAncienne=$ValAncienne .'Idfonction :'. $listeUtilisateurs->Idfonction .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'Idfonction :'. $request->Idfonction .chr(13).chr(10);
        }
        
        if ($listeUtilisateurs->SousPilote != $request->SousPilote)
        {
            $ValAncienne=$ValAncienne .'SousPilote :'. $listeUtilisateurs->SousPilote .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'SousPilote :'. $request->SousPilote .chr(13).chr(10);
        }
        
        if ($listeUtilisateurs->Auditeur != $request->Auditeur)
        {
            $ValAncienne=$ValAncienne .'Auditeur :'. $listeUtilisateurs->Auditeur .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'Auditeur :'. $request->Auditeur .chr(13).chr(10);
        }

        if ($listeUtilisateurs->IdSociete != $request->IdSociete)
        {
            $ValAncienne=$ValAncienne .'IdSociete :'. $listeUtilisateurs->IdSociete .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'IdSociete :'. $request->IdSociete .chr(13).chr(10);
        }
        //dd($ValAncienne . '  '. $ValNouveau);

        $listeUtilisateurs->name = $request->name;
        $listeUtilisateurs->email = $request->email;
        $listeUtilisateurs->password = Hash::make($request->password);
        $listeUtilisateurs->pilote = $request->pilote;
        $listeUtilisateurs->Idfonction = $request->Idfonction;

        $listeUtilisateurs->SousPilote = $request->SousPilote;
        $listeUtilisateurs->Auditeur = $request->Auditeur;
        $listeUtilisateurs->IdSociete = $request->IdSociete;

        $listeUtilisateurs->save();

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Modification de lutilisateur '.$listeUtilisateurs->name.' ayant id '.$listeUtilisateurs->id . ' de la société ayant lid '. $listeUtilisateurs->IdSociete,
            'ValAncienne' => $ValAncienne,
            'ValNouveau' => $ValNouveau,
            'Poste' => '',
            ]);

        return redirect('Auth');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListeUtilisateurs  $listeUtilisateurs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ListeUtilisateurs=user::find($id);
        user::destroy($id);
         
        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Suppression de lutilisateur '.$ListeUtilisateurs->name.' ayant id '.$ListeUtilisateurs->id . ' de la société ayant lid '. $ListeUtilisateurs->IdSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Auth');
    }
}
