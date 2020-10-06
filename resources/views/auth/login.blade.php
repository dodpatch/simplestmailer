@extends('layouts.empty')
@section('content')
  <x-cards.cardadminlte
  title="Connexion"
  > 
    <x-forms.loginForm
       route="login"
    >
    </x-forms.loginForm>
  </x-cards.cardadminlte> 
@endsection


@extends('layouts.empty')
@section('content')
<style>
      .btn_login{
          height:40px;
          width:auto;
      }
  </style>
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Simplestmailer</b></a>
  </div>
 <x-cards.cardadminlte
 title="Connexion"
 > 
 <x-inputs.input
    name="email"
    type="email"
    icon="envelop"
    label="email"
    placeholder="Email"
    required="true"
 ></x-inputs.input>
 <x-inputs.input
    name="password"
    type="password"
    icon="lock"
    label="password"
    placeholder="Mot de Passe"
    required="true"
 ></x-inputs.input>

 <p class="mb-1">
        <a href="{{route('register')}}">{{__('Register')}}</a>
      </p>
      <p class="mb-0">
         @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
      </p>

      <form method="POST" action="{{route('login')}}">
      @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{old('email')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="{{__('Password')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name= "remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
              {{__('Remember Me')}}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn_login">{{__('Login')}}</button>
          </div>
          <!-- /.col -->
        </div>

      </form>
 </x-cards.cardadminlte> 
 
@endsection






<!-- 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{__('Login')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet"> 

  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
  <link href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
      .btn_login{
          height:40px;
          width:auto;
      }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Simplestmailer</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">{{__('Login')}}</p>

      <form method="POST" action="{{route('login')}}">
      @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{old('email')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="{{__('Password')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name= "remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
              {{__('Remember Me')}}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn_login">{{__('Login')}}</button>
          </div>
          <!-- /.col -->
        </div>

      </form>
      <!-- /.social-auth-links -->

   
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html> -->
