<?php

namespace App\Http\Controllers\TypeMoyen;

use App\Http\Controllers\Controller;
use App\Models\TypeMoyen;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class TypeMoyenController extends Controller
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
        $arr['TypeMoyen']=TypeMoyen::all();
        return view('typemoyen.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['TypeMoyen']=TypeMoyen::all();
        return view('typemoyen.ajout')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TypeMoyen $TypeMoyen)
    {
        $TypeMoyen->IdTypeMoyen = $request->IdTypeMoyen;
        $TypeMoyen->LibTypeMoyen = $request->LibTypeMoyen;
        $TypeMoyen->save();
        return redirect('TypeMoyen/typemoyen');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeMoyen  $typeMoyen
     * @return \Illuminate\Http\Response
     */
    public function show(TypeMoyen $typeMoyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeMoyen  $typeMoyen
     * @return \Illuminate\Http\Response
     */
    public function edit($IdTypeMoyen, TypeMoyen $typeMoyen)
    {
        $typeMoyen=TypeMoyen::find($IdTypeMoyen);
        $arr['TypeMoyen']=$typeMoyen;
        return view('typemoyen.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeMoyen  $typeMoyen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $IdTypeMoyen, TypeMoyen $typeMoyen)
    {
        $typeMoyen=TypeMoyen::find($IdTypeMoyen);

        $typeMoyen->LibTypeMoyen = $request->LibTypeMoyen;
        $typeMoyen->save();
        return redirect('TypeMoyen/typemoyen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeMoyen  $typeMoyen
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdTypeMoyen)
    {
        TypeMoyen::destroy($IdTypeMoyen);
        return redirect('TypeMoyen/typemoyen');
    }
}
