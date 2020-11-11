<?php

namespace App\Http\Controllers;

use App\GroupeAcadémique_Utilisateur;
use Illuminate\Http\Request;
use App\Groupe;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $groupes=GroupeAcadémique_Utilisateur::all();

        return view('home')->with('groupes',$groupes);
    }
}
