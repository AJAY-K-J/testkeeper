@extends('layouts.main')



@section('sidebar0')


<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
    href="/officedashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
        class="hide-menu">Dashboard</span></a></li>
@endsection




 <!-- Column -->
          <!-- ============================================================== -->
                    <!-- ============================================================== -->
                              <!-- ============================================================== -->




                              @section('Column1')

                              <!-- Column -->
                              <div class="col-md-6 col-lg-2 col-xlg-3">
                                 <a href="/officedashboard"> <div class="card card-hover">
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
  <a href="office-arrival"><div class="card card-hover">
       <div class="box bg-success text-center">
           <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
           <h6 class="text-white"> Arrival Book</h6>
       </div>
   </div></a> 
</div>
@endsection

@section('Column3')

                   
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-3">
                        <a href="office-gir">  <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                <h6 class="text-white">GIR Book </h6>
                            </div>
                        </div></a>
                    </div>
@endsection

@section('Column4')

                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="office-kardex"> <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                                <h6 class="text-white">Kardex </h6>
                            </div>
                        </div></a>
                    </div>
@endsection


@section('Column5')
 <!-- Column -->
 <div class="col-md-6 col-lg-2 col-xlg-3">
    <a href="/office-dsr">   <div class="card card-hover">
        <div class="box bg-info text-center">
            <h1 class="font-light text-white"><i class="mdi mdi-book-open-page-variant"></i></h1>
            <h6 class="text-white">DSR Book</h6>
        </div>
    </div></a>
</div>
<!-- Column -->
@endsection
@section('Column6')
     <!-- Column -->
     <div class="col-md-6 col-lg-4 col-xlg-3">
       <a href="office-RejectedPage"> <div class="card card-hover">
            <div class="box bg-danger text-center">
                <h1 class="font-light text-white"><i class="mdi mdi-book-open-page-variant"></i></h1>
                <h6 class="text-white">Rejection Book </h6>
            </div>
        </div></a>
    </div>
@endsection


@section('Column7')
     <!-- Column -->
     <div class="col-md-6 col-lg-4 col-xlg-3">
       <a href="office-GemConsignee"> <div class="card card-hover">
            <div class="box bg-danger text-center">
                <h1 class="font-light text-white"><i class="mdi mdi-book-open-page-variant"></i></h1>
                <h6 class="text-white">Gem Consignee book</h6>
            </div>
        </div></a>
    </div>
@endsection

@section('Column8')
 <!-- Column -->
 <div class="col-md-6 col-lg-2 col-xlg-3">
    <a href="#">   <div class="card card-hover">
        <div class="box bg-info text-center">
            <h1 class="font-light text-white"><i class="mdi mdi-book-open-page-variant"></i></h1>
            <h6 class="text-white">****</h6>
        </div>
    </div></a>
</div>
<!-- Column -->
@endsection
    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                              <!-- ============================================================== -->




@section('main')


<office-gem-consignee :supplier_details="{{json_encode($supplier_details)}}" :section_details="{{json_encode($section_details)}}"> </office-gem-consignee>

@endsection