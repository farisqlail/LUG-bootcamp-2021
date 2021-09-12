@extends('layout.public')

@section('content')
<div class="row">
  <div class="col-lg-5">
    <img src="{{asset('storage/thumbs/produk/'. $detail->thumb) }}" alt="" class="img-fluid">
  </div>
  <div class="col">
    <h3>{{$detail->nama_produk}}</h3>
    <p>{!!$detail->deskripsi!!}</p>
    <h4 class="d-flex align-items-center mb-4"><i class="fas fa-tags mr-2"></i> {{format_rp($detail->harga)}}</h4>
    <h4 class="d-flex align-items-center mb-4">{{$detail->berat}} gram</h4>
    <h5>Jumlah Beli</h5>
    <form action="{{route('cart.update', [$detail->id_detail])}}" method="POST">
      {{method_field('PUT')}}
      @csrf
      <div class="form-group">
        <input id="jumlah" name="jumlah" type="number" class="form-control" min="1" max="{{$detail->stock}}" value="{{$detail->jumlah}}">
      </div>
      <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Order Update</button>
    </form>
  </div>
</div>
@endsection