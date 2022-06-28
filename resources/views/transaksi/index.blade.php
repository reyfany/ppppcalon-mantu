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
        <!-- Page Header Ends-->
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
                                    <h3>Daftar Pesanan</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="dashboard.html"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Pemesanan</li>
                                        <li class="breadcrumb-item">Daftar Pemesanan</li>
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col ">No</th>
                                            <th scope="col ">Invoice</th>
                                            <th scope="col ">Sub Total</th>
                                            <th scope="col ">Ongkir</th>
                                            <th>Alamat</th>
                                            {{-- <th scope="col ">Total</th> --}}
                                            <th scope="col ">Status Pembayaran</th>
                                            <th scope="col ">Status Pengiriman</th>  
                                            @if($itemuser->role == 'penjual')
                                            <th scope="col ">Bukti Pembayaran</th> 
                                            @endif
                                            <th scope="col ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php $no=1;?>
                                        @foreach($itemorder as $order)
                                          <tr>
                                            <td>
                                              {{ $no }}
                                            </td>
                                            <td>
                                              {{ $order->cart->no_invoice }}
                                            </td>
                                            <td>
                                              {{ number_format($order->cart->subtotal, 2) }}
                                            </td>
                                            <td>
                                              {{ number_format($order->cart->ongkir, 2) }}
                                            </td>
                                            <td>
                                              {{ $order->alamat }}
                                            </td>
                                            {{-- <td>
                                              {{ number_format($order->cart->total, 2) }}
                                            </td>                   --}}
                                            <td>
                                              @if($order->cart->status_pembayaran=='sudah')
                                              <span class="badge badge-success">{{ $order->cart->status_pembayaran }}</span>
                                              @else
                                                  <span class="badge badge-warning">{{ $order->cart->status_pembayaran }}</span>
                                              @endif
                                              {{-- {{ $order->cart->status_pembayaran }} --}}
                                            </td>
                                            <td>
                                              @if($order->cart->status_pembayaran=='sudah')
                                                  <span class="badge badge-success">{{ $order->cart->status_pengiriman }}</span>
                                              @else
                                                  <span class="badge badge-warning">{{ $order->cart->status_pengiriman }}</span>
                                              @endif
                                              {{-- {{ $order->cart->status_pengiriman }} --}}
                                            
                                            </td>
                                            @if($itemuser->role == 'penjual')
                                            <td>
                                              {{-- @foreach ($itemorder as $data) --}}
                                              @if ($order->confirm($order->id) == true)
                                              <a href="{{ url('assets/images/'. $order->confirm($order->id)->image)}}">  <button class="icon-download btn bg-danger" download type="button"></button></a>
                                              @endif
                                              {{-- @endforeach --}}
                                            </td>
                                            @endif
                                            <td class="justify-content-center d-flex">
                                              <a href="{{ route('transaksi.show', $order->id) }}"> <button class="icon-book btn btn-success mr-2" type="button" title="detail pemesanan"></button> </a>
                                              @if($itemuser->role == 'pembeli')
                                              <form method="POST" action="{{route('transaksi.destroy',[$order->id])}}" method="post">
                                                @csrf 
                                                @method('delete')
                                                <button class="icofont icofont-ui-delete btn btn-danger mr-2" onclick="return confirm('Apakah anda yakin akan menghapus?')" title="hapus data" type="submit"></button>
                                            </form>
                                              <a href="{{ route('confirm.index', ['id' => $order->id]) }}"><button class="icon-upload btn btn-info mr-2" type="button" title="konfirmasi pembayaran"></button></a>
                                              @endif
                                              {{-- @if($itemuser->role == 'penjual' or $itemuser->role == 'pembeli') --}}
                                              @if($itemuser->role == 'penjual')
                                              <a href="{{ route('transaksi.edit', $order->id) }}"><button class="icon-pencil btn btn-info mr-2" type="button" title="edit pemesanan"></button></a>
                                              @endif
                                            </td>
                                          </tr>
                                          <?php $no++ ;?>
                                        @endforeach
                                        </tbody>
                                </table>
                                {{ $itemorder->links() }}
                            </div>
                            <br>
                    </div>
                </div>
            </div>
            <!-- footer start-->
            @include('pembeli.layout.bottom')
        </div>
    </div>
</html>