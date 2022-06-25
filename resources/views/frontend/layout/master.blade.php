<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('frontend.layout.top')
</head>
<body class="js">

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header -->
    @include('frontend.layout.header')
    <!--/ End Header -->
    @yield('content')
    <!-- Start Footer Area -->
    @include('frontend.layout.footer')  
    <!-- /End Footer Area -->
    @include('frontend.layout.bottom')       

</body>
</html>