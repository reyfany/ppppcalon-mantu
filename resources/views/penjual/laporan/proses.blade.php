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
                        <div class="col">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                      <h3 class="card-title">Laporan Penjualan</h3>
                                    </div>
                                  <div class="col-6">
                                      <ol class="pull-right">
                                           <a href="{{ route('laporan') }}"><button class="btn btn-danger">Tutup</button>
                                            {{-- <a href="/cetak_pdf " class="btn btn-danger">Export PDF</a> --}}
                                            {{-- cetak_pdf --}}
                                      </ol>
                                  </div>
                                </div>
                            </div>
                            <div class="card-body">
                              <h3 class="text-center  text-dark">Periode {{ $bulan != ""? "Bulan ".$bulan: "" }} {{ $tahun }}</h3>
                              <div class="row">
                                <div class="col col-lg-4 col-md-4">
                                  <h4 class="text-center text-dark">Ringkasan Transaksi</h4>
                                  <!-- cetak totalnya -->
                                  <?php
                                  $total = 0;
                                  foreach ($itemtransaksi as $k) {
                                    $total += $k->cart->total;
                                  }
                                  ?>
                                  <!-- end cetak totalnya -->
                                  <table class="table table-bordered table-striped">
                                    <tbody>
                                      <tr>
                                        <td>Total Penjualan</td>
                                        <td>Rp. {{ number_format($total, 2) }}</td>
                                      </tr>
                                      <tr>
                                        <td>Total Transaksi</td>
                                        <td>{{ count($itemtransaksi) }} Transaksi</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="col col-lg-8 col-md-8">
                                  <h4 class="text-center text-dark">Rincian Transaksi</h4>
                                  <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                      <thead class="text-center">
                                        <tr>
                                          <th>No</th>
                                          <th>Invoice</th>
                                          <th>Subtotal</th>
                                          <th>Ongkir</th>
                                          <th>Total</th>
                                        </tr>
                                      </thead>
                                      <tbody class="text-center">
                                      @foreach($itemtransaksi as $transaksi)
                                        <tr>
                                          <td>{{ $no++ }}</td>
                                          <td>
                                          {{ $transaksi->cart->no_invoice }}
                                          </td>
                                          <td>
                                          {{ number_format($transaksi->cart->subtotal, 2) }}
                                          </td>
                                          <td>
                                          {{ number_format($transaksi->cart->ongkir, 2) }}
                                          </td>                      
                                          <td>
                                          {{ number_format($transaksi->cart->total, 2) }}
                                          </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
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
        @include('sweetalert::alert')
</html>