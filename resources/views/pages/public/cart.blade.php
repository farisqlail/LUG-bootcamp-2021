@extends('layout.public')

@section('content')
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <tbody>
              <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Action</th>
              </tr>
              <tr>
                <td>1</td>
                <td>Irwansyah Saputra</td>
                <td>2017-01-09</td>
                <td>10</td>
                <td>
                  <a href="#" class="btn btn-danger btn-sm">Delete</a>
                  <a href="{{ route('cart.update') }}" class="btn btn-success btn-sm">Update</a>
                </td>
              </tr>
            </tbody>
          </table>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <form action="">
                <div class="form-group">
                  <label for="total_payment">Total Payment</label>
                  <input id="total_payment" name="total_payment" type="text" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="shipping_method">Shipping Method</label>
                  <select id="shipping_method" name="shipping_method" class="form-control">
                    <option>Option 1</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="shipping_address">Shipping Address</label>
                  <textarea id="shipping_address" name="shipping_address" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="input_payment">Input Payment</label>
                  <input id="input_payment" name="input_payment" type="text" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Checkout</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection