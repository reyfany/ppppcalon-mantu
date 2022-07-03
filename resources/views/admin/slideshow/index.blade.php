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
                                    <h3>Slideshow</h3>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb pull-right">
                                        <li class="breadcrumb-item"><a href="admin"><i data-feather="home"></i></a></li>
                                        <li class="breadcrumb-item">Slideshow</li>
                                        <li class="breadcrumb-item">Data Slide</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                      <!-- table slideshow -->
                      <div class="row">
                        <div class="col">
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
                                <table class="table table-bordered table-striped text-center" id="test">
                                  <thead>
                                    <tr>
                                      <th width="50px">No</th>
                                      <th>Gambar</th>
                                      <th>Title</th>
                                      {{-- <th>Content</th> --}}
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($itemslideshow as $slide)
                                    <tr>
                                      <td>
                                      {{ ++$no }}
                                      </td>
                                      <td>
                                        @if($slide->foto != null)
                                        <img src="{{asset('assets/images/'. $slide->foto)}}" alt="{{ $slide->caption_title }}" width='150px' class="img-thumbnail">
                                        @endif
                                      </td>
                                      <td>
                                      {{ $slide->caption_title }}
                                      </td>
                                      <td>
                                        <form action="{{ route('slideshow.destroy', $slide->id) }}" method="post" style="display:inline;">
                                          @csrf
                                          {{ method_field('delete') }}
                                          <button type="submit" class="btn btn-sm btn-danger mb-2">
                                            Hapus
                                          </button>                    
                                        </form>
                                      </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                {{ $itemslideshow->links() }}
                              </div>
                            </div>
                            <br>
                            <div class="card-body">
                              <div class="container-fluid">
                                <div class="row">
                                  <div class="col-4">
                                    <form action="{{ url('/admin/slideshow') }}" method="post" enctype="multipart/form-data">
                                      @csrf
                                      <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <br />
                                        <input type="file" name="image" id="image">
                                      </div>
                                      <div class="form-group">
                                        <label for="caption_title">Title</label>
                                        <input type="text" name="caption_title" class="form-control">
                                      </div>
                                      {{-- <div class="form-group">
                                        <label for="caption_content">Content</label>
                                        <textarea name="caption_content" id="caption_content" rows="3" class="form-control"></textarea>
                                      </div> --}}
                                      <div class="form-group">
                                        <button class="btn btn-primary">Upload</button>
                                      </div>
                                    </form>
                                  
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @include('admin.layout.bottom')
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