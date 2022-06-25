@include('penjual.layout.top')
<body onload="startTime()">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('admin.layout.header')
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper sidebar-icon">
            <!-- Page Sidebar Start-->
            @include('admin.layout.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="card">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3>User</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="dashboard.html"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">User</li>
                                        <li class="breadcrumb-item">Tambah User</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="edit-profile">
                                    <div class="col-lg-12">
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
                                        <form method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
                                            @csrf 
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="col-auto "><img class="image-100 " alt=" " src="{{asset('assetsku/images/dashboard/boy-2.png')}}" style=" width: 150px; height:150px; margin-bottom: 25px; "></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label class="form-label">Pilih Foto</label>
                                                        <input type="file"  name="photo" class="form-control" style="height: 44px; cursor:pointer;">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Nama</label>
                                                        <input class="form-control" type="text" placeholder="Nama"  name="name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Email</label>
                                                        <input class="form-control" type="email" placeholder="Email" name="email">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Password</label>
                                                        <input class="form-control" type="password" placeholder="********" name="password">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Konfirmasi Password</label>
                                                        <input class="form-control" type="password" placeholder="********" name="konfirm_password">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">No Telepon</label>
                                                        <input type="number" min="0" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxLengthCheck="12" maxlength = "12" class="form-control " placeholder="Nomor Telepon" name="phone" required=" " />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="form-label">Alamat</label>
                                                        <input class="form-control" type="text" placeholder="Alamat" name="alamat">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    @php 
                                                    $roles=DB::table('users')->select('role')->get();
                                                    @endphp
                                                    <div class="form-group ">
                                                        <label class="form-label ">Role</label>
                                                        <select name="role" class="form-control">
                                                            <option value="">~pilih role~</option>
                                                            @foreach($roles as $role)
                                                            <option value="{{$role->role}}">{{$role->role}}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row"><div class="col-md-4"><button type="submit " class="btn btn-primary ">Tambah Data</button></div></div>
                                        </form>
                                        <br>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('penjual.layout.bottom')
        </div>
    </div>
    <script>
        function maxLengthCheck(object) {
           if (object.value.length > object.maxLength)
               object.value = object.value.slice(0, object.maxLength)
       };
   </script>
</html>