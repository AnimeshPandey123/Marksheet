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

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="{{asset('css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet"> 
<script src="{{asset('js/jquery.min.js')}}"> </script>
<script src="{{asset('js/bootstrap.min.js')}}"> </script>
<style type="text/css">
body{
     image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
</head>
<body background="{{asset('img/newimage.jpg')}}">
    <div class="login" style="width: 70%">
        <!-- <h1><a href="{{route('index')}}">Marksheet </a></h1> -->
        <div class="login-bottom">
            <h2 class="text-center">Login</h2>
            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
            <div class="">
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

                                        <i class="fa fa-envelope-o"></i>
                                    </span>
                                     <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="email">

                              
                </div>
                
                <div class="input-group">

                                    <span class="input-group-addon">
                                        <i id="lock" class="fa fa-eye" onclick="myFunction()"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="password">

                                
                                </div>
                   <a class="news-letter " href="#">
                    <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><label class="checkbox1" for="remember">
                                        {{ __('Remember Me') }}
                     </label>
                        </a>
                        <button type="submit" class="btn btn-default hvr-shutter-in-horizontal login-sub">
                                    {{ __('Login') }}
                    </button>
            
            </div>
            </form>
           <!--  <div class="col-md-6 login-do">

                <label class="hvr-shutter-in-horizontal login-sub">
                    

                    </label>
                    <p>Do not have an account?</p>
               
            </div>
            --> <div class="clearfix"> </div>
        </div>
    </div>

    <br><br><br>
        <!---->
<div class="copy-right">
<p>Developed by <a href="https://github.com/AnimeshPandey123" target="_blank">Animesh Pandey</a></p>
<p>  Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>     </div>  
<!---->
<!--scrolling js-->
    <script src="{{asset('js/jquery.nicescroll.js"')}}></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <!--//scrolling js-->
    <script type="text/javascript">
        function myFunction(){
            x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
              document.getElementById("lock").className = "fa fa-eye-slash";
    } else {
        x.type = "password";
        document.getElementById("lock").className = "fa fa-eye";
    }
        }
    </script>
</body>
</html>

