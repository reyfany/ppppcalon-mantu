@include('pembeli.layout.top')
@if(auth()->user()->role == "penjual")
@include('penjual.layout.top')
@endif
<body onload="startTime()">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('pembeli.layout.header')
        @if(auth()->user()->role == "penjual")
        @include('penjual.layout.header')
        @endif
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">
            <!-- Page Sidebar Start-->
            @include('pembeli.layout.sidebar')
            @if(auth()->user()->role == "penjual")
            @include('penjual.layout.sidebar')
            @endif
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="card">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3>Detail Pemesanan</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="dashboard.html"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Pemesanan</li>
                                        <li class="breadcrumb-item">Detail Pemesanan</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
   
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col col-lg-7 col-md-7 mb-1">
                            <div class="card-body">
                                <h5 class="card-title">Item Produk</h5>
                              <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>
                                        Kode
                                      </th>
                                      <th>
                                        Nama
                                      </th>
                                      <th>
                                        Harga
                                      </th>
                                      <th>
                                        Qty
                                      </th>
                                      <th>
                                        Subtotal
                                      </th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($itemorder->cart->detail as $detail)
                                    <tr>
                                      <td>
                                      {{ $no++ }}
                                      </td>
                                      <td>
                                      {{ $detail->produk->kode_produk }}
                                      </td>
                                      <td>
                                      {{ $detail->produk->nama_produk }}
                                      </td>
                                      <td>
                                      {{ number_format($detail->harga, 2) }}
                                      </td>
                                      <td>
                                      {{ $detail->qty }}
                                      </td>
                                      <td>
                                      {{ number_format($detail->subtotal, 2) }}
                                      </td>
                                    </tr>
                                  @endforeach
                                  <tr>
                                    <td colspan="5">
                                      <b>Total</b>
                                    </td>
                                    <td>
                                      <b>
                                      {{ number_format($itemorder->cart->total, 2) }}
                                      </b>
                                    </td>
                                  </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>

                            <div class="card-body">
                              <h5 class="card-title">Alamat Penerima</h5>
                              <div class="table-responsive">
                                <table class="table table-stripped">
                                  <thead>
                                    <tr>
                                      <th>Nama Penerima</th>
                                      <th>Alamat</th>
                                      <th>No tlp</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>
                                        {{ $itemorder->nama_penerima }}
                                      </td>
                                      <td>
                                        {{ $itemorder->alamat }}<br />
                                        {{ $itemorder->kelurahan}}, {{ $itemorder->kecamatan}}<br />
                                        {{ $itemorder->kota}}, {{ $itemorder->provinsi}} - {{ $itemorder->kodepos}}
                                      </td>
                                      <td>
                                        {{ $itemorder->no_tlp }}
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>

                            <div class="card-footer">
                              <a href="{{ route('transaksi') }}" class="btn btn-sm btn-danger">Tutup</a>
                            </div>
                        </div>

                        <div class="col col-lg-5 col-md-5">
                            <div class="card-body">
                              <h5 class="card-title">Ringkasan Produk</h5>
                              <div class="table-responsive">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <td>
                                        Total
                                      </td>
                                      <td >
                                        {{ number_format($itemorder->cart->total, 2) }}
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Subtotal
                                      </td>
                                      <td>
                                      {{ number_format($itemorder->cart->subtotal, 2) }}
                                      </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                      <td>
                                        Ongkir
                                      </td>
                                      <td>
                                      {{ number_format($itemorder->cart->ongkir, 2) }}
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Status Pembayaran
                                      </td>
                                      <td>
                                      {{ $itemorder->cart->status_pembayaran }}
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                        Status Pengiriman
                                      </td>
                                      <td>
                                      {{ $itemorder->cart->status_pengiriman }}
                                      </td>
                                    </tr>
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
            <!-- footer start-->
            @include('pembeli.layout.bottom')
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#test').DataTable({
                "paging": true
            });
        });
    </script>
</html>




























