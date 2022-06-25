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
                      <div class="row">
                        <div class="col col-lg-7 col-md-7 mb-2">
                          <div class="card-body">
                              <h5 class="card-title">Item Produk</h5>
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>
                                      No
                                    </th>
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
                              <h4 class="card-title">Ringkasan Produk</h4>
                              <div class="table-responsive">
                                <table class="table">
                                  <form action="{{ route('transaksi.update', $itemorder->id) }}" method='post'>
                                  @csrf
                                  @method('PATCH')
                                  <tbody>
                                    <tr>
                                      <td>Tota</td>
                                      <td><input type="text" name="total" id="total" class="form-control" value="{{ $itemorder->cart->total }}" readonly></td>
                                    </tr>
                                    <tr>
                                      <td>Subtotal</td>
                                      <td><input type="text" name="subtotal" id="subtotal" class="form-control" value="{{ $itemorder->cart->subtotal }}" readonly></td>
                                    </tr>
                                    <tr>
                                      <td>Ongkir</td>
                                      <td><input type="text" name="ongkir" id="ongkir" class="form-control" value="{{ $itemorder->cart->ongkir }}">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Status Pembayaran</td>
                                      <td>
                                        <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                                          <option value="sudah" {{ $itemorder->cart->status_pembayaran == 'sudah' ? 'selected':'' }}>Sudah Dibayar</option>
                                          <option value="belum" {{ $itemorder->cart->status_pembayaran == 'belum' ? 'selected':'' }}>Belum Dibayar</option>
                                        </select>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Status Pengiriman</td>
                                      <td>
                                        <select name="status_pengiriman" id="status_pengiriman" class="form-control">
                                          <option value="sudah" {{ $itemorder->cart->status_pengiriman == 'sudah' ? 'selected':'' }}>Sudah</option>
                                          <option value="belum" {{ $itemorder->cart->status_pengiriman == 'belum' ? 'selected':'' }}>Belum</option>
                                        </select>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td><button type="submit" class="btn btn-primary">Update</button></td>
                                    </tr>
                                  </tbody>
                                  </form>
                                </table>
                              </div>
                              {{-- @if(auth()->user()->role == "pembeli")
                              <form role="form" method="post" action="{{ route('confirm.store') }}" enctype="multipart/form-data">
                                @csrf()
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Email User</label>
                                        <input type="text"  class="form-control" value="  {{ $itemorder->cart->no_invoice }}"  readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Upload Bukti Pembayaran</label>
                                        <input type="file" class="form-control" name="image" style="height: 44px; cursor:pointer;">
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>

                              @endif --}}
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




























