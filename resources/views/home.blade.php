@extends('layouts.app')
@section('css')
  <style>
      #et{
          /**/
          background-size: 100% 100%;

          background-image: url('/storage/images/etudiants.png');

      }
      #ens{
          /**/
          background-size: 100% 100%;

          background-image: url('/storage/images/enseignants.jpg');

      }
      #gro{
          /**/
          background-size: 100% 100%;

          background-image: url('/storage/images/groupes.jpg');

      }
      #b{

          background: rgba(0, 0, 0, 0.5); /* Black background with transparency */
          color: #f1f1f1;
          width: 100%;
          color: #f1f1f1;
      }
      #icon{

          background: rgba(0, 0, 0, 0.3); /* Black background with transparency */
          color: #f1f1f1;
          width: 100%;
          color: #f1f1f1;
          border-radius: 50%;
      }

  </style>
@endsection
@section('content')


<!------------------------------------------------------------------------------------------------------------>
    <div class="row justify-content-center">
        <div class="col-md-4" >
            <div class="card" id="et">


                <div class="card-body text-center" id="b">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="row justify-content-center">
                        <div class="col-md-5" >
                            <div class="card" id="icon">


                                <div class="card-body text-center">
                                     <i class="fa fa-user fa-5x" ></i>


                                </div>
                            </div>
                        </div>
                        </div>
                        <h4 class="card-title" style="margin-top: 25px;" >Etudiants</h4>
                        <p class="card-text" style="margin-top: 50px;">vous avez  utilisateur actif, cliquez sur "Voir Tout Etudiants" pour voir vos utilisateurs actuels</p>
                        <a href="{{url('etudiants')}}" class="btn btn-primary" style="margin-top: 50px">Voir Tout Etudiants</a>
                </div>
            </div>
        </div>
  <!--------------------------------------------------------------------------------------------------------------->
        <div class="col-md-4" >
            <div class="card" id="ens">


                <div class="card-body  text-center" id="b">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="row justify-content-center">
                            <div class="col-md-5" >
                                <div class="card" id="icon">


                                    <div class="card-body text-center">
                                        <i class="fa fa-user fa-5x" ></i>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title" style="margin-top: 25px;" >Enseignants</h4>
                        <p class="card-text" style="margin-top: 50px;">vous avez  utilisateur actif, cliquez sur "Voir Tout Enseignants" pour voir vos utilisateurs actuels</p>
                        <a href="{{url('/enseignants')}}" class="btn btn-primary" style="margin-top: 50px">Voir Tout Enseignants</a>



                </div>
            </div>
        </div>
   <!--------------------------------------------------------------------------------------------------------------------->
        <div class="col-md-4">
            <div class="card" id="gro">


                <div class="card-body  text-center" id="b">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="row justify-content-center">
                            <div class="col-md-5" >
                                <div class="card" id="icon">


                                    <div class="card-body text-center">
                                        <i class="fa fa-users fa-5x" ></i>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="card-title" style="margin-top: 25px;" >Groupes</h4>
                        <p class="card-text" style="margin-top: 50px;">vous avez  utilisateur actif, cliquez sur "Voir Tout Groupes" pour voir vos utilisateurs actuels</p>
                        <a href="/groupeAcademiques" class="btn btn-primary" style="margin-top: 50px">Voir Tout Groupes</a>


                </div>
            </div>
        </div>
<!-------------------------------------------------------------------------------------------------------------------->
    </div>


@endsection
