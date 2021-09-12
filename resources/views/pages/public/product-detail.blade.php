@extends('layout.public')

@section('content')
    <div class="row">
        <div class="col-lg-5">
            <img src="{{ asset('storage/thumbs/produk/' . $produk->thumb) }}" alt="" class="img-fluid">
        </div>
        <div class="col">
            <h3>{{ $produk->nama_produk }}</h3>
            <p>{!! $produk->deskripsi !!}</p>
            <h4 class="d-flex align-items-center mb-4"><i class="fas fa-tags mr-2"></i> {{ $produk->harga }}</h4>
            <h4 class="d-flex align-items-center mb-4"> {{ $produk->berat }} gram</h4>
            <h5>Jumlah Beli</h5>
            <form action="{{ route('keranjang', ['id' => $produk->id_produk]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <input id="jumlah" name="jumlah" type="number" class="form-control"
                        placeholder="Masukkan jumlah beli..." min="1" max="{{$produk->stock}}">
                </div>
                @if (!Auth::user())
                    @if (empty(Auth::user()->role))
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart mr-2"></i> Add To Cart
                        </a>
                    @else
                        <button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Add To
                            Cart</button>
                    @endif
                @else
                    @php
                        $transaksi = DB::table('transaksi')
                            ->where('id_user', Auth::user()->id)
                            ->where('status_transaksi', 'keranjang')
                            ->first();
                        if ($transaksi) {
                            $detail = DB::table('detail_transaksi')
                                ->join('produk', 'produk.id_produk', '=', 'detail_transaksi.id_produk')
                                ->where('detail_transaksi.id_transaksi', '=', $transaksi->id_transaksi)
                                ->get();
                        }
                    @endphp
                    @if (!empty($detail))
                        @php
                            foreach ($detail as $data) {
                                if ($data->id_produk === $produk->id_produk) {
                                    $id_produk = $data->id_produk;
                                } else {
                                    $id_produk = 0;
                                }
                            }
                        @endphp
                        @if ($id_produk === $produk->id_produk)
                            <a href="/cart" class="btn btn-dark">
                                <i class="fas fa-shopping-cart mr-2"></i> Produk Berada di Keranjang
                            </a>
                        @else
                            <button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Add To
                                Cart</button>
                        @endif
                    @else
                        <button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Add To
                            Cart</button>
                    @endif
                @endif

            </form>
        </div>
    </div>
@endsection
