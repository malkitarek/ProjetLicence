<?php

namespace App\Http\Controllers;

use App\Enseignant;
use App\GroupeAcadémique;
use App\GroupeAcadémique_Utilisateur;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnseignantsController extends Controller
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
        $enseignants= Utilisateur::orderby('created_at','des')->where('utilisateurable_type','enseignant')->where('nom','LIKE','%'.$request->input('recherche').'%')->paginate(6);
        //$etudiants->appends($request->only('recherche'));

        return view('enseignants.index')->with('enseignants',$enseignants)->with('groupes',$groupes)
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

        $this->validate($request,(['nom'=>'required','prenom'=>'required','grade'=>'required','lieu_n'=>'required',
            'date_n'=>'required','groupes'=>'required',
            'email' => 'required|string|email|max:255|unique:utilisateurs',   ]));

        $enseignant=new Enseignant();
        $enseignant->grade=$request->input('grade');
        $enseignant->save();
        $utilisateur=new Utilisateur();
        $utilisateur->utilisateurable_id= $enseignant->id;
        $utilisateur->utilisateurable_type="enseignant";
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
        return redirect('/enseignants');
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

    {  $this->validate($request,(['nom'=>'required','prenom'=>'required','grade'=>'required','lieu_n'=>'required',
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
        $enseignant=Enseignant::find($id2);
        $enseignant->grade=$request->input('grade') ;
        $enseignant->save();


        $gau=GroupeAcadémique_Utilisateur::where('utilisateur_id',$id);
        $gau->delete();
        foreach ($request->input('groupes') as $selected_id){
            $ga=new GroupeAcadémique_Utilisateur();

            $ga->utilisateur_id=$id;
            $ga->groupe_académique_id=$selected_id;
            $ga->save();
        }


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
        $enseignant=Enseignant::find($utilisateur->utilisateurable->id);
        $groupeUtil=GroupeAcadémique_Utilisateur::where('utilisateur_id',$id);
        $enseignant->delete();
        $utilisateur->delete();
        $groupeUtil->delete();
        return redirect('/enseignants');

    }
}
