<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorieslois;

class CategoriesLoisController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$arr['Categorieslois']=Categorieslois::all();
    	return view('textes.index')->with($arr);
    }
}
