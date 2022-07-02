<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- Logo -->
                    <div class="left-content">
                        <a href="index.html"><img src=" {{asset('frontend/images/logo.png')}}" alt="logo"></a>
                    </div>
                    <!--/ End Logo -->
                </div>
                <div class="col-lg-8 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            @auth 
                                @if(Auth::user()->role=='admin')
                                    <li><i class="ti-user"></i> <a href="{{route('admin')}}"  target="_blank">Dashboard</a></li>
                                @endif

                                @if(Auth::user()->role=='pembeli')
                                    <li><i class="ti-user"></i> <a href="{{route('pembeli')}}"  target="_blank">Dashboard</a></li>
                                @endif

                                @if(Auth::user()->role=='penjual')
                                    <li><i class="ti-user"></i> <a href="{{route('penjual')}}"  target="_blank">Dashboard</a></li>
                                @endif

                                <li><i class="ti-power-off"></i>
                                <a href="{{ route('logout') }}" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                               <i data-feather="log-out"></i><span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                            @else
                                {{-- <li><i class="ti-power-off"></i><a href="{{route('login.form')}}">Login /</a> <a href="{{route('register.form')}}">Register</a></li> --}}
                            <li><i class="ti-power-off"></i><a href="{{ route('login') }}">Login / </a><a href="{{ route('register') }}">Register</a></li>
                            @endauth
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-9 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li><a href="{{route('home')}}">Home</a></li>
                                            <li><a href="{{route('cart')}}">Cart</a></li>
                                            {{-- <li><a href="{{route('checkout') }}">Checkout</a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>