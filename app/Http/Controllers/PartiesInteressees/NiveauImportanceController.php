<?php

namespace App\Http\Controllers\PartiesInteressees;

use App\Http\Controllers\Controller;
use App\Models\NiveauImportance;
use Illuminate\Http\Request;

class NiveauImportanceController extends Controller
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
        $arr['niveauimportance']=NiveauImportance::all();
        return view('partiesinteressees.niveauimportance.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partiesinteressees.niveauimportance.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, NiveauImportance $niveauimportance)
    {
        $niveauimportance->LibNivImportance = $request->LibNivImportance;
        $niveauimportance->ValeurNivImportance = $request->ValeurNivImportance;
        $niveauimportance->save();
        return redirect('PartiesInteressees/niveauimportance');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NiveauImportance  $niveauImportance
     * @return \Illuminate\Http\Response
     */
    public function show(NiveauImportance $niveauImportance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NiveauImportance  $niveauImportance
     * @return \Illuminate\Http\Response
     */
    public function edit($idnivimportance, NiveauImportance $niveauImportance)
    {
        $niveauimportance=NiveauImportance::find($idnivimportance);
        $arr['niveauimportance']=$niveauimportance;
        return view('partiesinteressees.niveauimportance.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NiveauImportance  $niveauImportance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idnivimportance, NiveauImportance $niveauImportance)
    {
        $niveauImportance=NiveauImportance::find($idnivimportance);
        $niveauImportance->LibNivImportance = $request->LibNivImportance;
        $niveauImportance->ValeurNivImportance = $request->ValeurNivImportance;
        $niveauImportance->save();
        return redirect('PartiesInteressees/niveauimportance');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NiveauImportance  $niveauImportance
     * @return \Illuminate\Http\Response
     */
    public function destroy($idnivimportance)
    {
        NiveauImportance::destroy($idnivimportance);
        return redirect('PartiesInteressees/niveauimportance');
    }
}
