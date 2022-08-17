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
                                    <h3>Daftar Produk</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="dashboard.html"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Produk</li>
                                        <li class="breadcrumb-item">Data Produk</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="container-fluid">
                            <a href="{{ route('produk.create') }}">
                                <button class="text-white btn btn-success pull-right mb-2" type="button" title="tambah produk"><i class="fa fa-plus">
                                    </i>&emsp; Tambah Produk
                                </button>  
                            </a>                          
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
                                <table class="table table-bordered table-striped text-center" id="test">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto Produk</th>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Asal UMKM</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($itemproduk as $produk)
                                        <tr>
                                            <td>  
                                                {{ ++$no }}
                                            </td>
                                            <td> 
                                                {{-- @if($produk->image != null)
                                                <img class="rounded-circle " alt="{{ $produk->nama_produk }}" src="{{ \Storage::url($produk->image) }}" style=" width: 110px; height:110px;">
                                                @endif --}}
                                                @if($produk->image != null)
                                                <img class="rounded-circle " alt="{{ $produk->nama_produk }}" src="{{asset('assets/images/'. $produk->image)}}" style=" width: 110px; height:110px;">
                                            @else
                                                <img src=" {{asset('assets/images/faces/face1.jpg')}}" class="img-100" alt="foto1">
                                            @endif
                                            </td>
                                            <td> 
                                                {{ $produk->kode_produk }}
                                            </td>
                                            <td>
                                                {{ $produk->nama_produk }}
                                            </td>
                                            <td>
                                                {{$produk->kategori_id}}
                                            </td>
                                            <td>
                                                {{ $produk->qty }}
                                            </td>
                                            <td>
                                                {{$produk->asal_produk}}
                                            </td>
                                            <td>
                                                {{ number_format($produk->harga, 2) }}
                                            </td>
                                            <td>
                                                @if($produk->status=='active')
                                                <span class="badge badge-success">{{$produk->status}}</span>
                                            @else
                                                <span class="badge badge-warning">{{$produk->status}}</span>
                                            @endif
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ route('produk.show', $produk->id) }}"> <button class="icon-book btn btn-primary mr-2 type="button" title="detail produk"></button> </a>
                                                <a href="{{ route('produk.edit', $produk->id) }}"> <button class="icon-pencil-alt btn btn-primary mr-2" type="button" title="ubah produk"></button> </a>
                                                <form method="POST" action="{{route('produk.destroy',[$produk->id])}}" method="post">
                                                    @csrf 
                                                    @method('delete')
                                                    <button class="icofont icofont-ui-delete btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus?')" title="hapus data" type="submit"></button>
                                                </form>
                                            </td>                
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $itemproduk->links() }}
                            </div>
                    </div>
                </div>
            </div>
            <!-- footer start-->
            @include('penjual.layout.bottom')
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#test').DataTable({
                "paging": false
            });
        });
    </script>
</html>