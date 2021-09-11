@extends('layout.public')

@section('content')
<div class="row">
  <div class="col-lg-5">
    <img src="{{asset('storage/thumbs/produk/' . $produk->thumb)}}" alt="" class="img-fluid">
  </div>
  <div class="col">
    <h3>{{$produk->nama_produk}}</h3>
    <p>{!!$produk->deskripsi!!}</p>
    <h4 class="d-flex align-items-center mb-4"><i class="fas fa-tags mr-2"></i> {{$produk->harga}}</h4>
    <h4 class="d-flex align-items-center mb-4"> {{$produk->berat}} gram</h4>
    <h5>Jumlah Beli</h5>
    <form action="">
      <div class="form-group">
        <input id="order_amount" name="order_amount" type="text" class="form-control" placeholder="enter your order amount...">
      </div>
      <button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
    </form>
  </div>
</div>
@endsection