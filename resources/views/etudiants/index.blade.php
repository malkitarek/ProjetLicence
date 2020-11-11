@extends('layouts.app')
@section('css')
  <style>
        #image{
            height: 53px;
            width: 50px ;
            border-radius: 50%;
        }
    </style>
<script>
    $(document).ready(function () {
        $('#b1').click(function () {
            if(!empty({{$errors->has('email')}})){
                $('#myModalAjou').modal('show');
                $('.f').show();

            }
        });

    });
</script>

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

                    <div class="card-title"><i class="fas fa-user fa-2x" style="margin-right: 2%"></i>
                        Etudiants

                        <!--------------------------ajouter---------------------------------------------------------------------->
                        <a class='btn btn-primary btn-xs' href="" data-toggle="modal" data-target="#myModalAjou"><i class="fa fa-edit"></i>Ajouter</a>
                        <div class="modal fade" id="myModalAjou" >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ajouter</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <form action="{{action("EtudiantsController@store")}}" method="post" class="f">


                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="nom" class="col-sm-2 col-form-label">Nom:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="nom" class="form-control {{ $errors->has('nom') ? ' is-invalid' : '' }}" id="nom" required>
                                                    @if ($errors->has('nom'))
                                                        <span class="invalid-feedback">
                                                              <strong>{{ $errors->first('nom') }}</strong>


                                                             </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="prenom" class="col-sm-2 col-form-label">Prenom:</label>
                                                <div class="col-sm-10">
                                                    <input type="text"  name="prenom" class="form-control" id="prenom"  required>
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
                                                <label for="niveau" class="col-sm-2 col-form-label">Niveau:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="niveau"  class="form-control" id="niveau" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="lieu_n" class="col-sm-2 col-form-label">Lieu_Naissance:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="lieu_n"  class="form-control" id="lieu_n" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="date_n" class="col-sm-2 col-form-label">Date_Naissance:</label>
                                                <div class="col-sm-10">
                                                    <input type="date" name="date_n"  class="form-control" id="date_n" required>
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
                                            <input type="submit" class="btn btn-primary" value="Ajouter" id="b1">
                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>

                        <!------------------recherche---------------------------------------------------------------------------->
                    </div>
                    <form class="form-inline" style="margin-top: -5%;margin-left: 75%" action="{{action("EtudiantsController@index")}}" method="POST">

                        <input name="recherche" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">


                        <input type="hidden" name="_method" value="GET">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 1%;">Search</button>
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

                @foreach($etudiants as $etudiant)
                    <tr>
                        <td><img id="image" src="/storage/images/{{$etudiant->photo}}"  alt="Avatar"></td>
                        <td>{{$etudiant->nom}}</td>
                        <td>{{$etudiant->email}}</td>
                        <td class="text-right">
                            <!------------------------------------------------------------------------------------------------------------------------------------------->
                            <a class='btn btn-success btn-xs'  href="#"><i class="fa fa-eye"></i> Voir</a>
                            <!----------------------------------------------------------Modifier-------------------------------------------------------------------------------------------------------->
                            <a class='btn btn-info btn-xs' href="" data-toggle="modal" data-target="#myModal{{$etudiant->id}}"><i class="fa fa-edit"></i> Modifier</a>
                            <div class="modal fade" id="myModal{{$etudiant->id}}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Modification</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <form action="{{action("EtudiantsController@update",$etudiant->id)}}" method="post">


                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="nom" class="col-sm-2 col-form-label">Nom:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="nom" class="form-control" id="nom" value="{{$etudiant->nom}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="prenom" class="col-sm-2 col-form-label">Prenom:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text"  name="prenom" class="form-control" id="prenom" value="{{$etudiant->prenom}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" name="email" value="{{$etudiant->email}}"  class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email">
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
                                                            <input  id="homme" value="homme" name="sexe" type="radio" class="custom-control-input"  {{ $etudiant->sexe == 'homme' ? 'checked' : '' }} required>

                                                            <label class="custom-control-label" style="margin-right: 550px;" for="homme" >homme</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input id="femme" value="femme" name="sexe" type="radio" class="custom-control-input" {{ $etudiant->sexe == 'femme' ? 'checked' : '' }} required>
                                                            <label class="custom-control-label" style="margin-right: 550px;" for="femme">femme &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="niveau" class="col-sm-2 col-form-label">Niveau:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="niveau"  class="form-control" id="niveau" value="{{$etudiant->utilisateurable->niveau}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="lieu_n" class="col-sm-2 col-form-label">Lieu_Naissance:</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="lieu_n"  class="form-control" id="lieu_n" value="{{$etudiant->lieu_n}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="date_n" class="col-sm-2 col-form-label">Date_Naissance:</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" name="date_n"  class="form-control" id="date_n" value="{{$etudiant->date_n}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-2 col-form-label">Groupe:</label>
                                                    <div class="col-sm-10">
                                                        <select  name="groupes[]" id="groupes" class="form-control selectpicker" multiple required>
                                                            @foreach($groupes as $groupe)
                                                                <option value="{{$groupe->id}}"
                                                                @foreach($groupe->utilisateurs as $gu)
                                                                    {{ $gu->id == $etudiant->id ? 'selected' : '' }}
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
                            <!---------------------------------------------------------------------------------------------------------------------->
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
                                            voulez-vous vraimment supprimer {{$etudiant->nom}}
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                            <form action="{{action("EtudiantsController@destroy",$etudiant->id)}}" method="POST">
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
            {{$etudiants->links()}}
        </div>

    </main>

@endsection