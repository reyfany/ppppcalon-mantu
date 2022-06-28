@extends('frontend.layout.master')
@section('title','Checkout')

@section('content')
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="checkout">Checkout</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Start Checkout -->
		<section class="shop checkout section">
			<div class="container">
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
					<div class="row">
						<div class="col-12">
							<!-- Shopping Summery -->
							<table class="table shopping-cart table-responsive table-borderless">
								<thead>
									<tr class="main-hading">
										<th>NO</th>
										<th>PRODUK</th>
										<th>HARGA</th>
										<th>JUMLAH</th>
										<th>SUB TOTAL</th> 
									</tr>
								</thead>
								<tbody>
									@foreach($itemcart->detail as $detail)
									<tr>
										<td>
										{{ $no++ }}
										</td>
										<td>
										{{ $detail->produk->nama_produk }}
										<br />
										{{ $detail->produk->kode_produk }}
										</td>
										<td>
										{{ number_format($detail->harga, 2) }}
										</td>
										<td>
										{{ number_format($detail->qty) }} produk
										</td>
										<td>
										{{ number_format($detail->subtotal, 2) }}
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<!--/ End Shopping Summery -->
						</div>
					</div>
					
						<div class="row"> 
							<div class="col-lg-8 col-12">
								<div class="checkout-form">
									<h2>Alamat Pengiriman</h2>
									<!-- alamat -->
									<table class="table shopping-cart  table-borderless mt-4">
										<thead>
											<tr>
												<th>Nama Penerima</th>
												<th>Alamat</th>
												<th>No tlp</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											@if($itemalamatpengiriman)
											<tr>
												<td>
												{{ $itemalamatpengiriman->nama_penerima }}
												</td>
												<td>
												{{ $itemalamatpengiriman->alamat }}<br />
												{{ $itemalamatpengiriman->kelurahan}}, {{ $itemalamatpengiriman->kecamatan}}<br />
												{{ $itemalamatpengiriman->kota}}, {{ $itemalamatpengiriman->provinsi}} - {{ $itemalamatpengiriman->kodepos}}
												</td>
												<td>
												{{ $itemalamatpengiriman->no_tlp }}
												</td>
												<td> 
												<a href="{{ route('alamatpengiriman.index') }}">
													<button type="submit" class="btn btn-sm btn-danger">
														Ubah Alamat
													</button>  
												</a>                        
												</td>
											</tr>
											@endif
										</tbody>
									</table>
									<div class="card-footer">
										<a href="{{ route('alamatpengiriman.index') }}">
											<button type="submit" class="btn btn-sm btn-danger">
												Tambah Alamat
											  </button> 
											</a>
									</div>
									<!--/ End Form -->
								</div>
							</div>
							<div class="col-lg-4 col-12">
								<div class="order-details">
									<!-- Order Widget -->
									<div class="single-widget">
										<h2>RINGKASAN</h2>
										<div class="content">
											<ul>
												<li>No Invoice<span> {{ $itemcart->no_invoice }}</span></li>
												<li>Subtotal<span> {{ number_format($itemcart->subtotal, 2) }}</span></li>
												<li>Total<span>{{ number_format($itemcart->total, 2) }}</span></li>
											</ul>
										</div>
									</div>
									<!--/ End Order Widget -->
									<!-- Order Widget -->
									{{-- <div class="single-widget">
										<h2>RINGKASAN</h2>
										<br>
										<ul>
												<div class="raw">
													<div class="col-lg-10 ml-3">
														<div class="form-group">
															<label>Upload Bukti Pembayaran<span>*</span></label>
															<input type="file" name="post" placeholder="" required="required">
														</div>
													</div>
												</div>
										</ul>
									</div> --}}
									<div class="single-widget get-button">
										<div class="content">
												<form action="{{ route('transaksi.store') }}" method="post">
													@csrf()
													<button type="submit" class="btn btn-sm btn-danger">BUAT PESANAN</button>
												</form>
										</div>
									</div>
									<!--/ End Button Widget -->
								</div>
							</div>
						</div>
			</div>
		</section>
		<!--/ End Checkout -->
		@endsection