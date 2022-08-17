@extends('frontend.layout.master')
@section('title','MARKETPLACE || Cart')
@section('content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bread-inner">
					<ul class="bread-list">
						<li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
						<li class="active"><a href="cart">Cart</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumbs -->

<!-- Shopping Cart -->
<div class="shopping-cart section">
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
				<table class="table shopping-summery table-responsive table-bordered">
					<thead>
						<tr>
							<th>NO</th>
							<th>PRODUK</th>
							<th>HARGA</th>
							<th>JUMLAH</th>
							<th>SUB TOTAL</th>
							<th><i class="ti-trash remove-icon"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($itemcart->detail as $detail)
						<tr>
							<td>
								<b>{{ $no++ }}</b>
							</td>
							<td>
								<b>{{ $detail->produk->nama_produk }}</b>
								<br>
								<b>{{ $detail->produk->kode_produk }}</b>
							</td>
							<td>
								<b>Rp. {{ number_format($detail->harga, 2) }}</b>
							</td>
							<td>
								{{-- <div class="btn-group" role="group">
									<form action="{{ route('cartdetail.update',$detail->id) }}" method="post" class="form-user">
										@method('patch')
										@csrf()
										<input type="hidden" class="input kurangi-qty" name="param" value="kurang" min="1">
										<button class="btn btn-primary btn-sm kurangi-qty">-</button>
									</form>

									<button class="btn btn-outline-primary btn-sm tampildata" disabled>{{($detail->qty) }}</button>

									<form action="{{ route('cartdetail.update',$detail->id) }}" method="post">
										@method('patch')
										@csrf()
										<input type="hidden" name="param" value="tambah">
										<button class="btn btn-primary btn-sm">+</button>
									</form>
								</div> --}}
								<div class="btn-group" role="group">
									<button class="btn btn-primary btn-sm" id="kurang{{$detail->id}}">-</button>
									<input type="hidden" class="text-center" min="1" id="harga{{$detail->id}}"
										value="{{ $detail->harga }}">
									<input type="text" class="text-center" min="1" id="qty{{$detail->id}}" value="{{ $detail->qty }}"
										style="width: 80px" disabled>
									<button class="btn btn-primary btn-sm" id="tambah{{$detail->id}}">+</button>
								</div>
							</td>
							<td>
								<h6 id="totalqty{{$detail->id}}">Rp. {{$detail->subtotal}}</h6>
								{{-- {{ number_format($detail->subtotal, 2) }} --}}
							</td>
							<td>
								<form action="{{ route('cartdetail.destroy', $detail->id) }}" method="post" style="display:inline;">
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
				<!--/ End Shopping Summery -->
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<!-- Total Amount -->
				<div class="total-amount">
					<div class="row">
						<div class="col-lg-7 col-md-3 col-12">
							{{-- --}}
						</div>
						<div class="col-lg-5 col-md-8 col-12">
							<div class="right">
								<ul>
									<li>Nomor Invoice<span>{{ $itemcart->no_invoice }}</span></li>
									<li>Subtotal <span id="subtotal">Rp. {{ '0' }}</span></li>
									<li class="last">Total Pembayaran <span id="total">Rp. {{ '0' }}</span></li>
									{{-- <li>Nomor Invoice<span>{{ $itemcart->no_invoice }}</span></li>
									<li>Subtotal <span>{{ number_format($itemcart->subtotal, 2) }}</span></li>
									<li class="last">Total Pembayaran<span> {{ number_format($itemcart->total, 2) }}</span></li> --}}
								</ul>
								<div class="button5">
									<form action="{{ route('checkout') }}">
										@foreach($itemcart->detail as $detail)
										<input type="hidden" value="{{$detail->id}}" name="id[]">
										<input type="hidden" id="jml{{$detail->id}}" name="jumlah[]">
										<input type="hidden" id="stl{{$detail->id}}" name="subtotal[]">
										@endforeach
										<input type="hidden" id=no_invoice name="no_invoice" value="{{ $itemcart->no_invoice }}">
										<input type="hidden" id="ttl" name="total">
										<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
										<button type="submit" class="btn btn-info">Checkout</button>
										{{-- <a href="" class="btn" id="button">Checkout</a> --}}
									</form>
									{{-- <a href="{{ route('checkout') }}" class="btn" id="button">Checkout</a> --}}
								</div>
								<div class="button5">
									
									<a href="/">
										<button type="submit" class="btn btn-danger btn-block" id="disable-button">Continue Shopping</button>
									</a>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/ End Total Amount -->
			</div>
		</div>
	</div>
</div>
{{-- @include('sweetalert::alert') --}}
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>

<script type="text/javascript">
	$(document).ready(function() {
			var subtotal = 0;
			var id = $("#idbarang").val(id);

			<?php 
			foreach($itemcart->detail as $detail){
			?>
				var qty{{$detail->id}} = $('#qty{{$detail->id}}').val();
				var harga{{$detail->id}} = $('#harga{{$detail->id}}').val();
				var q{{$detail->id}} = parseInt(qty{{$detail->id}});
				var total{{$detail->id}} = q{{$detail->id}} * harga{{$detail->id}};
				var hasil{{$detail->id}} = 'Rp. ' + (total{{$detail->id}}/1000).toFixed(3);
				
				id = id + {{ $detail->id }};
				$("#idbarang").val(id);

				// data ringkasan pembayaran
				subtotal = subtotal + total{{$detail->id}};
				$("#subtotal").text( 'Rp. ' + (subtotal/1000).toFixed(3)); //sub total
				$("#total").text( 'Rp. ' + (subtotal/1000).toFixed(3)); //total pembayaran


				$("#jml{{$detail->id}}").val(q{{$detail->id}});
				$("#stl{{$detail->id}}").val(total{{$detail->id}});
				$("#ttl").val(subtotal);

			
			
			
			
				
				
		  $("body").on("click", "#tambah{{$detail->id}}", function(event){ 

				q{{$detail->id}}++;
				total{{$detail->id}} = q{{$detail->id}} * harga{{$detail->id}};
				hasil{{$detail->id}} = 'Rp. ' + (total{{$detail->id}}/1000).toFixed(3);
				subtotal = parseInt(subtotal) + parseInt(harga{{$detail->id}});
				$("#totalqty{{$detail->id}}").text(hasil{{$detail->id}});
				$("#qty{{$detail->id}}").val(q{{$detail->id}});
				$("#subtotal").text( 'Rp. ' + (subtotal/1000).toFixed(3));
				$("#total").text( 'Rp. ' + (subtotal/1000).toFixed(3));
				// $("#total").text(hasil);
				// $("#totalpembayaran").val(total);
				//  $("#jumlahpesanan").val(q);

				
				$("#jml{{$detail->id}}").val(q{{$detail->id}});
				$("#stl{{$detail->id}}").val(total{{$detail->id}});
				$("#ttl").val(subtotal);
			});
	
			$("body").on("click", "#kurang{{$detail->id}}", function(event){ 
				q{{$detail->id}}--;
				total{{$detail->id}} = q{{$detail->id}} * harga{{$detail->id}};
				hasil{{$detail->id}} = 'Rp. ' + (total{{$detail->id}}/1000).toFixed(3);
				subtotal = parseInt(subtotal) - parseInt(harga{{$detail->id}});
				$("#totalqty{{$detail->id}}").text(hasil{{$detail->id}});
				$("#qty{{$detail->id}}").val(q{{$detail->id}});
				$("#subtotal").text( 'Rp. ' + (subtotal/1000).toFixed(3));
				$("#total").text( 'Rp. ' + (subtotal/1000).toFixed(3));
				// $("#total").text(hasil);
				// $("#totalpembayaran").val(total);
				//  $("#jumlahpesanan").val(q);


				
				$("#jml{{$detail->id}}").val(q{{$detail->id}});
				$("#stl{{$detail->id}}").val(total{{$detail->id}});
				$("#ttl").val(subtotal);
				
			});

			
			<?php } ?>


		  
		});
</script>
@endsection