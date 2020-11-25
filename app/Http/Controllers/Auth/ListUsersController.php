<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class ListUsersController extends Controller
{
   /*public function __construct()
    {
        $this->middleware('auth');
    }
*/
	public function index()
    {
        //$Catlois=Categorieslois::all();
        $arr['ListUsers']=user::all();
        return view('auth.listusers')->with($arr);
    }
}
