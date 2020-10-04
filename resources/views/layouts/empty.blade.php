<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet"> 
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
  <link href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="logo">
        <a href="{{route($logo-route)}}"><b>Admin</b>LTE</a>
    </div>
    @yield('content')
</div>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/typehead-4.0.2.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
</body>
</html>
