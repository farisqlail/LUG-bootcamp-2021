@extends('layout.public')

@section('content')
  <div class="row d-flex justify-content-center">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <form action="">
            <div class="form-group">
              <label for="product_name">Product Name</label>
              <input id="product_name" name="product_name" type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="product_price">Product Price</label>
              <input id="product_price" name="product_price" type="text" class="form-control">
            </div>
            <div class="form-group">
              <label for="product_thumbnail">Product Thumbnail</label>
              <input id="product_thumbnail" name="product_thumbnail" type="file" class="form-control">
            </div>
            <div class="form-group">
              <label for="product_desc">Product Description</label>
              <textarea id="product_desc" name="product_desc" class="form-control summernote-simple"></textarea>
            </div>
            <button type="submit" class="btn btn-success mb-4">
              <i class="fas fa-plus-circle"></i> Update Product
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection