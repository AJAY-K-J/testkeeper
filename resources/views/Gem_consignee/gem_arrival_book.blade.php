@extends('layouts.main')



@section('sidebar0')


<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
    href="/gem-dashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
        class="hide-menu">Dashboard</span></a></li>
@endsection




 <!-- Column -->
          <!-- ============================================================== -->
                    <!-- ============================================================== -->
                              <!-- ============================================================== -->




                              @section('Column1')

                              <!-- Column -->
                              <div class="col-md-6 col-lg-2 col-xlg-3">
                                 <a href="/gem-dashboard"> <div class="card card-hover">
                                      <div class="box bg-cyan text-center">
                                          <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                          <h6 class="text-white">Dashboard</h6>
                                      </div>
                                  </div></a>
                              </div>
              
          @endsection

          
@section('Column2')
<!-- Column -->

                   
<div class="col-md-6 col-lg-4 col-xlg-3">
  <a href="gem-arrival-book"><div class="card card-hover">
       <div class="box bg-success text-center">
           <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
           <h6 class="text-white">GEM Arrival Book</h6>
       </div>
   </div></a> 
</div>
@endsection

@section('Column3')

                   
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                <h6 class="text-white">**** </h6>
                            </div>
                        </div>
                    </div>
@endsection

@section('Column4')

                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                                <h6 class="text-white">****</h6>
                            </div>
                        </div>
                    </div>
@endsection

    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                              <!-- ============================================================== -->




@section('main')

<gem-arrival-book> </gem-arrival-book>

@endsection