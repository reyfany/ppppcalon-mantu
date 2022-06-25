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
                                    <h3>Form Tambah Produk</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="dashboard.html"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Produk</li>
                                        <li class="breadcrumb-item">Tambah Produk</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="container-fluid">
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
                            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row ">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label class="form-label">Pilih Foto</label>
                                            <input type="file"  name="image" class="form-control" style="height: 44px; cursor:pointer;">
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Kode Produk</b></label>
                                            <input type="text " class="form-control " placeholder="Masukkan Kode Produk * " name="kode_produk" value="{{ old('kode_produk') }}" required=" " />
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Nama Produk</b></label>
                                            <input type="text " class="form-control " placeholder="Masukkan Nama Produk * " name="nama_produk" value="{{ old('nama_produk') }}" required=" " />
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Slug Produk</b></label>
                                            <input type="text " class="form-control " placeholder="Masukkan Slug Produk * " name="slug_produk" value="{{ old('slug_produk') }}" required=" " />
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Harga Produk</b></label>
                                            <input type="text " class="form-control " placeholder="Masukkan Harga Produk * " name="harga" value="{{ old('harga') }}" required=" " />
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Kategori</b></label>
                                            <select name="kategori_id" id="kategori_id" value="{{ old('kategori_id') }}" class="form-control">
                                                                                        
                                                <option value="">Pilih Kategori</option>
                                                @foreach($itemkategori as $kategori)
                                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Persediaan</b></label>
                                            <input type="text " class="form-control " placeholder="Jumlah Persediaan Produk * " value="{{ old('qty') }}" name="qty" required=" " />
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Asal UMKM</b></label>
                                            <input type="text " class="form-control " placeholder="Asal UMKM * " name="asal_produk" value="{{ old('asal_produk') }}" required=" " />
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Deskripsi </b></label>
                                            <input type="text " class="form-control " placeholder="Deskripsi Produk * " name="deskripsi" value="{{ old('deskripsi') }}" required=" " />
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="form-group ">
                                            <label for="status"><b>Status</b></label>
                                            <select name="status" id="status"  value="{{ old('status') }}" class="form-control">
                                                <option value="active">Active</option>
                                                <option value="inactive">inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                  </div>
                                    <div class="row ">
                                        <div class="col-lg-3 ">
                                            <button type="submit " class="btn btn-primary ">
                                                Simpan Data</button>
                                        </div>
                                    </div>
                                    <br>
                                </form>
                    </div>
                </div>
            </div>
            <!-- footer start-->
            @include('penjual.layout.bottom')
        </div>
    </div>
</html>