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
                                    <h3>Produk</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="dashboard.html"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Produk</li>
                                        <li class="breadcrumb-item">Ubah Produk</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                          <div class="col col-lg-4 col-md-4">
                           
                                <div class="container-fluid">
                                <h4 class="card-title">Detail Produk</h4>
                            </div>
                              <div class="container-fluid">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                          <td>Kode Produk</td>
                                          <td>
                                            {{ $itemproduk->kode_produk }}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Nama Produk</td>
                                          <td>
                                          {{ $itemproduk->nama_produk }}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Qty</td>
                                          <td>
                                          {{ $itemproduk->qty }}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Harga</td>
                                          <td>
                                            Rp. {{ number_format($itemproduk->harga, 2) }}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Asal UMKM</td>
                                          <td>
                                            {{ $itemproduk->asal_produk }}
                                          </td>
                                        </tr>
                                      </table>
                                    <div class="card-footer">
                                        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-danger pull-right ">
                                          Tutup
                                        </a>
                                      </div>
                                    </div>
                            
                            </div>
                          </div>
                          <div class="col col-lg-8 col-md-8">
                              <div class="container-fluid">
                                <h4 class="card-title">Foto Produk</h4>
                              </div>
                              <div class="container-fluid">
                                @if($itemproduk->image != null)
                                    <img class="rounded-circle" alt="{{ $itemproduk->nama_produk }}" src="{{asset('assets/images/'. $itemproduk->image)}}" style=" width: 200px; height:200px;">
                                @else
                                    <img src=" {{asset('assets/images/faces/face1.jpg')}}" class="img-100" alt="foto1">
                                @endif
                              </div>
                              <div class="container-fluid">
                                <div class="row">
                                  <div class="col mb-2">
                                    @if(count($errors) > 0)
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-warning">{{ $error }}</div>
                                    @endforeach
                                    @endif
                                    @if ($message = Session::get('error'))
                                        <div class="alert alert-warning">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                  </div>
                                </div>
                             
                              </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <!-- footer start-->
            @include('penjual.layout.bottom')
        </div>
    </div>
</html>