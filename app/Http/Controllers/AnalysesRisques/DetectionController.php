<?php

namespace App\Http\Controllers\AnalysesRisques;

use App\Http\Controllers\Controller;
use App\Models\Detection;
use Illuminate\Http\Request;

class DetectionController extends Controller
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
        $arr['detection']=Detection::all();
        return view('analysesrisques.detection.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('analysesrisques.detection.ajout');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Detection $detection)
    {
        $detection->Detection = $request->Detection;
        $detection->NoteDetection = $request->NoteDetection;
        
        $detection->save();
        return redirect('AnalysesRisques/detection');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detection  $detection
     * @return \Illuminate\Http\Response
     */
    public function show(Detection $detection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detection  $detection
     * @return \Illuminate\Http\Response
     */
    //public function edit($iddetection, Detection $detection)
     public function edit(Detection $detection)
    {
        //$detection=Detection::find($iddetection);
        //dd($detection);
        $arr['detection']=$detection;
        return view('analysesrisques.detection.modifier')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detection  $detection
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $iddetection, Detection $detection)
     public function update(Request $request, Detection $detection)
    {
        //dd($gravite);
        //$detection=Detection::find($iddetection);
        $detection->Detection = $request->Detection;
        $detection->NoteDetection = $request->NoteDetection;
        
        $detection->save();

        return redirect('AnalysesRisques/detection');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detection  $detection
     * @return \Illuminate\Http\Response
     */
    public function destroy($iddetection)
    {
        Detection::destroy($iddetection);
        return redirect('AnalysesRisques/detection');
    }
}
