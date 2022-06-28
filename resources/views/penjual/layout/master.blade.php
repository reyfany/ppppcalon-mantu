@include('penjual.layout.top')
<body onload="startTime()">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('penjual.layout.header')
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">
            <!-- Page Sidebar Start-->
            @include('penjual.layout.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-6">
                                <h3>Dashboard</h3>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item"><a href="penjual"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                @yield('content') 
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('penjual.layout.bottom')
        </div>
    </div>
</body>

</html>