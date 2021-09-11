@extends('layout.public')

@section('content')
  <div class="row d-flex justify-content-center">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <form action="{{route('produk.update', [$produk->id_produk])}}" method="POST" enctype="multipart/form-data">
            {{method_field("PUT")}}
            @csrf
            <div class="form-group">
              <label for="nama_produk">Nama Produk</label>
              <input id="nama_produk" name="nama_produk" type="text" class="form-control" value="{{$produk->nama_produk}}">
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input id="harga" name="harga" type="text" class="form-control" value="{{$produk->harga}}">
            </div>
            <div class="form-group">
              <label for="berat">Berat (gram)</label>
              <input id="berat" name="berat" type="text" class="form-control" value="{{$produk->berat}}">
            </div>
            <div class="form-group">
              <label for="stock">Stock</label>
              <input id="stock" name="stock" type="text" class="form-control" value="{{$produk->stock}}">
            </div>
            <div class="form-group">
              <label for="thumb">Thumbnail Produk</label>
              <img src="{{asset('storage/thumbs/produk/' . $produk->thumb)}}" alt="" srcset="" class="img-fluid d-block mb-2" style="width: 250px">
              <input id="thumb" name="thumb" type="file" class="form-control">
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi Produk</label>
              <textarea id="deskripsi" name="deskripsi" class="form-control summernote-simple">{!!$produk->deskripsi!!}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mb-4">
              <i class="fas fa-plus-circle"></i> Update Product
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection