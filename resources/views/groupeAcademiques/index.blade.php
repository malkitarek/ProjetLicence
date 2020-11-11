@extends('layouts.app')
@section('css')
    <style>
        #image{
            height: 75px;
            width: 100px ;

        }
         .image-area {
            text-align: center;
            display: none;
        }
        .image-areae {
            text-align: center;

        }
        .image-remove-button {
            background: rgba(255,255,255,0.5);
            position: absolute;
            display: block;
            font-size: 23px;
            padding: 0 10px;
            color: #333;
        }
    </style>
<script>

    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function previewPostImage(input){
        var form_name = '#form-new-post';
        $(form_name + ' .loading-post').show();
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(form_name + ' .image-area img').attr('src', e.target.result);
                $(form_name + ' .image-area').show();
            };

            reader.readAsDataURL(input.files[0]);
        }
        $(form_name + ' .loading-post').hide();
    }
    function removePostImage(){
        var form_name = '#form-new-post';
        $(form_name + ' .image-area img').attr('src', " ");
        $(form_name + ' .image-area').hide();
        resetFile($(form_name + ' .image-input'));
    }
    function removePostImagee(){
        var form_name = '#form-new-post';
        $(form_name + ' .image-areae img').attr('src', " ");
        $(form_name + ' .image-areae').hide();
        resetFile($(form_name + ' .image-input'));
    }
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

                    <div class="card-title"><i class="fas fa-users fa-2x" style="margin-right: 20px"></i>
                        Groupe Académique
<!----------------------------------------------ajouter------------------------------------------------------------------>

                        <a class='btn btn-primary btn-xs' href="" data-toggle="modal" data-target="#createGroupe" ><i class="fa fa-plus"></i>Ajouter</a>
                        <div  class="modal fade" id="createGroupe" >
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ajouter</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <form id="form-new-post" action="{{action("GroupeAcademiquesController@store")}}" enctype="multipart/form-data" method="post">


                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="designation" class="col-sm-2 col-form-label">Designation:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="designation" class="form-control" id="designation" required>
                                                </div>
                                            </div>
                                            <div class="image-area">
                                                <a href="javascript:;" class="image-remove-button" onclick="removePostImage()"><i class="fa fa-times-circle"></i></a>
                                                <img src="" />
                                            </div>

                                            <div class="form-group row">

                                                <label for="designation" class="col-sm-2 col-form-label">Image:</label>
                                                <div class="col-sm-10">
                                                    <div class="custom-file">

                                                        <input type="file" class="custom-file-input" id="image" name="image" onchange="previewPostImage(this)">

                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                        </div>
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

                        <form class="form-inline" style="margin-top: -50px;margin-left: 750px" action="{{action("GroupeAcademiquesController@index")}}" method="POST">

                            <input name="recherche" id="myInput" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">


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
        <table class="table table-striped custab"  id="myTable" >
            <thead>

            <tr>
                <th>Image</th>
                <th>Designation</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>

            @foreach($groupes as $groupe)
                <tr>
                    <td><img id="image" src="/storage/images/{{$groupe->image}}"  alt="Avatar"></td>
                    <td class="ta">{{$groupe->designation}}</td>

                    <td class="text-right">
                        <!-----------------------------------Voir-------------------------------------------------------------------------------------------------------->
                        <a class='btn btn-success btn-xs'  href="#"><i class="fa fa-eye"></i> Voir</a>
                        <!---------------------------------------------------------------------------------------------------------------------------------------------------------------->


                        <!------------------------------------Modifier------------------------------------------------------------------------------------------------------->
                        <a class='btn btn-info btn-xs' href="" data-toggle="modal" data-target="#myModal{{$groupe->id}}"><i class="fa fa-edit"></i> Modifier</a>
                        <div class="modal fade" id="myModal{{$groupe->id}}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Modification</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <form id="form-new-post" action="{{action("GroupeAcademiquesController@update",$groupe->id)}}"enctype="multipart/form-data"  method="post">


                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="designation" class="col-sm-2 col-form-label">Designation:</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="designation" class="form-control" id="designation" value="{{$groupe->designation}}" required>
                                                </div>
                                            </div>
                                            <div class="image-area">
                                                <a href="javascript:;" class="image-remove-button" onclick="removePostImage()"><i class="fa fa-times-circle"></i></a>
                                                <img src="/storage/images/{{$groupe->image}}" />
                                            </div>


                                            <div class="form-group row">

                                                <label for="image" class="col-sm-2 col-form-label">Image:</label>
                                                <div class="col-sm-10">
                                                    <div class="custom-file">

                                                        <input type="file" class="custom-file-input" id="image" name="image" value='C:\xampp\tmp\phpDE61.tmp' onchange="previewPostImage(this)">

                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="modal-footer">
                                            <input type="submit"  class="btn btn-primary" value="Modifier">
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                        <!---------------------------------------------------------------------------------------------------------------------------------------------------------------->


                        <!--------------------------------------Supprimmer----------------------------------------------------------------------------------------------------->


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
                                        voulez-vous vraimment supprimer {{$groupe->designations}}
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                        <form action="{{action("GroupeAcademiquesController@destroy",$groupe->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" class="btn btn-danger"  value="Confirmer">
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!---------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    </td>
                </tr>
                @endforeach
        </table>
        {{$groupes->links()}}
    </div>
    </main>
    @section('script')
     <script>
        $('.filestyle').on('change',function(e){

        var file = e.target.files[0],reader = new FileReader();

        reader.onload =function(c){

        $('#image').attr('src',c.target.result);
        }

        });
     </script>
        @endsection
@endsection