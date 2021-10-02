@extends('layout.public')

@section('content')
  <div class="row d-flex justify-content-center">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <form action="{{route('produk.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('nama_produk') ? ' has-error' : '' }}">
              <label for="nama_produk">Nama Produk</label>
              <input id="nama_produk" name="nama_produk" type="text" class="form-control">
                @error('nama_produk')
                  <span class="has-error">
                      {{ $message }}
                  </span>
                @enderror
            </div>
            <div class="form-group{{ $errors->has('harga') ? ' has-error' : '' }}">
              <label for="harga">Harga</label>
              <input id="harga" name="harga" type="text" class="form-control">
                @error('harga')
                  <span class="has-error">
                      {{ $message }}
                  </span>
                @enderror
            </div>
            <div class="form-group {{ $errors->has('berat') ? ' has-error' : '' }}">
              <label for="berat">Berat (gram)</label>
              <input id="berat" name="berat" type="text" class="form-control">
              @error('berat')
                <span class="has-error">
                    {{ $message }}
                </span>
              @enderror
            </div>
            <div class="form-group {{ $errors->has('stock') ? ' has-error' : '' }}">
              <label for="stock">Stock</label>
              <input id="stock" name="stock" type="text" class="form-control">
              @error('stock')
                <span class="has-error">
                    {{ $message }}
                </span>
              @enderror
            </div>
            <div class="form-group{{ $errors->has('thumb') ? ' has-error' : '' }}">
              <label for="thumb">Thumbnail Produk</label>
              <input id="thumb" name="thumb" type="file" class="form-control">
              @error('thumb')
                <span class="has-error">
                    {{ $message }}
                </span>
              @enderror
            </div>
            <div class="form-group {{ $errors->has('deskripsi') ? ' has-error' : '' }}" >
              <label for="deskripsi">Deskripsi Produk</label>
              <textarea id="deskripsi" name="deskripsi" class="form-control summernote-simple"></textarea>
              @error('deskripsi')
                <span class="has-error">
                    {{ $message }}
                </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-4">
              <i class="fas fa-plus-circle"></i> Add Product
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection