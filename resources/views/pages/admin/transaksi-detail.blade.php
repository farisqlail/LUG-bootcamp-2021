@extends('layout.public')

@section('content')
    <div class="row">
        <div class="col">
            <div class="text-right mb-3">
                <a href="{{route('transaksi.edit', [$transaksi->id_transaksi])}}" class="btn btn-primary">
                Check Bukti/Input Resi
                </a>
            </div>
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
                            </tr>
                            @if (!empty($detail))
                                @foreach ($detail as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_produk }}</td>
                                        <td class="text-center">{{ format_rp($data->harga) }}</td>
                                        <td class="text-center">{{ $data->jumlah }}</td>
                                        <td class="text-center">{{ format_rp($data->subtotal) }}</td>
                                        
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total Harga:</strong></td>
                                    <td class="text-center"><strong>{{ format_rp($transaksi->harga_total) }}</strong>
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
