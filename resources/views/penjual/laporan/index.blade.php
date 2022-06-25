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
                <div class="card">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3>Laporan Penjualan</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="dashboard.html"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Laporan Penjual</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                          <div class="col col-lg-4 col-md-4">
                            {{-- <div class="card card-primary card-outline"> --}}
                              <div class="card-header">
                                <h3 class="card-title">Form Laporan</h3>
                              </div>
                              <div class="card-body">
                                <form action="laporan/proses/">
                                  <div class="form-group">
                                    <label for="bulan">Bulan</label>
                                    <select name="bulan" id="bulan" class="form-control">
                                      <option value="1">Januari</option>
                                      <option value="2">Februari</option>
                                      <option value="3">Maret</option>
                                      <option value="4">April</option>
                                      <option value="5">Mei</option>
                                      <option value="6">Juni</option>
                                      <option value="7">Juli</option>
                                      <option value="8">Agustus</option>
                                      <option value="9">September</option>
                                      <option value="10">Oktober</option>
                                      <option value="11">Nopember</option>
                                      <option value="12">Desember</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control">
                                      @for($a = 2019; $a <= 2050; $a++)
                                      <option value="{{$a}}">{{$a}}</option>
                                      @endfor
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Buka Laporan</button>
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
            @include('penjual.layout.bottom')
        </div>
    </div>
        @include('sweetalert::alert')
</html>