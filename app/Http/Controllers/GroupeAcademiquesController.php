<?php

namespace App\Http\Controllers;

use App\GroupeAcadémique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GroupeAcademiquesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groupes= GroupeAcadémique::orderby('created_at','des')->where('designation','LIKE','%'.$request->input('recherche').'%')->paginate(6);
        return view('groupeAcademiques.index')->with('groupes',$groupes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,(['designation'=>'required','image'=>'image|nullable',
              ]));
        if($request->hasFile('image')){
            $fullname=$request->file('image')->getClientOriginalName();
            $name=pathinfo($fullname,PATHINFO_FILENAME);
            $extension=$request->file('image')->getClientOriginalExtension();
            $nameToStore=$name.'_'.time().'.'.$extension;
            $path=$request->file('image')->storeAs('public/images',$nameToStore);
            $destinationPath="C:/xampp/htdocs/util/public/storage/images";
            $request->file('image')->move( $destinationPath,$nameToStore);
          //  Storage::disk('s3')->copy('page_admin/public/images/'.$nameToStore, 'util/public/images/'.$nameToStore);

        }
        else{
            $nameToStore='default.jpg';
        }

        $groupe=new GroupeAcadémique();
        $groupe->designation=$request->input('designation');
        $groupe->image=$nameToStore;
        $groupe->save();
        return redirect('/groupeAcademiques');

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
        $this->validate($request,(['designation'=>'required','image'=>'image|nullable',
        ]));
        if($request->hasFile('image')){
            $fullname=$request->file('image')->getClientOriginalName();
            $name=pathinfo($fullname,PATHINFO_FILENAME);
            $extension=$request->file('image')->getClientOriginalExtension();
            $nameToStore=$name.'_'.time().'.'.$extension;
            $path=$request->file('image')->storeAs('public/images',$nameToStore);

        }
        else{
            $nameToStore='default.jpg';
        }
        $groupe=GroupeAcadémique::find($id);
        $groupe->designation=$request->input('designation');
        $groupe->image=$nameToStore;
        $groupe->save();
        return redirect('/groupeAcademiques');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $groupe=GroupeAcadémique::find($id);
        $groupe->delete();
        return redirect('/groupeAcademiques');

    }
}
