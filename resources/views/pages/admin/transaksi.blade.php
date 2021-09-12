@extends('layout.public')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                                <th class="text-center">Kode Transaksi</th>
                                <th class="text-center">Harga Produk</th>
                                <th class="text-center">Jasa Kurir</th>
                                <th class="text-center">Ongkir</th>
                                <th class="text-center">Total Bayar</th>
                                <th class="text-center">Bukti Pembayaran</th>
                                <th class="text-center">No. Resi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            @if (!empty($transaksi))
                                @foreach ($transaksi as $data)
                                    <tr>
                                        <td>{{ $data->kode_transaksi }}</td>
                                        <td class="text-center">{{ $data->kurir }}</td>
                                        <td class="text-center">{{ format_rp($data->harga_total) }}</td>
                                        <td class="text-center">{{ format_rp($data->biaya) }}</td>
                                        <td class="text-center">{{ format_rp($data->harga_total + $data->biaya) }}</td>
                                        <td class="text-center">
                                            @if (!empty($data->bukti_pembayaran))
                                                <button type="button" class="btn btn-success">Bukti Telah Terupload</button>
                                            @else
                                            <button type="button" class="btn btn-warning">Bukti Belum Terupload</button>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (!empty($data->resi))
                                                {{ $data->resi }}
                                            @else

                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            
                                            <a href="{{ route('transaksi.show', [$data->id_transaksi]) }}"
                                                class="btn btn-sm btn-info ml-2">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            @else

                            @endif
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
