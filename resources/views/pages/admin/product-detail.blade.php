@extends('layout.public')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_produk" class="control-label">Nama Produk</label>
                        <input id="nama_produk" name="nama_produk" type="text" class="form-control"
                            value="{{ $produk->nama_produk }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input id="harga" name="harga" type="text" class="form-control" value="{{ $produk->harga }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="berat">Berat (gram)</label>
                        <input id="berat" name="berat" type="text" class="form-control" value="{{ $produk->berat }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input id="stock" name="stock" type="text" class="form-control" value="{{ $produk->stock }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="thumb">Thumbnail Produk</label>
                        <img src="{{ asset('storage/thumbs/produk/' . $produk->thumb) }}" alt="" srcset=""
                            class="img-fluid d-block mb-2" style="width: 250px">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="control-label">Deskripsi Produk</label>
                        <div>
                            {!! $produk->deskripsi !!}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
