@extends('layouts.app')
@section('css')
    <style>
        #image{
            height: 53px;
            width: 50px ;
            border-radius: 50%;
        }
    </style>



@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12" >
            <div class="card" id="et">


                <div class="card-body" id="b">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-title"><i class="fas fa-user fa-2x" style="margin-right: 20px"></i>
                        Enseignant
                        <!--------------------------ajouter---------------------------------------------------------------------->
                        <a class='btn btn-primary btn-xs' href="" data-toggle="modal" data-target="#create" ><i class="fa fa-plus"></i>Ajouter</a>
                        <div  class="modal fade" id="create" >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ajouter</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <form action="{{action("EnseignantsController@store")}}"  method="post">


                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="nom" class="col-sm-2 col-form-label">Nom:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="nom" class="form-control" id="nom" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="prenom" class="col-sm-2 col-form-label">Prenom:</label>
                                                <div class="col-sm-10">
                                                    <input type="text"  name="prenom" class="form-control" id="prenom" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                                                <div class="col-sm-10">
                                                    <input type="email" name="email"  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" required >
                                                    @if ($errors->has('email'))
                                                         <span class="invalid-feedback">
                                                          <strong>{{ $errors->first('email') }}</strong>


                                                         </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">     </label>
                                                <div class="col-sm-10">

                                                    <div class="custom-control custom-radio">
                                                        <input  id="homme" value="homme" name="sexe" type="radio" class="custom-control-input"  checked required>

                                                        <label class="custom-control-label" for="homme">homme</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input id="femme" value="femme" name="sexe" type="radio" class="custom-control-input"  required>
                                                        <label class="custom-control-label" for="femme">femme</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="grade" class="col-sm-2 col-form-label">Grade:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="grade"  class="form-control" id="grade" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="lieu_n" class="col-sm-2 col-form-label">Lieu_Naissance:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="lieu_n"  class="form-control" id="lieu_n" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="date_n" class="col-sm-2 col-form-label">Date_Naissance:</label>
                                                <div class="col-sm-10">
                                                    <input type="date" name="date_n"  class="form-control" id="date_n" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-2 col-form-label">Groupe:</label>
                                                <div class="col-sm-10">
                                                    <select  name="groupes[]" id="groupes" class="form-control selectpicker" multiple required>
                                                        @foreach($groupes as $groupe)
                                                            <option value="{{$groupe->id}}" >{{$groupe->id}}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>





                                        <div class="modal-footer">
                                            <input type="submit"  class="btn btn-primary" value="Ajouter">
                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                        <!------------------recherche---------------------------------------------------------------------------->

                    <form class="form-inline" style="margin-top: -50px;margin-left: 750px" action="{{action("EnseignantsController@index")}}" method="POST">

                        <input name="recherche" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">


                        <input type="hidden" name="_method" value="GET">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Recherche</button>
                    </form>
                    <!--------------------------------------------------------------------------------------------------------------------------->

                </div>
            </div>
        </div>
    </div>
    <br>


    <main role="main" class="container">

        <div class="row col-md-14 col-md-offset-2 custyle">
            <table class="table table-striped custab">
                <thead>

                <tr>
                    <th>Photo Profile</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                @foreach($enseignants as $enseignant)
                    <tr>
                        <td><img id="image" src="/storage/images/{{$enseignant->photo}}"  alt="Avatar"></td>
                        <td>{{$enseignant->nom}}</td>
                        <td>{{$enseignant->email}}</td>
                        <td class="text-right">
                            <!------------------------------------------------------------------------------------------------------------------------------------------->
                            <a class='btn btn-success btn-xs'  href="#"><i class="fa fa-eye"></i> Voir</a>
                            <!----------------------------------------------------------Modifier------------------------------------------------------------------------------------------------------->

                                        <a class='btn btn-info btn-xs' href="" data-toggle="modal" data-target="#create{{$enseignant->id}}" ><i class="fa fa-edit"></i>Modifier</a>
                                        <div  class="modal fade" id="create{{$enseignant->id}}" >
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modifier</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                        <!-- Modal body -->
                                        <form action="{{action("EnseignantsController@update",$enseignant->id)}}" method="post">


                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="nom" class="col-sm-2 col-form-lasbel">Nom:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="nom" class="form-control" id="nom" value="{{$enseignant->nom}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="prenom" class="col-sm-2 col-form-label">Prenom:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text"  name="prenom" class="form-control" id="prenom" value="{{$enseignant->prenom}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" name="email"  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{$enseignant->email}}">
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" >
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-2 col-form-label">     </label>
                                                    <div class="col-sm-10">

                                                    <div class="custom-control custom-radio">
                                                        <input  id="homme" value="homme" name="sexe" type="radio" class="custom-control-input"  {{ $enseignant->sexe == 'homme' ? 'checked' : '' }} required>

                                                        <label class="custom-control-label" style="margin-right: 550px;" for="homme" >homme</label>
                                                    </div>
                                                    <div class="custom-control custom-radio">
                                                        <input id="femme" value="femme" name="sexe" type="radio" class="custom-control-input" {{ $enseignant->sexe == 'femme' ? 'checked' : '' }} required>
                                                        <label class="custom-control-label" style="margin-right: 550px;" for="femme">femme &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="form-group row">
                                                        <label for="grade" class="col-sm-2 col-form-label">grade:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="grade"  class="form-control" id="grade" value="{{$enseignant->utilisateurable->grade}}" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="lieu_n" class="col-sm-2 col-form-label">Lieu_Naissance:</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="lieu_n"  class="form-control" id="lieu_n" value="{{$enseignant->lieu_n}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="date_n" class="col-sm-2 col-form-label">Date_Naissance:</label>
                                                        <div class="col-sm-10">
                                                            <input type="date" name="date_n"  class="form-control" id="date_n" value="{{$enseignant->date_n}}" >
                                                        </div>
                                                    </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-2 col-form-label">Groupe:</label>
                                                    <div class="col-sm-10">
                                                        <select  name="groupes[]" id="groupes" class="form-control selectpicker" multiple required>
                                                            @foreach($groupes as $groupe)
                                                                <option value="{{$groupe->id}}"
                                                                @foreach($groupe->utilisateurs as $gu)
                                                                    {{ $gu->id == $enseignant->id ? 'selected' : '' }}
                                                                        @endforeach>{{$groupe->id}}</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                </div>






                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_method" value="PUT">


                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" value="Modifier">
                                            </div>

                                        </form>


                                    </div>
                                </div>
                            </div>
                            <!--------------------------------------------------suppression-------------------------------------------------------------------->
                            <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal2"><i class="fa fa-trash-alt"></i> Supprimer</a>
                            <div class="modal fade" id="myModal2" >
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Suppression</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            voulez-vous vraimment supprimer {{$enseignant->nom}}
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                            <form action="{{action("EnseignantsController@destroy",$enseignant->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" class="btn btn-danger"  value="Confirmer">
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!------------------------------------------------------------------------------------------------------------>
                        </td>
                    </tr>
                @endforeach

            </table>
            {{$enseignants->links()}}
        </div>


</main>
@endsection