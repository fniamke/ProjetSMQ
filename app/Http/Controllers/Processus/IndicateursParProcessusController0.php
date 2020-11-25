<?php

namespace App\Http\Controllers\Processus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Processus;
use Illuminate\Support\Facades\DB;

class IndicateursParProcessusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['listeprocessus']=DB::table('processus')
                            ->join('users', 'processus.IdPilote','users.id')
                            ->join('indicateurs', 'processus.id','indicateurs.IdProcessus')
                            ->select('processus.LibProcessus, processus.ChampApplication', 'users.name', 'indicateurs.LibIndicateur')
                            ->where('users.pilote', '=', '1')
                            ->get();
        return view('processus.processus.listeprocessus')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
