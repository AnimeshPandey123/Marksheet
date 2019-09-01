@extends('layouts.new')
@section('abovescript')
<script src="js/Chart.js"></script>
@stop
@section('styles')
<style type="text/css">
    .tile_count {
    margin-bottom: 20px;
    margin-top: 20px
}
.tile_count .tile_stats_count {
    border-bottom: 1px solid #D9DEE4;
    padding: 0 10px 0 20px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    position: relative
}
@media (min-width: 992px) {
    footer {
        margin-left: 230px
    }
}
@media (min-width: 992px) {
    .tile_count .tile_stats_count {
        margin-bottom: 10px;
        border-bottom: 0;
        padding-bottom: 10px
    }
}
.tile_count .tile_stats_count:before {
    content: "";
    position: absolute;
    left: 0;
    height: 65px;
    border-left: 2px solid #ADB2B5;
    margin-top: 10px
}
@media (min-width: 992px) {
    .tile_count .tile_stats_count:first-child:before {
        border-left: 0
    }
}
.tile_count .tile_stats_count .count {
    font-size: 30px;
    line-height: 47px;
    font-weight: 600
}
@media (min-width: 768px) {
    .tile_count .tile_stats_count .count {
        font-size: 40px
    }
}
@media (min-width: 992px) and (max-width: 1100px) {
    .tile_count .tile_stats_count .count {
        font-size: 30px
    }
}
.tile_count .tile_stats_count span {
    font-size: 12px
}
@media (min-width: 768px) {
    .tile_count .tile_stats_count span {
        font-size: 13px
    }
}
.tile_count .tile_stats_count .count_bottom i {
    width: 12px
}
.green {
    color: #1ABB9C
}

</style>
@stop
@section('content')
    <!--banner-->   
<!-- <div class="banner">
                <h2>
                <a href="route('admin')">Home</a>
                
                </h2>
</div> -->
<!--//banner-->
    
      <div class="asked">
    

            
             <div class="questions">
             <div class="text-center">
               @if($school)
                <h1>{{$school->name}}</h1>
                <h2>{{$school->address}}</h2>
                @endif
             </div>
                <br><br>

                <div class="text-center"><div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user-graduate"></i> Total Students</span>
              <div class="count">{{$students}}</div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-chalkboard-teacher"></i> Total Classes</span>
              <div class="count">{{$class}}</div>
             
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-list"></i> Total Terminals</span>
              <div class="count green">{{$terminal}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-calendar-alt"></i> Total Years</span>
              <div class="count">{{$years}}</div>
              
            </div>
            
          </div></div>
          
          </div>

           
             </div> 

              <br>
                           

@endsection
