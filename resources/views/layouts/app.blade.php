<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Marks</title>

    <!-- Styles -->
    <!-- <link rel="shortcut icon" type="image/png" href="{{asset('images/wasp.png')}}"> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/toastr.min.css') }} ">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> -->
    <!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> -->

    <link rel="stylesheet" type="text/css" href=" {{ asset('css/style.min.css') }} ">
    <!-- <link rel="stylesheet" type="text/css" href=" {{ asset('css/bootstrap.min.css') }} "> -->
    @yield('styles')   
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('admin')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      
    </ul>
     <ul class="nav navbar-nav navbar-right ml-auto" style="color:#fff;">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}" style="color:#fff;">Login</a></li>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <li><a href="{{ route('register') }}"  style="color:#fff;">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" style="color:#fff;" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
  </div>
</nav>
    <br>
        <div class="container">
            <div class="row">
                @if(Auth::check())

                <div class="col-lg-4">
                    <ul class="list-group">
                         <li class="list-group-item sido bg-primary" style="background-color:#3498db;color:#fff;border:1px solid #3498db">
                            <i class="fas fa-tachometer-alt"></i>&nbsp;
                            <a href=" {{route('home')}} " style="color:#fff;">Dashboard</a>
                        </li>
                    <li class="list-group-item sido bg-primary" style="background-color:#3498db;color:#fff;border:1px solid #3498db">
                            <i class="fas fa-chalkboard-teacher"></i>&nbsp;
                            <a href=" {{route('class')}} " style="color:#fff;">Classes</a>
                    </li>
                    <li class="list-group-item sido bg-primary" style="background-color:#3498db;color:#fff;border:1px solid #3498db">
                            <i class="fas fa-plus-circle"></i>&nbsp;
                            <a href=" {{route('class.create')}} " style="color:#fff;">Add class</a>
                    </li>
                    <li class="list-group-item sido bg-primary" style="background-color:#3498db;color:#fff;border:1px solid #3498db">
                            <i class="fas fa-user-graduate"></i>&nbsp;
                            <a href=" {{route('student.create')}} " style="color:#fff;">Add Student</a>
                    </li>
                    <li class="list-group-item sido bg-primary" style="background-color:#3498db;color:#fff;border:1px solid #3498db">
                            <i class="fas fa-user-graduate"></i>&nbsp;
                            <a href=" {{route('subject.create')}} " style="color:#fff;">Add Subject</a>
                    </li>
                    <li class="list-group-item sido bg-primary" style="background-color:#3498db;color:#fff;border:1px solid #3498db">
                            <i class="fas fa-marker"></i>&nbsp;
                            <a href=" {{route('class.terminal.select')}} " style="color:#fff;">Add Mark</a>
                    </li>
                     <li class="list-group-item sido bg-primary" style="background-color:#3498db;color:#fff;border:1px solid #3498db">
                            <i class="fas fa-marker"></i>&nbsp;
                            <a href=" {{route('terminal.create')}} " style="color:#fff;">Add Terminal</a>
                    </li>
                     

                    </ul>
                    
                </div> 
                 @endif
                <div class="col-lg-8">
                     
                    @yield('content')
                        
                </div>  
            </div>

        </div>  
    </div>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src=" {{asset('js/toastr.min.js')}} "></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}")
        @elseif(Session::has('nope'))
            toastr.warning("{{Session::get('nope')}}")
        @endif

    </script>
  
    @yield('scripts')
</body>
</html>
