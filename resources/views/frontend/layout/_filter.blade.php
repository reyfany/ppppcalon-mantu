@if(isset($itemkategori))
<ul class="nav nav-tabs" id="myTab" role="tablist">
    @foreach($itemkategori as $kategori)
<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#hello" role="tab">{{$kategori->nama_kategori}}</a></li>
    @endforeach
</ul>
@endif