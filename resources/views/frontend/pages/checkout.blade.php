@extends('frontend.layout.master')
@section('title','Checkout')
@section('content')
<style>
	.modal-dialog {
  top: 0;
  right: 100px;
  bottom: 700px;
  left: 0;
}
</style>
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
								<td class="d-flex justify-content-center">
									<button class="btn btn-primary mr-1" type="button" title="ubah data" data-toggle="modal" data-target="#modelupdate">Ubah</button>
									{{-- <form method="POST" action="{{route('itemalamatpengiriman.destroy', $itemalamatpengiriman->id)}}" method="post">
										@csrf 
										@method('delete')
										<button class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus?')" title="hapus data" type="submit">Hapus</button>
									</form> --}}
								</td>
							</tr>
							@endif
						</tbody>
					</table>
					<div class="card-footer">
						<button type="submit" class="btn btn-sm btn-danger"  class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
							Tambah Alamat
						</button>
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
<!-- Button trigger modal -->

<!-- store -->
<div class="modal fade " id="modelId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content">
			<div class="modal-body pl-4 pr-4">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h6 class="mb-4 modal-title" id="exampleModalLabel">Alamat Pengiriman</h6>
					
				<form action="{{ route('alamatpengiriman.store') }}" method="post">
					@csrf()
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nama_penerima">Nama Penerima</label>
								<input type="text" name="nama_penerima" class="form-control" value={{old('nama_penerima') }}>
								</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<input type="text" name="alamat" class="form-control" value={{old('alamat') }}>
							</div>
							<div class="form-group">
								<label for="no_tlp">No Tlp</label>
								<input type="number" min="0" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"
								maxLengthCheck="12" maxlength="12" class="form-control " class="form-control" name="no_tlp"
								value={{old('no_tlp') }}>
							</div>
							<div class="form-group">
								<label for="provinsi">Provinsi</label>
								<input type="text" name="provinsi" class="form-control" value={{old('provinsi') }}>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="kota">Kota</label>
								<input type="text" name="kota" class="form-control" value={{old('kota') }}>
							</div>
							<div class="form-group">
								<label for="kecamatan">Kecamatan</label>
								<input type="text" name="kecamatan" class="form-control" value={{old('kecamatan') }}>
							</div>
							<div class="form-group">
								<label for="kelurahan">Kelurahan</label>
								<input type="text" name="kelurahan" class="form-control" value={{old('kelurahan') }}>
							</div>
							<div class="form-group">
								<label for="kodepos">Kodepos</label>
								<input type="text" name="kodepos" class="form-control" value={{old('kodepos') }}>
							</div>
							<div class="form-group pull-right">
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
						</div>
					</form>
			</div>
		</div>
	</div>
</div>
{{-- end store --}}

{{-- update --}}
<div class="modal fade " id="modelupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg " role="document">
		<div class="modal-content">
			<div class="modal-body pl-4 pr-4">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h6 class="mb-4 modal-title" id="exampleModalLabel">Alamat Pengiriman</h6>
					
					{{-- <form action="{{ route('alamatpengiriman.update', $itemalamatpengiriman->id) }}" method="post"  enctype="multipart/form-data">
						@csrf 
						@method('PATCH')   
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_penerima">Nama Penerima</label>
									<input type="text" name="nama_penerima" class="form-control" value={{$itemalamatpengiriman->nama_penerima}} >
									</div>
								<div class="form-group">
									<label for="alamat">Alamat</label>
									<input type="text" name="alamat" class="form-control" value={{$itemalamatpengiriman->alamat}}>
								</div>
								<div class="form-group">
									<label for="no_tlp">No Tlp</label>
									<input type="number" min="0" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)"
									maxLengthCheck="12" maxlength="12" class="form-control " class="form-control" name="no_tlp"
									value={{$itemalamatpengiriman->no_tlp}}>
								</div>
								<div class="form-group">
									<label for="provinsi">Provinsi</label>
									<input type="text" name="provinsi" class="form-control" value={{$itemalamatpengiriman->provinsi}}>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="kota">Kota</label>
									<input type="text" name="kota" class="form-control" value={{$itemalamatpengiriman->kota}}>
								</div>
								<div class="form-group">
									<label for="kecamatan">Kecamatan</label>
									<input type="text" name="kecamatan" class="form-control" value={{$itemalamatpengiriman->kecamatan}}>
								</div>
								<div class="form-group">
									<label for="kelurahan">Kelurahan</label>
									<input type="text" name="kelurahan" class="form-control" value={{$itemalamatpengiriman->kelurahan}}>
								</div>
								<div class="form-group">
									<label for="kodepos">Kodepos</label>
									<input type="text" name="kodepos" class="form-control" value={{$itemalamatpengiriman->kodepos}}>
								</div>
								<div class="form-group pull-right">
									<button type="submit" class="btn btn-primary">Simpan</button>
								</div>
							</div>
							</div>
					</form> --}}
			</div>
		</div>
	</div>
</div>
{{-- update --}}
<script>
	function maxLengthCheck(object) {
	   if (object.value.length > object.maxLength)
		   object.value = object.value.slice(0, object.maxLength)
   };
</script>

@endsection