@extends('layouts.app')
@section('content')
<form action="{{action("EtudiantsController@store")}}"    method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="nom">Nom:</label>
        <input type="text"  id="nom" name="nom" class="form-control">
    </div>
    <div class="form-group">

        <select  name="groupes[]" id="groupes" class="custom-select custom-select-lg mb-3" multiple>
            @foreach($groupes as $groupe)
                <option value="{{$groupe->id}}" >{{$groupe->id}}</option>

            @endforeach
        </select>
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>
 @endsection