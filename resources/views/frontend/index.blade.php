@extends('frontend.layout.master')
@section('title','MARKETPLACE || HOME PAGE')
@section('content')
<div id="carouselId" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
         @foreach($itemslide as $index => $slide )
          @if($index == 0)
        <li data-target="#carouselId" data-slide-to="0" class="active"></li>
        <li data-target="#carouselId" data-slide-to="1"></li>
        <li data-target="#carouselId" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img src="{{asset('assets/images/'. $slide->foto)}}" alt="First slide">
        </div>
        @else
        <div class="carousel-item">
            <img src="{{asset('assets/images/'. $slide->foto)}}" alt="Second slide">
        </div>
        @endif
        @endforeach 
        {{-- <div class="carousel-item">
            <img src="{{asset('frontend/photos/1/slide3.jpg')}}" alt="Third slide">
        </div> --}}
    </div>
    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
{{-- end slider --}}

<!-- Start Daftar Produk -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Daftar Produk</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">        
                <div class="product-info">
                        <div class="nav-main">
                            <ul class="nav nav-tabs isotop filter-tope-group" id="myTabContent" role="tablist">
                                @php 
                                    $itemkategori=DB::table('kategoris')->where('status','active')->limit(5)->get();
                                @endphp
                                @if($itemkategori)
                                    <button class="btn" style="background:black" data-filter="*">
                                        All Products
                                    </button>
                                    @foreach($itemkategori as $kategori)
                                    <button class="btn"  style="background:none;color:black;" data-filter=".{{$kategori->id}}">
                                        {{$kategori->nama_kategori}}
                                    </button>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                                <div class="tab-content isotope-grid">
                                    <div class="tab-pane fade show active" id="man" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row">
                                            @php 
                                            $itemproduk=DB::table('produks')->where('status','active')->get();
                                            @endphp
                                                    @foreach($itemproduk as $produk)
                                                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35">
                                                        <div class="single-product isotope-item {{$produk->kategori_id}}">
                                                            <div class="product-img">
                                                                {{-- {{route('produkdetail',$produk->id)}} --}}
                                                                {{-- URL::to('produk/'.$produk->id --}}
                                                                <a href="{{ route('produkdetail',$produk->id) }}">
                                                                    @if($produk->image != null)
                                                                    <img class="default-img img-thumbnail" style="width: 250px; height:250px " src="{{asset('assets/images/'. $produk->image)}}" alt="{{ $produk->nama_produk }}">
                                                                    <img class="hover-img" src="{{asset('assets/images/'. $produk->image)}}" alt="{{ $produk->nama_produk }}">
                                                                    @else
                                                                    <img src="{{ asset('images/bag.jpg') }}" alt="{{ $produk->nama_produk }}" class="card-img-top">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="product-content">
                                                                <h3><a href="{{ route('produkdetail',$produk->id) }}">
                                                                    <b>{{$produk->nama_produk}}</b>
                                                                    </a>
                                                                </h3>
                                                                <div class="product-info">Umkm. {{$produk->asal_produk}}</a></div>
                                                                    <div class="product-price">
                                                                    <div style="padding-left:0%;">Rp. {{number_format($produk->harga,2)}}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @include('sweetalert::alert') --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> --}}
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
       <script>
            /*==================================================================
            [ Isotope ]*/
            var $topeContainer = $('.isotope-grid');
            var $filter = $('.filter-tope-group');

            // filter items on button click
            $filter.each(function () {
                $filter.on('click', 'button', function () {
                    var filterValue = $(this).attr('data-filter');
                    $topeContainer.isotope({filter: filterValue});
                });
                
            });

            // init Isotope
            $(window).on('load', function () {
                var $grid = $topeContainer.each(function () {
                    $(this).isotope({
                        itemSelector: '.isotope-item',
                        layoutMode: 'fitRows',
                        percentPosition: true,
                        animationEngine : 'best-available',
                        masonry: {
                            columnWidth: '.isotope-item'
                        }
                    });
                });
            });

            var isotopeButton = $('.filter-tope-group button');

            $(isotopeButton).each(function(){
                $(this).on('click', function(){
                    for(var i=0; i<isotopeButton.length; i++) {
                        $(isotopeButton[i]).removeClass('how-active1');
                    }

                    $(this).addClass('how-active1');
                });
            });
        </script>
@endsection