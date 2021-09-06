@extends('layout.public')

@section('content')
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <a href="{{ route('product.create') }}" class="btn btn-primary mb-4"><i class="fas fa-plus-circle"></i> Add Product</a>
          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <tbody>
              <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
              <tr>
                <td>1</td>
                <td>Irwansyah Saputra</td>
                <td>2017-01-09</td>
                <td>
                  <a href="#" class="btn btn-danger btn-sm">Delete</a>
                  <a href="{{ route('product.update') }}" class="btn btn-success btn-sm">Update</a>
                  <a href="#" class="btn btn-info btn-sm">Detail</a>
                </td>
              </tr>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection