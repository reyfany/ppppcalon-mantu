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
                                    <h3>Data Profile</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="dashboard.html"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Profile</li>
                                        <li class="breadcrumb-item">Data Profile</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="edit-profile">
                          <div class="row">
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
                                    <form method="POST" action="{{route('profile.update',$profile->id)}}" enctype="multipart/form-data">
                                        @csrf    
                                        @method('PATCH')
                                        <div class="row">
                                             <div class="col-md-12 ">
                                                    @if($profile->photo != null)
                                                    <div class="col-auto "><img class="image-100 rounded-circle " alt="{{$profile->name}}" src="{{asset('assets/images/'. $profile->photo)}}" style=" width: 150px; height:150px; margin-bottom: 25px; "></div>
                                                @else
                                                    <div class="col-auto "><img class="image-100 rounded-circle" alt="foto1" src=" {{asset('assets/images/faces/face1.jpg')}}" style=" width: 150px; height:150px; margin-bottom: 25px; "></div>
                                                @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Nama</label>
                                                        <input class="form-control" type="text" placeholder="Nama" name="name" value="{{$profile->name}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Email</label>
                                                        <input class="form-control" type="email" placeholder="Email" name="email" value="{{$profile->email}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Password</label>
                                                        <input class="form-control" type="password" placeholder="********" name="password" value="{{$profile->password}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Konfirmasi Password</label>
                                                        <input class="form-control" type="password" placeholder="********" name="konfirm_password" value="{{$profile->password}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="form-label">No Telepon</label>
                                                        <input type="number" min="0" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxLengthCheck="12" maxlength = "12" class="form-control " placeholder="Nomor Telepon" name="phone" value="{{$profile->phone}}" required=" " />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="form-label">Alamat</label>
                                                        <input class="form-control" type="text" placeholder="Alamat" name="alamat" value="{{$profile->alamat}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 ">
                                                    <div class="form-group ">
                                                        <label class="form-label ">Role</label>
                                                        <select name="role" class="form-control" disabled>
                                                            <option value="">-----Select Role-----</option>
                                                            <option value="{{$profile->role}}" {{(($profile->role=='admin') ? 'selected' : '')}}>Admin</option>
                                                            <option value="{{$profile->role}}" {{(($profile->role=='penjual') ? 'selected' : '')}}>Penjual</option>
                                                            <option value="{{$profile->role}}" {{(($profile->role=='pembeli') ? 'selected' : '')}}>Pembeli</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button type="submit " class="btn btn-primary ">
                                                        Ubah Data</button>
                                                </div>
                                            </div>
                                        <br>
                                    </form>
                                </div>
                            </div>
                          </div>
                        </div>
                </div>
            </div>
            @include('penjual.layout.bottom')
        </div>
    </div>
    @include('sweetalert::alert')
    <script>
         function maxLengthCheck(object) {
            if (object.value.length > object.maxLength)
                object.value = object.value.slice(0, object.maxLength)
        };
    </script>
</html>