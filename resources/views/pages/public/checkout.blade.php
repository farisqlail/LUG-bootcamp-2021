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
                            </tr>
                            @if (!empty($keranjang))
                                @foreach ($keranjang as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nama_produk }}</td>
                                        <td class="text-center">{{ format_rp($data->harga) }}</td>
                                        <td class="text-center">{{ $data->jumlah }}</td>
                                        <td class="text-center">{{ format_rp($data->subtotal) }}</td>
                                    </tr>
                                @endforeach

                            @else
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Pilih Jasa Kurir</h4>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-3">
                            <form action="{{ route('checkout.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="provinsi" class="control-label">Pilih Provinsi</label>
                                    <select name="provinsi" id="provinsi" class="form-control"
                                        value="{{ old('provinsi') }}" required>
                                        <option value="0">Pilih Provinsi</option>
                                        @forelse ($daftarProvinsi as $prov)
                                            <option value="{{ $prov->province_id }}">
                                                {{ $prov->name }}
                                            </option>
                                        @empty
                                            <option value="0">Tidak Ada Daftar Provinsi</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kota" class="control-label">Pilih Kota/Kabupaten</label>
                                    <select name="kota" id="kota" class="form-control" value="{{ old('kota') }}"
                                        required>
                                        <option value="0">Pilih Kota/Kabupaten</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kurir" class="control-label">Pilih Jasa Kurir</label>
                                    <select name="kurir" id="kurir" class="form-control" value="{{ old('kurir') }}"
                                        required>
                                        <option value="0">Pilih Kota/Kabupaten</option>
                                        <option value="jne">JNE</option>
                                        <option value="pos">POS Indonesia</option>
                                        <option value="tiki">TIKI</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle mr-2"></i>Check
                                    Ongkir</button>
                            </form>
                        </div>
                        <div class="col-9">
                            @if (!empty($result))
                                <div class="table-responsive">
                                    <table class="table table-borderless table-md">
                                        <tr>
                                            <th class="text-center">Nama Jasa</th>
                                            <th class="text-center">Deskripsi</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @forelse ($result as $res)
                                            <form action="{{ route('jasa') }}" method="post">
                                                @csrf
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $nama_jasa }}
                                                        <input type="hidden" name="kurir" id="kurir"
                                                            value="{{ $nama_jasa }}">
                                                    </td>
                                                    <td class="text-center">
                                                        <ul>
                                                            <li>
                                                                {{ format_rp($res['biaya']) }}
                                                                <input type="hidden" name="biaya" id="biaya"
                                                                    value="{{ $res['biaya'] }}">
                                                            </li>
                                                            <li>
                                                                {{ $res['deskripsi'] }} ({{ $res['servis'] }})
                                                                <input type="hidden" name="jasa" id="jasa"
                                                                    value="{{ $res['servis'] }}">
                                                            </li>
                                                            <li>
                                                                Estimasi sampai (hari): {{ $res['etd'] }} 
                                                                <input type="hidden" name="etd" id="etd"
                                                                    value="{{ $res['etd'] }}">
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-warning text-center">
                                                            Pilih Jasa
                                                        </button>
                                                    </td>
                                                </tr>
                                            </form>
                                        @empty

                                        @endforelse
                                    </table>
                                </div>
                            @else

                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col">
                            <h4>Informasi Pembayaran</h4>
                            <hr>
                            <p>Untuk pembayaran dapat ditransfer ke rekening di bawah ini:</p>
                            <div class="media">
                                <img src="{{ asset('assets/img/mandiri.png') }}" alt="" width="70" class="mr-3">
                                <div class="media-body">
                                    <h5>BANK MANDIRI</h5>
                                    No. Rekening <strong>xxx-xxx-xxx-xxxx</strong> atas nama: <br>
                                    <strong>xxx xxx xxx</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <h4 class="text-center">Rincian Belanja {{ $transaksi->kode_transaksi }}</h4>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-borderless table-md">
                                    @if (!empty($transaksi->kurir))
                                        <tr>
                                            <td class="text-right"><strong>Kurir:</strong></td>
                                            <td class="text-right"><strong>{{ $transaksi->kurir }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><strong>Jasa:</strong></td>
                                            <td class="text-right"><strong>{{ $transaksi->jasa }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><strong>Ongkos Kirim:</strong></td>
                                            <td class="text-right"><strong>{{ format_rp($transaksi->biaya) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><strong>Total Harga:</strong></td>
                                            <td class="text-right">
                                                <strong>{{ format_rp($transaksi->harga_total + $transaksi->biaya) }}</strong>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-right"><strong>Total Harga:</strong></td>
                                            <td class="text-right">
                                                <strong>{{ format_rp($transaksi->harga_total) }}</strong></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <hr>
                            @if (empty($transaksi->kurir))
                                <button type="button" class="btn btn-warning btn-block">Pilih Jasa Kurir Dahulu</button>
                            @else
                                <form action="{{route('history.store')}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block">Pesan Sekarang</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('select[name="provinsi"]').on('change', function() {
                var provinsi = $(this).val();
                if (provinsi) {
                    $.ajax({
                        url: '/kurir/' + provinsi,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="kota"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="kota"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="kota"]').empty();
                }
            });
        });
    </script>
@endsection
