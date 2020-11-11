<?php

namespace App\Http\Controllers;

use App\Etudiant;

use App\GroupeAcadémique;
use App\GroupeAcadémique_Utilisateur;
use App\User;
use App\Utilisateur;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class EtudiantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
            $gus=GroupeAcadémique_Utilisateur::all();
            $groupes=GroupeAcadémique::all();
        //$etudiants=DB::table('etudiants')->where('nom',$request->input('recherche'))->get();
      $etudiants= Utilisateur::orderby('created_at','des')->where('utilisateurable_type','etudiant')->where('nom','LIKE','%'.$request->input('recherche').'%')->paginate(6);
        //$etudiants->appends($request->only('recherche'));

        return view('etudiants.index')->with('etudiants',$etudiants)->with('groupes',$groupes)
            ->with('gus',$gus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
       // return view('etudiants.create')->with('groupes',$groupes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,(['nom'=>'alpha|required',
            'prenom'=>'alpha|required','niveau'=>'required','lieu_n'=>'required',
            'date_n'=>'required','groupes'=>'required',
            'email' => 'required|string|email|max:255|unique:utilisateurs',   ]));
        $etudiant=new Etudiant();
        $etudiant->niveau=$request->input('niveau');
        $etudiant->save();
        $utilisateur=new Utilisateur();
        $utilisateur->utilisateurable_id=$etudiant->id;
            $utilisateur->utilisateurable_type="etudiant";
        $utilisateur->nom=$request->input('nom');
        $utilisateur->prenom=$request->input('prenom');
        $utilisateur->email=$request->input('email');
        $utilisateur->sexe=$request->input('sexe');
        $utilisateur->lieu_n=$request->input('lieu_n');
        $utilisateur->date_n=$request->input('date_n');
        if($request->input('sexe')=="homme"){
            $utilisateur->photo='homme.png';
        }
        else{$utilisateur->photo='femme.png';}
        $utilisateur->save();

         $r=DB::table('utilisateurs')->where('email',$request->input('email'))->value('id');
         foreach ($request->input('groupes') as $selected_id){
        $g=new GroupeAcadémique_Utilisateur();

        $g->utilisateur_id=$r;
        $g->groupe_académique_id=$selected_id;
        $g->save();
      }
        return redirect('/etudiants');
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
        $this->validate($request,(['nom'=>'required','prenom'=>'required','niveau'=>'required','lieu_n'=>'required',
            'date_n'=>'required','groupes'=>'required',
            'email' => 'required|string|email|max:255|unique:utilisateurs,email,'.$id,   ]));
        $utilisateur=Utilisateur::find($id);
        $utilisateur->nom=$request->input('nom');
        $utilisateur->prenom=$request->input('prenom');
        $utilisateur->email=$request->input('email');
        $utilisateur->sexe=$request->input('sexe') ;
        $utilisateur->lieu_n=$request->input('lieu_n') ;
        $utilisateur->date_n=$request->input('date_n') ;
        if($request->input('sexe')=="homme"){
            $utilisateur->photo='homme.png';
        }
        else{$utilisateur->photo='femme.png';}

        $utilisateur->save();
        $id2=$utilisateur->utilisateurable_id;
        $etudinat=Etudiant::find($id2);
        $etudinat->niveau=$request->input('niveau') ;
        $etudinat->save();

        $gau=GroupeAcadémique_Utilisateur::where('utilisateur_id',$id);
        $gau->delete();
        foreach ($request->input('groupes') as $selected_id){
            $ga=new GroupeAcadémique_Utilisateur();

            $ga->utilisateur_id=$id;
            $ga->groupe_académique_id=$selected_id;
            $ga->save();
        }

        return redirect('/etudiants');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $utilisateur=Utilisateur::find($id);
      $user=User::find($utilisateur->user->id);
      $etudiant=Etudiant::find($utilisateur->utilisateurable->id);
        $groupeUtil=GroupeAcadémique_Utilisateur::where('utilisateur_id',$id);
      $etudiant->delete();
        $utilisateur->delete();
        $groupeUtil->delete();
        $user->delete();
      return redirect('/etudiants');

    }
}
