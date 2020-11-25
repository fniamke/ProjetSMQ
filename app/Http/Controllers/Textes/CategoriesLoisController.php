<?php

namespace App\Http\Controllers\Textes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorieslois;

class CategoriesLoisController extends Controller
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
        $arr['Categorieslois']=Categorieslois::all();
        return view('textes.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('textes.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Categorieslois $Categorieslois)
    {
        $Categorieslois->categorieslois = $request->categorieslois;
        $Categorieslois->save();
        return redirect('Textes/categorieslois');
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
    public function edit($id, Categorieslois $Categorieslois)
    {
        /*$arr['Categorieslois']=$Categorieslois;
        return view('textes.modifier')->with($arr);
        */
        //echo var_dump($Categories->id);
        //echo var_dump($id);
        
        //echo $Categories->categorieslois;

        $Categorieslois=Categorieslois::find($id);
        $arr['Categorieslois']=$Categorieslois;
        return view('textes.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Categorieslois $Categorieslois)
    {
        /*echo var_dump($id);
        echo $request->categorieslois;
        */
        $Categorieslois=Categorieslois::find($id);
        $Categorieslois->categorieslois = $request->categorieslois;
        $Categorieslois->save();
        return redirect('Textes/categorieslois');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categorieslois::destroy($id);
        return redirect('Textes/categorieslois');   
    }
}
