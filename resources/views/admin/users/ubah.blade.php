@include('admin.layout.top')
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
                                        <li class="breadcrumb-item">Ubah User</li>
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
                                        <form method="post" action="{{route('users.update',$user->id)}}"  enctype="multipart/form-data">
                                            @csrf 
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    @if($user->photo != null)
                                                        <div class="col-auto "><img class="image-100 rounded-circle " alt="{{$user->name}}" src="{{asset('assets/images/'. $user->photo)}}" style=" width: 150px; height:150px; margin-bottom: 25px; "></div>
                                                    @else
                                                        <div class="col-auto "><img class="image-100 rounded-circle" alt="foto1" src=" {{asset('assets/images/faces/face1.jpg')}}" style=" width: 150px; height:150px; margin-bottom: 25px; "></div>
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label class="form-label">Pilih Foto</label>
                                                        <input type="file" class="form-control" style="height: 44px; cursor:pointer;"  name="photo" value="{{$user->photo}}" readony>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Nama</label>
                                                        <input class="form-control" type="text" placeholder="Nama" name="name" value="{{$user->name}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Email</label>
                                                        <input class="form-control" type="email" placeholder="Email" name="email" value="{{$user->email}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Password</label>
                                                        <input class="form-control" type="password" placeholder="********" name="password" value="{{$user->password}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Konfirmasi Password</label>
                                                        <input class="form-control" type="password" placeholder="********" name="konfirm_password"  value="{{$user->password}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">No Telepon</label>
                                                        <input type="number" min="0" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxLengthCheck="12" maxlength = "12" class="form-control " placeholder="Nomor Telepon" name="phone" value="{{$user->phone}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="form-label">Alamat</label>
                                                        <input class="form-control" type="text" placeholder="Alamat" name="alamat" value="{{$user->alamat}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    @php 
                                                    $roles=DB::table('users')->select('role')->where('id',$user->id)->get();
                                                    // dd($roles);
                                                    @endphp
                                                    <div class="form-group ">
                                                        <label class="form-label ">Role</label>
                                                        <select name="role" class="form-control" disabled>
                                                            @foreach($roles as $role)
                                                            <option value="{{$role->role}}" {{(($role->role=='admin') ? 'selected' : '')}}>Admin</option>
                                                            <option value="{{$role->role}}" {{(($role->role=='penjual') ? 'selected' : '')}}>Penjual</option>
                                                            <option value="{{$role->role}}" {{(($role->role=='pembeli') ? 'selected' : '')}}>Pembeli</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6"><button type="submit " class="btn btn-primary ">Ubah Data</button></div>
                                            </div>
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
</html>