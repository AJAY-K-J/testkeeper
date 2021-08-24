<!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">
                            @if( auth()->check() && auth()->user()->role ) 
                             {{ auth()->user()->role}}  Dashboard 
                             @endif
                            </h4>
                        <div class="ms-auto text-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li> --}}
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
            
                <!-- ============================================================== -->
                <div class="row">

 <!-- Column -->
                    @yield('Column1')
                    @yield('Column2')
                    @yield('Column3')
                    @yield('Column4')
                    @yield('Column5')
                    @yield('Column6')
                    @yield('Column7')
                    @yield('Column8')
                    @yield('Column9')
                    @yield('Column10')
                   
                
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- Main  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12 mainHeight">
 
@yield('main')




                    </div>
                </div>
              
            </div>