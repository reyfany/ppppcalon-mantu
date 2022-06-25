@extends('frontend.layout.master')
@section('title','MARKETPLACE || Produk Detail')
	
@section('content')
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="blog-single.html">Produk Detail</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Shop Single -->
		<section class="shop single section">
					<div class="container">
						<div class="row"> 
							<div class="col-12">
								<div class="row">
									<div class="col-lg-5 col-12">
										<div class="product-gallery">
											<div class="flexslider-thumbnails">
												<ul class="slides">
													@foreach($itemproduk as $produk)
														@if($produk->image != null)
															<li data-thumb="{{ $produk->nama_produk }}" rel="adjustX:10, adjustY:">
																<img src="{{asset('assets/images/'. $produk->image)}}" alt="{{ $produk->nama_produk }}">
															</li>
														@endif
													@endforeach
												</ul>
											</div>
										</div>
									
									</div>
									<div class="col-lg-7">
										<div class="product-des">
											<div class="product">
												<p style="size: 80rem;">{{$produk->nama_produk}}</p>
												<p class="cat">Kategori : {{$produk->kategori->nama_kategori }}</p>
												<p class="price">Rp. {{number_format($produk->harga,2)}}</p>
											</div>
											<div class="text-center">
												<p class="description text-justify" style="text-align: center">{!!($produk->deskripsi)!!}</p>
											</div>
										
											<div class="product-buy">
												<form action="{{ route('cartdetail.store') }}" method="POST" enctype="multipartform-data">
													@csrf 
													<div class="add-to-cart">
														<input type="hidden" name="produk_id" value={{$produk->id}}>
															<button class="btn btn-primary" type="submit">
															<i class="fa fa-shopping-cart"></i> Tambahkan Ke Keranjang
														</button>
													</div>
												</form>
												{{-- <div class="checkout mt-3">
													<button class="btn btn-danger">
														<i class="fa fa-shopping-basket"></i> Beli Sekarang
													</button>
												</div> --}}
												<br>
												<p class="availability">Stock : @if($produk->qty>0)
													<span class="badge badge-success">{{$produk->qty}}</span>
													@else 
													<span class="badge badge-danger">{{$produk->qty}}</span>  
													@endif
												</p>
											</div>
									
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
		</section>
		<!--/ End Shop Single -->

@endsection