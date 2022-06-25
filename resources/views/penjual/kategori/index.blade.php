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
                                    <h3>Daftar Kategori</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="dashboard.html"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Kategori</li>
                                        <li class="breadcrumb-item">Daftar Kategori</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="container-fluid">
                            <a href="{{ route('kategori.create') }}">
                                <button class="text-white btn btn-success pull-right mb-2" type="button" title="tambah kategori">
                                    <i class="fa fa-plus"></i>&emsp; Tambah Kategori
                                </button>
                            </a>                                           
                            <div class="table-responsive">
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
                                <table class="table-bordered table-striped text-center" id="test">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Kategori</th>
                                            <th>Nama Kategori</th>
                                            <th>Jumlah Produk</th>
                                            <th>Deskripsi Produk</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($itemkategori as $kategori)
                                        <tr>
                                            <td>
                                                {{ ++$no }}
                                            </td>
                                            <td>
                                                {{ $kategori->kode_kategori }}
                                            </td>
                                            <td>
                                                {{ $kategori->nama_kategori}}
                                            </td>
                                            <td>
                                                {{ count($kategori->produk) }} Produk
                                            </td>
                                            <td>
                                                {{$kategori->deskripsi}}
                                            </td>
                                            <td>
                                                @if($kategori->status=='active')
                                                    <span class="badge badge-success">{{$kategori->status}}</span>
                                                @else
                                                    <span class="badge badge-warning">{{$kategori->status}}</span>
                                                @endif
                                            </td>
                                            <td class="d-flex justify-content-center"> 
                                                <a href="{{route('kategori.edit',$kategori->id)}}"> <button class="icon-pencil-alt btn btn-primary mr-2" type="button" title="ubah data"></button> </a>
                                                <form method="POST" action="{{route('kategori.destroy',[$kategori->id])}}" method="post">
                                                @csrf 
                                                @method('delete')
                                                    <button class="icofont icofont-ui-delete btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus?')" title="hapus data" type="submit"></button>
                                                    </form>
                                            </td>                
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $itemkategori->links() }}
                            </div>
                    </div>
                </div>
            </div>
            
            <!-- footer start-->
            @include('penjual.layout.bottom')
        </div>
    </div>
    @include('sweetalert::alert')
   
    <script>
        $(document).ready(function() {
            $('#test').DataTable({
                "paging": false
            });
        });
    </script>
</html>