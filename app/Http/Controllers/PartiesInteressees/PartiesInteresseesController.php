<?php

namespace App\Http\Controllers\PartiesInteressees;

use App\Http\Controllers\Controller;
use App\Models\PartiesInteressees;
use Illuminate\Http\Request;

use App\Models\NiveauImportance;
use App\Models\NiveauRelation;
use App\Models\Cotation;
use App\Models\Processus;

use Illuminate\Support\Facades\DB;

class PartiesInteresseesController extends Controller
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
        $arr['partiesinteressees']=DB::table('partiesinteressees')
                            ->join('Processus', 'partiesinteressees.IdProcessus','Processus.id')
                            ->join('NiveauImportance', 'partiesinteressees.IdNivImportance','NiveauImportance.IdNivImportance')
                            ->join('NiveauRelation', 'partiesinteressees.IdNivRelation','NiveauRelation.IdNivRelation')
                            ->join('Cotation', 'partiesinteressees.IdCotation','Cotation.IdCotation')
                            ->select('partiesinteressees.*', 'NiveauImportance.ValeurNivImportance', 'NiveauRelation.ValeurNivRelation', 'Cotation.ValeurCotation', 'Processus.LibProcessus')
                            ->get();

        return view('partiesinteressees.partiesinteressees.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Processus=Processus::all();
        $NiveauImportance=NiveauImportance::all();
        $NiveauRelation=NiveauRelation::all();
        $Cotation=Cotation::all();

        return view('partiesinteressees.partiesinteressees.ajout', compact('Processus', 'NiveauImportance', 'NiveauRelation', 'Cotation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PartiesInteressees $PartiesInteressees)
    {
        //dd($PartiesInteressees);

        $PartiesInteressees->IdProcessus = $request->IdProcessus;
        $PartiesInteressees->IdNivImportance = $request->IdNivImportance;
        $PartiesInteressees->IdNivRelation = $request->IdNivRelation;
        $PartiesInteressees->IdCotation = $request->IdCotation;
        $PartiesInteressees->LibPartiesInt = $request->LibPartiesInt;
        $PartiesInteressees->Contexte = $request->Contexte;
        $PartiesInteressees->Attentes = $request->Attentes;
        $PartiesInteressees->Risques = $request->Risques;

        $PartiesInteressees->DateRevision = $request->DateRevision;
        $PartiesInteressees->Opportunites = $request->Opportunites;

        $PartiesInteressees->Archiver = 0;

        $PartiesInteressees->save();

        return redirect('PartiesInteressees/partiesinteressees');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartiesInteressees  $partiesInteressees
     * @return \Illuminate\Http\Response
     */
    public function show(PartiesInteressees $partiesInteressees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartiesInteressees  $partiesInteressees
     * @return \Illuminate\Http\Response
     */
    public function edit($IdPartiesInt, PartiesInteressees $partiesInteressees)
    {
        $partiesInteressees=PartiesInteressees::find($IdPartiesInt);
        //dd($partiesInteressees);
        $arr['partiesInteressees']=$partiesInteressees;

        $Processus=Processus::all();
        $NiveauImportance=NiveauImportance::all();
        $NiveauRelation=NiveauRelation::all();
        $Cotation=Cotation::all();

        //return view('partiesinteressees.partiesinteressees.modifier')->with($arr);

        return view('partiesinteressees.partiesinteressees.modifier', compact('partiesInteressees', 'Processus', 'NiveauImportance', 'NiveauRelation', 'Cotation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PartiesInteressees  $partiesInteressees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdPartiesInt, PartiesInteressees $partiesInteressees)
    {
        $partiesInteressees=PartiesInteressees::find($IdPartiesInt);

        //dd($partiesInteressees);

        $partiesInteressees->IdProcessus = $request->IdProcessus;
        $partiesInteressees->IdNivImportance = $request->IdNivImportance;
        $partiesInteressees->IdNivRelation = $request->IdNivRelation;
        $partiesInteressees->IdCotation = $request->IdCotation;
        $partiesInteressees->LibPartiesInt = $request->LibPartiesInt;
        $partiesInteressees->Contexte = $request->Contexte;
        $partiesInteressees->Attentes = $request->Attentes;
        $partiesInteressees->Risques = $request->Risques;
        $partiesInteressees->DateRevision = $request->DateRevision;

        $partiesInteressees->Opportunites = $request->Opportunites;

        $partiesInteressees->Archiver = 0;
        
        //dd($partiesInteressees);

        $partiesInteressees->save();

        return redirect('PartiesInteressees/partiesinteressees');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartiesInteressees  $partiesInteressees
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(PartiesInteressees $partiesInteressees)
    {
        //
    }
    */
    public function destroy($IdPartiesInt)
    {
        PartiesInteressees::destroy($IdPartiesInt);
        return redirect('PartiesInteressees/partiesinteressees');
    }
}
