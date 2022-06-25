<header class="main-nav">
    <div class="logo-wrapper">
        <a href="{{ route('pembeli') }}"><img class="img-fluid for-light" src="{{asset('assetsku/images/logo/pic-1.png')}}" alt="">
            <b>  {{auth()->user()->role}}</b>
        </a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="grid" id="sidebar-toggle"> </i></div>
    </div>
    <div class="logo-icon-wrapper">
        <a href="{{ route('pembeli') }}"><img class="img-fluid" src="{{asset('assetsku/images/logo/pic-1.png')}}" alt=""></a>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <a href="{{ route('pembeli') }}"><img class="img-fluid" src="{{asset('assetsku/images/logo/pic-1.png')}}" alt=""></a>
                        <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ route('pembeli') }}">
                            <i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ route('transaksi') }}">
                            <i data-feather="shopping-cart"></i><span>Pemesanan</span></a>
                    </li>
                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ route('review') }}">
                            <i data-feather="message-circle"></i><span>Review</span></a>
                    </li> --}}
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>