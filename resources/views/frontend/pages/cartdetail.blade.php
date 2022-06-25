@extends('frontend.layout.master')
@section('title','MARKETPLACE || Cart')
<style>
	.counter {
            display: flex; 
        }
        
        .counter input {
            width: 50px;
            border: 0;
            line-height: 30px;
            font-size: 20px;
            text-align: center;
            /* background: #0052cc; */
            color: #fff;
            appearance: none;
            outline: 0;
        }
        
        .counter span {
            display: block;
            font-size: 25px;
            padding: 0 10px;
            cursor: pointer;
            color: #0a0c0f;
            user-select: none;
        }
</style>

@section('content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="blog-single.html">Cart</a></li>
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
				<table class="table shopping-cart  table-responsive table-borderless">
					<thead>
						<tr>
							<th>NO</th>
							<th>PRODUK</th>
							<th>HARGA</th>
							<th >JUMLAH</th>
							<th >SUB TOTAL</th> 
							<th ><i class="ti-trash remove-icon"></i></th>
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
								<div class="btn-group" role="group">
									<form action="{{ route('cartdetail.update',$detail->id) }}" method="post" class="form-user">
									@method('patch')
									@csrf()
									<input type="hidden" class="input kurangi-qty" name="param" value="kurang" min="1">
									<button class="btn btn-primary btn-sm kurangi-qty" >-</button>
									</form>
									
									<button class="btn btn-outline-primary btn-sm tampildata" disabled>{{($detail->qty) }}</button>
									
									<form action="{{ route('cartdetail.update',$detail->id) }}" method="post">
									@method('patch')
									@csrf()
									<input type="hidden" name="param" value="tambah">
									<button class="btn btn-primary btn-sm">+</button>
									</form>
								</div>
							</td>
							<td>
									{{ number_format($detail->subtotal, 2) }}
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
								{{--  --}}
							</div>
							<div class="col-lg-5 col-md-8 col-12">
								<div class="right">
									<ul>
										<li>Nomor Invoice<span>{{ $itemcart->no_invoice }}</span></li>
										<li>Subtotal <span>{{ number_format($itemcart->subtotal, 2) }}</span></li>
										<li class="last">Total Pembayaran<span>  {{ number_format($itemcart->total, 2) }}</span></li>
									</ul>
									<div class="button5">
										<a href="{{ route('checkout') }}" class="btn" id="button">Checkout</a>
									</div>
									<div class="button5">
									<form action="{{ url('kosongkan').'/'.$itemcart->id }}" method="post">
										@method('patch')
										@csrf()
										<button type="submit" class="btn btn-danger btn-block" id="disable-button">Kosongkan</button>
									  </form>
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

	<script type="text/javascript">
     
    </script>
@endsection