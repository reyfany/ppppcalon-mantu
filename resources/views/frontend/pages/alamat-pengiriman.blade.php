@extends('frontend.layout.master')
@section('title','Data Pengiriman')

@section('content')
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="/">Home</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
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
         
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col">
                        Alamat Pengiriman
                      </div>
                      <div class="col-auto">
                        <a href="{{ route('checkout') }}">
                          <button type="submit" class="btn btn-sm btn-danger">Tutup</button>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-stripped">
                        <thead>
                          <tr>
                            <th>Nama Penerima</th>
                            <th>Alamat</th>
                            <th>No tlp</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($itemalamatpengiriman as $pengiriman)
                          <tr>
                            <td>
                              {{ $pengiriman->nama_penerima }}
                            </td>
                            <td>
                              {{ $pengiriman->alamat }}<br />
                              {{ $pengiriman->kelurahan}}, {{ $pengiriman->kecamatan}}<br />
                              {{ $pengiriman->kota}}, {{ $pengiriman->provinsi}} - {{ $pengiriman->kodepos}}
                            </td>
                            <td>
                              {{ $pengiriman->no_tlp }}
                            </td>
                            <td>
                              <form action="{{ route('alamatpengiriman.update',$pengiriman->id) }}" method="post">
                                @method('patch')
                                @csrf()
                                @if($pengiriman->status == 'utama')
                                <button type="submit" class="btn btn-primary btn-sm" disabled>Set Utama</button>
                                @else
                                <button type="submit" class="btn btn-primary btn-sm">Set Utama</button>
                                @endif
                              </form>
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              
							<!--/ End Shopping Summery -->
              <div class="row"> 
                <div class="col-12">
                  <div class="checkout-form">
                    <h2>Form Alamat Pengiriman</h2>
                    <!-- Form -->
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
                    <form  action="{{ route('alamatpengiriman.store') }}" method="post">
                      @csrf()
                      <div class="row">
                        <div class="col">
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
                            <input type="number" min="0" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" maxLengthCheck="12" maxlength = "12" class="form-control " class="form-control" name="no_tlp" value={{old('no_tlp') }}>
                          </div>
                          <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" value={{old('provinsi') }}>
                          </div>
                        </div>
                        <div class="col">
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
                    <!--/ End Form -->
                  </div>
                </div>
						</div>
					</div>
			</div>
		</section>
    <script>
      function maxLengthCheck(object) {
         if (object.value.length > object.maxLength)
             object.value = object.value.slice(0, object.maxLength)
     };
 </script>
@endsection