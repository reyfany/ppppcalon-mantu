<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MARKETPLACE || MASUK</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('assets/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendors/base/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('assetsku/images/marketplace.png')}}" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .toggle-password {
     float: right;
     cursor: pointer;
     margin-right:10px;
     margin-top: -30px;
 }
   </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <h3 class="text-center" style="color: #248afd">MASUK</h3>
                           {{-- <form class="pt-3"> --}}
                <form class="pt-3" method="POST" action="{{ route('login') }}">
                  @csrf

                {{-- <div class="form-group">
                  <label for="email">{{ __('E-Mail Address') }}</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                    </div>
                    
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div> --}}
                {{-- <div class="form-group">
                  <label for="password">{{ __('Password') }}</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-lock text-primary"></i>
                      </span>
                    </div>
                  
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div> --}}

              <div class="col-sm-12">
                <div class="form-group">
                    <label class="form-label">E-Mail Address</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>Data yang anda masukkan salah</strong>
                    </span>
                @enderror
                  </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                  <label class="form-label">Password</label>
                  <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" value="{{ old('password') }}" required autocomplete="current-password" autofocus>
                  <i class="toggle-password fa fa-fw fa-eye-slash"></i>
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
          </div>

                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      {{ __('Ingat saya') }}
                    </label>
                  </div>
                  {{-- @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                  </a>
              @endif --}}
                </div>
                <button type="submit" class="btn btn-primary">
                  {{ __('Masuk') }}
              </button>
                <div class="text-center mt-4 font-weight-light">
                  Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Daftar</a>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2021  All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{asset('assets/vendors/base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{asset('assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('assets/js/template.js')}}"></script>
  <script src="{{asset('assets/js/todolist.js')}}"></script>
  <!-- endinject -->
  <script>
    $(".toggle-password").click(function() {
     $(this).toggleClass("fa-eye fa-eye-slash");
     input = $(this).parent().find("input");
     if (input.attr("type") == "password") {
         input.attr("type", "text");
     } else {
         input.attr("type", "password");
     }
 });
   </script>
</body>

</html>
