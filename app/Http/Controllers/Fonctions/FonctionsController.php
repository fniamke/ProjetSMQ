<?php

namespace App\Http\Controllers\Fonctions;

use App\Http\Controllers\Controller;
use App\Models\Fonctions;
use Illuminate\Http\Request;

use App\Models\Mouchard;
use Illuminate\Support\Facades\Auth;

class FonctionsController extends Controller
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
        $arr['Fonctions']=Fonctions::all();
        return view('fonctions.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fonctions.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Fonctions $Fonctions)
    {
        $Fonctions->LibFonction = $request->LibFonction;
        $Fonctions->save();

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Création de la fonction '.$Fonctions->LibFonction.' ayant id '.$Fonctions->id,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Fonctions/fonctions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fonctions  $fonctions
     * @return \Illuminate\Http\Response
     */
    public function show(Fonctions $fonctions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fonctions  $fonctions
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Fonctions $fonctions)
    {
        $fonctions=Fonctions::find($id);
        $arr['Fonctions']=$fonctions;
        return view('fonctions.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fonctions  $fonctions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Fonctions $fonctions)
    {
        $fonctions=Fonctions::find($id);
        
        $ancfonctions=$fonctions->LibFonction;
        //dd($ancfonctions .'  '. $request->LibFonction);
        $fonctions->LibFonction = $request->LibFonction;
        $fonctions->save();

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Modification de la fonction ayant id '.$fonctions->id,
            'ValAncienne' => $ancfonctions,
            'ValNouveau' => $fonctions->LibFonction,
            'Poste' => '',
            ]);

        return redirect('Fonctions/fonctions');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fonctions  $fonctions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fonctions=Fonctions::find($id);
        //dd($fonctions);
        Fonctions::destroy($id);

        $mouchard = Mouchard::create([
            'DateEvmt'=>now(),
            'NomEmploye' => Auth::user()->name,
            'TypeAction' => 1,
            'Action' => 'Suppression de la fonction '.$fonctions->LibFonction.' ayant id '.$fonctions->id,
            'ValAncienne' => '',
            'ValNouveau' => '',
            'Poste' => '',
            ]);

        return redirect('Fonctions/fonctions');
    }
}
