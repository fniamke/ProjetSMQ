<?php

namespace App\Http\Controllers\Societe;

use App\Http\Controllers\Controller;
use App\Models\Societe;
use Illuminate\Http\Request;

use App\Models\Mouchard;
use Illuminate\Support\Facades\Auth;

class SocieteController extends Controller
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
        $arr['societe']=Societe::all();

        $mouchard = Mouchard::create([
                            'DateEvmt'=>now(),
                            'NomEmploye' => Auth::user()->name,
                            'TypeAction' => 1,
                            'Action' => 'Visualisation de la liste des sociétés ',
                            'ValAncienne' => '',
                            'ValNouveau' => '',
                            'Poste' => '',
                            ]);

        return view('societe.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('societe.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Societe $societe)
    {
        
        $societe->NomSociete = $request->NomSociete;
        $societe->NomContact = $request->NomContact;
        $societe->email = $request->email;
        $societe->Telephone = $request->Telephone;
        $societe->Fax = $request->Fax;
        $societe->Statut = 0;

        $societe->save();
        
        //dd($societe->IdSociete);

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Création de la société '.$societe->NomSociete.' ayant id '.$societe->IdSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Societe/societe');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function show(Societe $societe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function edit(Societe $societe)
    {
        //dd($societe);
        //$societe=Societe::find($id);
        $arr['societe']=$societe;
        return view('societe.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $idsociete, Societe $societe)
    public function update(Request $request, Societe $societe)
    {
        
        $ValAncienne='';
        $ValNouveau='';
        $NomSociete=$societe->NomSociete;

        if ($societe->NomSociete != $request->NomSociete)
        {
            $ValAncienne='NomSociete ='. $societe->NomSociete .chr(13).chr(10);
            $ValNouveau='NomSociete :'. $request->NomSociete .chr(13).chr(10);
        }
        
        if ($societe->NomContact != $request->NomContact)
        {
            $ValAncienne=$ValAncienne .'NomContact ='. $societe->NomContact .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'NomContact ='. $request->NomContact .chr(13).chr(10);
        }
        
        if ($societe->email != $request->email)
        {
            $ValAncienne=$ValAncienne .'email ='. $societe->email .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'email ='. $request->email .chr(13).chr(10);
        }

        if ($societe->Telephone != $request->Telephone)
        {
            $ValAncienne=$ValAncienne .'Telephone ='. $societe->Telephone .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'Telephone ='. $request->Telephone .chr(13).chr(10);
        }

        if ($societe->Fax != $request->Fax)
        {
            $ValAncienne=$ValAncienne .'Fax ='. $societe->Fax .chr(13).chr(10);
            $ValNouveau=$ValNouveau .'Fax ='. $request->Fax .chr(13).chr(10);
        }

        //dd($societe);
        //$societe=Societe::find($idsociete);
        $ancsociete=$societe->NomSociete;
        //dd($ancsociete .'  '. $request->NomSociete);
        $societe->NomSociete = $request->NomSociete;
        $societe->NomContact = $request->NomContact;
        $societe->email = $request->email;
        $societe->Telephone = $request->Telephone;
        $societe->Fax = $request->Fax;
        $societe->Statut = 0;

        $societe->save();

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Modification de la société ayant id '.$societe->IdSociete,
            'ValAncienne' =>$ValAncienne,
            'ValNouveau' => $ValNouveau,
            'Poste' => '',
            ]);

        return redirect('Societe/societe');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Societe  $societe
     * @return \Illuminate\Http\Response
     */
    public function destroy($idsociete)
    {
        $societe=Societe::find($idsociete);
        //dd($fonctions);
        Societe::destroy($idsociete);

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Suppression de la société '.$societe->NomSociete.' ayant id '.$societe->IdSociete,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

            return redirect('Societe/societe');   
    }
}
