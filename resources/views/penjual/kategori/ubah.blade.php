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
                                    <h3>Kategori</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="dashboard.html"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Kategori</li>
                                        <li class="breadcrumb-item">Ubah Kategori</li>
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
                            <form action="{{ route('kategori.update',$itemkategori->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row ">
                                    <div class="col-md-12 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Kode Kategori </b></label>
                                            <input type="text " class="form-control " name="kode_kategori" placeholder="Kode kategori * " id="text-input " value="{{ $itemkategori->kode_kategori }}" required=" " />
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Nama Kategori </b></label>
                                            <input type="text " class="form-control "  name="nama_kategori" placeholder="Nama Kategori * " id="text-input " value="{{ $itemkategori->nama_kategori }}" required=" " />
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Slug Kategori </b></label>
                                            <input type="text " class="form-control "  name="slug_kategori" placeholder="Slug Kategori * " id="text-input " value="{{ $itemkategori->slug_kategori }}" required=" " />
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="form-group ">
                                            <label class="form-label "><b>Deskripsi</b></label>
                                            <input type="text " class="form-control "  name="deskripsi" placeholder="Deskripsi Kategori * " id="text-input " value="{{ $itemkategori->deskripsi }}" required=" " rows="5"/>
                                       </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="form-group ">
                                            <label for="status"><b>Status</b></label>
                                            <select name="status" id="status" class="form-control">
                                              <option value="active" {{ $itemkategori->status == 'active'? 'selected': ''}}>Active</option>
                                              <option value="inactive" {{ $itemkategori->status == 'inactive'? 'selected': ''}}>Inactive</option>
                                            </select>
                                       </div>
                                    </div>
                                  </div>
                                    <div class="row ">
                                        <div class="col-lg-3 ">
                                            <button type="submit " class="btn btn-primary ">Ubah Data</button>
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