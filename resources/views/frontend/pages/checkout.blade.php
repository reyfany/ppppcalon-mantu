@extends('frontend.layout.master')
@section('title','Checkout')
@section('content')
<script type="text/javascript">
	function printIt(){
	   alert(document.getElementById('jml').value);
	   alert(document.formName.elements['jumlah[]'].value);
	}
</script>
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
							</td>
							<td>
								Rp. {{ number_format($detail->harga, 2) }}
							</td>
							<td>
								{{ $detail->qty }} produk
							</td>
							<td>
								Rp. {{ number_format($detail->subtotal, 2) }}
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
								<th>Alamat Lengkap</th>
								<th>No Telp</th>
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
									{{ $itemalamatpengiriman->kota}}, {{ $itemalamatpengiriman->provinsi}} - {{
									$itemalamatpengiriman->kodepos}}
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
								<li>Nomor Invoice<span>{{ $itemcart->no_invoice }}</span></li>
								<li>Subtotal <span id="subtotal">Rp. {{ $total }}</span></li>
								<li class="last">Total Pembayaran <span id="total">Rp. {{ $total }}</span></li>
							</ul>
						</div>
					</div>
					<div class="single-widget get-button">
						<div class="content">
							<form action="{{ route('transaksi.store') }}" method="post">
								@csrf()

								<input type="hidden" name="cart_id" value="{{ $cart_id }}">
								<input type="hidden" name="total" value="{{ $total }}">
								<button type="submit" class="btn btn-sm btn-danger">BUAT PESANAN </button>
							</form>
						</div>
					</div>
					<!--/ End Button Widget -->
				</div>
			</div>
		</div>
	</div>
</section>
@endsection