@include('pembeli.layout.top')
<body onload="startTime()">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('pembeli.layout.header')
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">
            <!-- Page Sidebar Start-->
            @include('pembeli.layout.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="card">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3>Konfirmasi Pembayaran</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="dashboard.html"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Pembayaran</li>
                                        <li class="breadcrumb-item">Konfirmasi Pembayaran</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col col-lg-5">
                          {{-- <div class="card card-primary card-outline"> --}}
                            <div class="card-header">
                              <h3 class="card-title">Form Pembayaran</h3>
                            </div>
                            <div class="card-body">
                              <form role="form" id="ajax" method="post" action="{{ route('confirm.store') }}" enctype="multipart/form-data">
                                @csrf()
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Email User</label>
                                        <input type="text"  class="form-control" value=" {{ $itemuser->email }}"  readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Upload Bukti Pembayaran</label>
                                        <input type="file" class="form-control" name="image" style="height: 44px; cursor:pointer;">
                                    </div>
                                {{-- {{$itemuser->id}} --}}
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary"  id="confirm">Submit</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                            <br> <br> <br> <br> <br> <br> <br> <br>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <!-- footer start-->
            @include('pembeli.layout.bottom')

        </div>
        @include('sweetalert::alert')
    </div>
</html>