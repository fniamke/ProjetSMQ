<?php

namespace App\Http\Controllers\Processus;

use App\Http\Controllers\Controller;
use App\Models\Typesprocessus;
use Illuminate\Http\Request;

class TypesProcessusController extends Controller
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
        $arr['Typesprocessus']=Typesprocessus::all();
        return view('processus.typesprocessus.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['Typesprocessus']=Typesprocessus::all();
        return view('processus.typesprocessus.ajout')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Typesprocessus $typesprocessus)
    {
        $typesprocessus->Id = $request->Id;
        $typesprocessus->LibTypesProcessus = $request->LibTypesProcessus;
        $typesprocessus->save();
        return redirect('Processus/typesprocessus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Typesprocessus  $typesprocessus
     * @return \Illuminate\Http\Response
     */
    public function show(Typesprocessus $typesprocessus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Typesprocessus  $typesprocessus
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Typesprocessus $typesprocessus)
    {
        $typesprocessus=Typesprocessus::find($id);
        $arr['Typesprocessus']=$typesprocessus;
        return view('processus.typesprocessus.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Typesprocessus  $typesprocessus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Typesprocessus $typesprocessus)
    {
       $Typesprocessus=Typesprocessus::find($id);

        //$Typesprocessus->Id = $request->Id;
        $Typesprocessus->LibTypesProcessus = $request->LibTypesProcessus;
        $Typesprocessus->save();
        return redirect('Processus/typesprocessus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Typesprocessus  $typesprocessus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Typesprocessus::destroy($id);
        return redirect('Processus/typesprocessus');
    }
}
