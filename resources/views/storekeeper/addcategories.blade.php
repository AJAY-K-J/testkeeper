@extends('layouts.main')


@section('sidebar0')


<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
    href="/storedashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
        class="hide-menu">Dashboard</span></a></li>
@endsection

@section('sidebar1')


<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
    href="additems" aria-expanded="false"><i class="mdi mdi-format-list-bulleted"></i><span
        class="hide-menu">Add Items</span></a></li>


    
@endsection

@section('sidebar2')
<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
    href="addsuppliers" aria-expanded="false"><i class="mdi mdi-worker"></i><span
        class="hide-menu">Add Supplier</span></a></li>
    
@endsection
@section('sidebar3')

<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
    href="adduser" aria-expanded="false"><i class="mdi mdi-account-multiple-plus"></i><span
        class="hide-menu">Add User</span></a></li>



    
@endsection
@section('sidebar4')

<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
    href="addsections" aria-expanded="false"><i class="mdi mdi-flag-checkered"></i><span
        class="hide-menu">Add Sections</span></a></li>
    
@endsection
@section('sidebar5')
<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
    href="addcategories" aria-expanded="false"><i class="mdi mdi-format-align-left"></i><span
        class="hide-menu">Add Categories</span></a></li>
    
@endsection
@section('sidebar6')

    
<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
    href="addroles" aria-expanded="false"><i class="mdi mdi-crown"></i><span
        class="hide-menu">Roles</span></a></li>
@endsection
@section('sidebar7')


    
@endsection
@section('sidebar8')

@endsection
@section('sidebar9')
       

    
@endsection

 <!-- Column -->
          <!-- ============================================================== -->
                    <!-- ============================================================== -->
                              <!-- ============================================================== -->




@section('Column1')

                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                       <a href="/storedashboard"> <div class="card card-hover">
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
    <a href="/confirmedItemPage"> <div class="card card-hover">
        <div class="box bg-success text-center">
            <h1 class="font-light text-white"><i class="mdi mdi-book-open-page-variant"></i></h1>
            <h6 class="text-white">Confirmed Arrival Book</h6>
        </div>
    </div></a>
</div>
@endsection

@section('Column3')

                   
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <a href="/girlist"> <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-book-open-page-variant"></i></h1>
                                <h6 class="text-white">GIR book</h6>
                            </div>
                        </div></a>
                    </div>
@endsection
@section('Column4')

                   <!-- Column -->
                   <div class="col-md-6 col-lg-2 col-xlg-3">
                    <a href="/kardex">   <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white"><i class="mdi mdi-book-open-page-variant"></i></h1>
                            <h6 class="text-white">Kardex Book</h6>
                        </div>
                    </div></a>
                </div>
@endsection
@section('Column5')
 <!-- Column -->
 <div class="col-md-6 col-lg-2 col-xlg-3">
    <a href="/dsr">   <div class="card card-hover">
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
       <a href="RejectedItemPage"> <div class="card card-hover">
            <div class="box bg-danger text-center">
                <h1 class="font-light text-white"><i class="mdi mdi-book-open-page-variant"></i></h1>
                <h6 class="text-white">Rejection Book </h6>
            </div>
        </div></a>
    </div>
@endsection
@section('Column7')

                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                      <a href="storeArrivalbook"> <div class="card card-hover">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-relative-scale"></i></h1>
                                <h6 class="text-white">Arrival Register Book</h6>
                            </div>
                        </div></a> 
                    </div>
@endsection
@section('Column8')
     <!-- Column -->
     <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card card-hover">
            <div class="box bg-cyan text-center">
                <h1 class="font-light text-white"><i class="mdi mdi-pencil"></i></h1>
                <h6 class="text-white">****</h6>
            </div>
        </div>
    </div>
@endsection
@section('Column9')
<div class="col-md-6 col-lg-2 col-xlg-3">
    <div class="card card-hover">
        <div class="box bg-success text-center">
            <h1 class="font-light text-white"><i class="mdi mdi-calendar-check"></i></h1>
            <h6 class="text-white">****</h6>
        </div>
    </div>
</div>
@endsection
@section('Column10')
 
@endsection





          <!-- ============================================================== -->
                    <!-- ============================================================== -->
                              <!-- ============================================================== -->



@section('main')


<div class="row">

    <div class="col-md-12">

       
        <category-list> </category-list>


        <!-- Modal -->
        <div class="modal fade" id="add-category" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">ADD CATEGORY</h5>
                      <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>-->
                    </div>
                    <div class="modal-body">

                        <add-new-category > </add-new-category>
                    </div>

                </div>
            </div>
        </div>



    </div>
</div>

    @endsection
