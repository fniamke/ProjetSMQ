<?php

namespace App\Http\Controllers\PartiesInteressees;

use App\Http\Controllers\Controller;
use App\Models\Cotation;
use Illuminate\Http\Request;

class CotationController extends Controller
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
        $arr['cotation']=Cotation::all();
        return view('partiesinteressees.cotation.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partiesinteressees.cotation.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cotation $cotation)
    {
        $cotation->LibCotation = $request->LibCotation;
        $cotation->ValeurCotation = $request->ValeurCotation;
        $cotation->save();
        return redirect('PartiesInteressees/cotation');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cotation  $cotation
     * @return \Illuminate\Http\Response
     */
    public function show(Cotation $cotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cotation  $cotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotation $cotation)
    {
        //$cotation=Cotation::find($idcotation);
        $arr['cotation']=$cotation;
        return view('partiesinteressees.cotation.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cotation  $cotation
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $IdCotation, Cotation $cotation)
    public function update(Request $request, Cotation $cotation)
    {
        //dd($cotation);
        //$cotation=Cotation::find($IdCotation);
        $cotation->LibCotation = $request->LibCotation;
        $cotation->ValeurCotation = $request->ValeurCotation;
        $cotation->save();
        
        return redirect('PartiesInteressees/cotation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cotation  $cotation
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdCotation)
    {
        Cotation::destroy($IdCotation);
        return redirect('PartiesInteressees/cotation');
    }
}
