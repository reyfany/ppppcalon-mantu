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
                                    <h3>Daftar Users</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="admin"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Users</li>
                                        <li class="breadcrumb-item">Data Users</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="container-fluid">
                            <a href="{{route('users.create')}}">
                                <button class="text-white btn btn-success pull-right mb-2" type="button" title="tambah data"><i class="fa fa-plus">
                                    </i>&emsp; Tambah User
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
                                <table class="table table-bordered table-striped text-center" id="test">
                                    <thead>
                                        <tr>
                                            <th scope="col ">No</th>
                                            <th scope="col ">Nama</th>
                                            <th scope="col ">Email</th>
                                            <th scope="col ">Foto</th>
                                            <th scope="col ">Role</th>
                                            {{-- <th scope="col ">No Telepon</th> --}}
                                            <th scope="col ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)  
                                        <tr>
                                            <th>{{$user->id}}</th>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @if($user->photo != null)
                                                    <img class="rounded-circle " alt="{{ $user->name }}" src="{{asset('assets/images/'. $user->photo)}}" style=" width: 110px; height:110px;">
                                                @else
                                                    <img src=" {{asset('assets/images/faces/face1.jpg')}}" class="img-100" alt="foto1">
                                                @endif
                                            </td>
                                            <td>{{$user->role}}</td>
                                            {{-- <td>{{$user->phone}}</td> --}}
                                            <td class="d-flex justify-content-center">
                                                <a href="{{route('users.edit',$user->id)}}"> <button class="icon-pencil-alt btn btn-primary mr-1" type="button" title="ubah data"></button> </a>
                                                <form method="POST" action="{{route('users.destroy',[$user->id])}}" method="post">
                                                    @csrf 
                                                    @method('delete')
                                                        <button class="icofont icofont-ui-delete btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus?')" title="hapus data" type="submit"></button>
                                                        </form>
                                            </td>                
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <span style="float:right">{{$users->links()}}</span>
                            </div>
                    </div>
                </div>
            </div>
            <!-- footer start-->
            @include('admin.layout.bottom')
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