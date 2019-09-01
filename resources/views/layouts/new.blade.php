<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Marksheet</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="{{asset('css/bootstrap.min.css')}}" rel='stylesheet' type='text/css' />
 <link rel="stylesheet" type="text/css" href=" {{ asset('css/toastr.min.css') }} ">
<!-- Custom Theme files -->
<link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
<script src="{{asset('js/jquery.min.js')}}"> </script>
<!-- Mainly scripts -->
<script src="{{asset('js/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
<!-- Custom and plugin javascript -->
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/screenfull.js')}}"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
			

			
		});
		</script>
@yield('abovescript')

<script src="{{asset('js/skycons.js')}}"></script>
<!--//skycons-icons-->
 @yield('styles')
</head>
<body>
<div id="wrapper">


        <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="{{route('admin')}}">MarkSheet</a></h1>         
			   </div>
			 <div class=" border-bottom">
        	<div class="full-left">
        	  <section class="full-top">
				<button id="toggle"><i class="fa fa-arrows-alt"></i></button>	
			</section>
			
            <div class="clearfix"> </div>
           </div>
     
       
            <!-- Brand and toggle get grouped for better mobile display 
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->

		    <div class="drop-men" >
		        <ul class="nav justify-content-end  float-md-righ"> 
                @guest
		        	<li class="nav-item">
                     
                            <li><a href="{{ route('login') }}" style="color:#fff;">Login</a></li>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <li><a href="{{ route('register') }}"  style="color:#fff;">Register</a></li>
                    @else
		        	
                    @endguest
		        	</li>
		        	
		            
		           
		        </ul>
		     </div><!-- /.navbar-collapse -->
			<div class="clearfix">
       
     </div>
	        @guest
            @else   
		    <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
				
                    <li>
                        <a href="{{route('admin')}}" class=" hvr-bounce-to-right"><i class="fas fa-tachometer-alt nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                    </li>
                      <li>
                    <a href="{{route('academicyear.create')}}" class=" hvr-bounce-to-right"><i class="fas fa-calendar-alt nav_icon "></i><span class="nav-label">Create Aademic Year</span> </a>
                    </li>
                   
                    <li>
                    <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-clipboard nav_icon"></i> <span class="nav-label">Class</span><span class="fa arrow"></span></a>
                     <ul class="nav nav-second-level">
                       <li> <a href="{{route('class')}}" class=" hvr-bounce-to-right"><i class="fas fa-chalkboard-teacher nav_icon"></i> <span class="nav-label">View Classes</span></a></li>
                       <li>
                        <a href="{{route('class.create')}}" class=" hvr-bounce-to-right"><i class="fa fa-plus-circle nav_icon"></i> <span class="nav-label">Add class</span> </a>
                    </li>
                      </ul>
                    </li>
					 
                    
                    <li>
                        <a href="{{route('student.create')}}" class=" hvr-bounce-to-right"><i class="fas fa-user-graduate nav_icon"></i> <span class="nav-label">Add Student</span> </a>
                    </li>
                     <li>
                     	<a href="#" class=" hvr-bounce-to-right"><i class="fa fa-book-open nav_icon"></i> <span class="nav-label">Subject</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                       		<li><a href="{{route('subject.index')}}"  class=" hvr-bounce-to-right"><i class="fas fa-book-open nav_icon"></i> <span class="nav-label">View Subject</span></a></li>
                       		<li><a href=" {{route('subject.create')}}"  class=" hvr-bounce-to-right"><i class="fa fa-book nav_icon"></i> <span class="nav-label">Add Subject</span></a></li>

                        </ul>
                        
                       
                    </li>
                     <li>
                     <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-pie-chart nav_icon"></i> <span class="nav-label">Mark</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('mark.index')}}" class=" hvr-bounce-to-right"><i class="fa fa-eye nav_icon"></i> <span class="nav-label">View Mark</span></a>
                            </li>
                            <li>
                                <a href="{{route('class.terminal.select')}}" class=" hvr-bounce-to-right"><i class="fa fa-marker nav_icon"></i> <span class="nav-label">Add Mark</span> </a>
                            </li>
                        </ul>
                       
                    </li>
                   
                    <li>
                    	<a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Terminal</span><span class="fa arrow"></span></a>
                    	<ul class="nav nav-second-level">
                    		<li>
                    			<a href="{{route('terminal.index')}}" class=" hvr-bounce-to-right"><i class="fa fa-list nav_icon"></i> <span class="nav-label">View Terminal</span></a>
                    		</li>
                    		<li>
                    			<a href="{{route('terminal.create')}}" class=" hvr-bounce-to-right"><i class="fa fa-chart-pie nav_icon"></i> <span class="nav-label">Add Terminal</span></a>
                    		</li>
                    	</ul>
                       
                    </li>
                    <li>
                    <a href="{{route('settings')}}" class=" hvr-bounce-to-right"><i class="fa fa-cog nav_icon "></i><span class="nav-label">Setting</span> </a>
                    </li>
                   
                    <li>
                   
                    <li>
                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class=" hvr-bounce-to-right"><i class="fas fa-sign-out-alt nav_icon"></i> <span class="nav-label">Logout</span></span></a>
                         

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                    </li>
                </ul>
            </div>
			</div>
            @endguest
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
  		   <div class="asked">
    

            <div class="questions">
            @yield('content')          
            </div></div>
		<!--content-->
		
		<div class="clearfix"> </div>
		</div>
		<!---->
	
  
		<div class="content-mid">
			
			
			</div>
			<div class="col-md-7 mid-content-top">
		
			</div>
			<div class="clearfix"> </div>
		</div>
	 
		<!---->

		</div>
		<div class="clearfix"> </div>
       </div>
     </div>
    <!---->
<div class="copy">
           <p>Developed by <a href="https://github.com/AnimeshPandey123" target="_blank">Animesh Pandey</a></p> <p>Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
      </div>
    </div>
    <div class="clearfix"> </div>
       </div>
     </div>
<!----><!--scrolling js-->
	<script src="{{asset('js/jquery.nicescroll.js')}}"></script>
	<script src="{{asset('js/scripts.js')}}"></script>
	<!--//scrolling js-->
	<script src="{{asset('js/bootstrap.min.js')}}"> </script>
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

