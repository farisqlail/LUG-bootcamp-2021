@extends('layout.public')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">

                            <tr>
                              <th class="text-center">#</th>
                                <th class="text-center">Nama Produk</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Sub Total</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            @if (!empty($keranjang))
                                @foreach ($keranjang as $data)
                                    <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$data->nama_produk}}</td>
                                      <td class="text-center">{{format_rp($data->harga)}}</td>
                                      <td class="text-center">{{$data->jumlah}}</td>
                                      <td class="text-center">{{format_rp($data->subtotal)}}</td>
                                      <td class="d-flex justify-content-center">
                                        <form action="{{route('cart.destroy', [$data->id_detail])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        <a href="{{route('cart.edit', [$data->id_detail])}}" class="btn btn-info btn-sm ml-2">Update</a>
                                      </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total Harga:</strong></td>
                                    <td class="text-center"><strong>{{format_rp($transaksi->harga_total)}}</strong></td>
                                </tr>
                                <tr>
                                  <td colspan="4"></td>
                                  <td>
                                      <a href="{{route('checkout.index')}}" class="btn btn-success btn-block">
                                          <i class="fas fas-arrow-right"></i> Checkout
                                      </a>
                                  </td>
                              </tr>
                            @else
                                
                            @endif
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
