@extends('layout.public')

@section('content')
    <div class="row">
        <div class="col">
            @if (session('msg'))
                <div class="alert alert-primary alert-dismissible fade show mt-2" role="alert">
                    {{ session('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-4"><i class="fas fa-plus-circle"></i>
                        Add Product</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tbody>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Berat (gram)</th>
                                    <th>Stock</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                                @if (!empty($produk))
                                    @foreach ($produk as $data)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $data->nama_produk }}
                                            </td>
                                            <td>
                                                {{ $data->harga }}
                                            </td>
                                            <td>
                                                {{ $data->berat }}
                                            </td>
                                            <td>
                                                {{ $data->stock }}
                                            </td>
                                            @php
                                                $detail = DB::table('detail_transaksi')
                                                    ->where('id_produk', $data->id_produk)
                                                    ->first();
                                            @endphp
                                            <td class="d-flex justify-content-center">
                                                <form action="{{ route('produk.destroy', $data->id_produk) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('produk.show', $data->id_produk) }}"
                                                        class="btn btn-sm btn-info">Detail</a>
                                                    <a href="{{ route('produk.edit', $data->id_produk) }}"
                                                        class="btn btn-sm btn-success ml-2">Edit</a>
                                                    @if (empty($detail))
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger ml-2">Hapus</button>
                                                    @else
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else

                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
