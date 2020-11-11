<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>




        body {
            background-image:url('/storage/images/image_admi.jpg');
            background-size: 1400px 700px;
            background-repeat: no-repeat;
        }
        div.card{
          margin-top: 100px;
            max-height: 50rem;
            background-color: #ffffff;
            border: 1px solid black;
            opacity: 0.94;
            /*filter: alpha(opacity=80); For IE8 and earlier */

        }
        div.card-header{background-color: #00A6EB;font-family:Stencil}
    </style>
</head>
<body>
<div id="app">
    <main class="py-4">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card" >
                @if(session('status'))
                    <div class="alert alert-info">{{session('status')}}</div>
                @endif
          <div class="card-header"><h1> <i class="fas fa-sign-in-alt fa-2x" style="margin-right: 160px;margin-top: -20px;margin-bottom: -20px;"></i>LOGIN</h1></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" >
                        @csrf

                        <div class="form-group row" style="margin-top: 50px ; opacity:0.9">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">User Name</label>

                            <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                                    </div>
                                    <input  id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Username" required autofocus>
                                    @if ($errors->has('name'))
                                        <span  class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>




                            </div>
                    </div>

                        <div class="form-group row" style="margin-top: 50px">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-unlock"></i></div>
                                    </div>
                                    <input   id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>




                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row " style="margin-bottom: 30px">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Login" class="btn btn-primary" >




                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </main>
</div>


</body>
</html>
