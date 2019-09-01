<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Marksheet Login Page</title>
<style type="text/css">
    input[type=checkbox] {
  transform: scale(1.5);
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="{{asset('css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet"> 
<script src="{{asset('js/jquery.min.js')}}"> </script>
<script src="{{asset('js/bootstrap.min.js')}}"> </script>
</head>
<body>
    <div class="login">
        <h1><a href="{{route('index')}}">Marksheet </a></h1>
        <div class="login-bottom">
            <h2>Login</h2>
            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf
            <div class="col-md-6">
                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                 @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif  
                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif

                <div class="input-group">
                <span class="input-group-addon">
                                        <i class="fas fa-file-signature"></i>
                                    </span>
                     <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                               
                </div>  
                <div class="input-group">   
                                
                                    <span class="input-group-addon">

                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail" required>

                              
                                </div>
                
                <div class="input-group">

                                    <span class="input-group-addon">
                                        <i id="lock" class="fa fa-lock" onclick="myFunction()"></i>
                                    </span>
                                     <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter Password" name="password" required>

                                
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                                        <i id="lock-confirm" onclick="lock()" class="fa fa-lock"></i>
                        </span>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Enter Password Again" required>
                    </div>
                   <a class="news-letter " href="#">
                   
                     </label>
                        </a>
                        <button type="submit" class="btn btn-default hvr-shutter-in-horizontal login-sub">
                                     {{ __('Register') }}
                    </button>
            
            </div>
            </form>
            <div class="col-md-6 login-do">

                <label class="hvr-shutter-in-horizontal login-sub">
                    

                    </label>
                    <p>Already register</p>
                <a href="{{route('login')}}" class="hvr-shutter-in-horizontal">SignIn</a>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

    <br><br><br>
        <!---->
<div class="copy-right">
<p>Developed by <a href="https://github.com/AnimeshPandey123" target="_blank">Animesh Pandey</a></p> 
            <p> &copy; Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>     </div>  
<!---->
<!--scrolling js-->
    <script src="{{asset('js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <!--//scrolling js-->
        <script type="text/javascript">
        function myFunction(){
            x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
              document.getElementById("lock").className = "fa fa-unlock";
    } else {
        x.type = "password";
        document.getElementById("lock").className = "fa fa-lock";
    }
        }
        function lock(){
            x = document.getElementById("password-confirm");
            if (x.type === "password") {
                x.type = "text";
              document.getElementById("lock-confirm").className = "fa fa-unlock";
    } else {
        x.type = "password";
        document.getElementById("lock-confirm").className = "fa fa-lock";
    }
        }
    </script>
</body>
</html>

