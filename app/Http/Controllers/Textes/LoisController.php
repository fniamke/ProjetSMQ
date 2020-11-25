<?php

namespace App\Http\Controllers\Textes;

use App\Http\Controllers\Controller;
use App\Models\Lois;
use Illuminate\Http\Request;
use App\Models\Categorieslois;

use Illuminate\Support\Facades\DB;

use App\Models\Message;

class LoisController extends Controller
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
        //$Catlois=Categorieslois::all();
        //$arr['Lois']=Lois::all();
        $arr['Lois']=DB::table('lois')
                            ->join('categorieslois', 'lois.IdCategoriesLois','categorieslois.id')
                            ->select('lois.*', 'categorieslois.categorieslois')
                            ->get();

        return view('textes.lois.index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['Categorieslois']=Categorieslois::all();
        //$Catlois=Categorieslois::all();
        //return view('textes.lois.ajout');
        return view('textes.lois.ajout')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Lois $Lois)
    {
        //dd($request);

        $idsociete=Auth::user()->IdSociete;
        $societe=Societe::find($idsociete);
        
        $Lois->IdCategoriesLois = $request->Id;
        $Lois->LibLois = $request->LibLois;
        $Lois->DatePromulgation = $request->DatePromulgation;
        $Lois->save();

        
        $expediteur=user::find($Taches->IdIntervenant);
        $destinataire=user::find($Taches->IdDemandeur);

        //$message = Message::create(['name'=>$besoin->usage,'email'=>Auth::user()->email,'message'=>$besoin->id]);
        $messages = Messages::create([
            'IdSociete' => $idsociete,
            'IdOrigine' => $Lois->Id,
            'IdExpediteur'=> $Taches->IdDemandeur,
            'Expediteur' => $expediteur->name,
            'emailExpediteur' => $expediteur->email,
            'IdDestinataire' => $Taches->IdIntervenant,
            'Destinataire' => $destinataire->name,
            'emailDestinataire' => $destinataire->email,
            'message' => 'Bonjour Mr/Mme ' . $destinataire->name . ',' .chr(13).chr(10). 'Mr/Mme '. $expediteur->name . ' vous a envoyé une tâche.'.chr(13).chr(10). 'Veuillez consulter vos mails SVP!',
            'statut' =>0,
            ]);


        return redirect('Textes/lois');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lois  $lois
     * @return \Illuminate\Http\Response
     */
    public function show(Lois $lois)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lois  $lois
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Lois $lois)
    {
        $Lois=Lois::find($id);
        //$arr['Lois']=$lois;
        //$arr['Categorieslois']=Categorieslois::all();
        //return view('textes.lois.modifier')->with($arr);

        //$Lois=$lois;
        $Categorieslois=Categorieslois::all();
        return view('textes.lois.modifier', compact('Lois', 'Categorieslois'));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lois  $lois
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Lois $lois)
    {
        $lois=Lois::find($id);

        $lois->IdCategoriesLois = $request->Id;
        $lois->LibLois = $request->LibLois;
        $lois->DatePromulgation = $request->DatePromulgation;
        $lois->save();
        return redirect('Textes/lois');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lois  $lois
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //echo $lois->id;
        Lois::destroy($id);
        return redirect('Textes/lois'); 
        
    }
}
