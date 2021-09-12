@extends('layout.public')

@section('content')
    
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('transaksi.update', [$transaksi->id_transaksi]) }}" method="post"
                        enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="pl-lg-4">

                        </div>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="bukti">Bukti Transfer</label>
                                    <div class="form-group">

                                        <a href="{{ asset('storage/history/bukti/' . $transaksi->bukti_pembayaran) }}"
                                            target="_blank">
                                            Check Bukti
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="form-control-label" for="resi">No. Resi</label>
                                        <input class="form-control" type="text" id="resi" name="resi"
                                            value="{{ $transaksi->resi }}">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" name="save" class="btn btn-primary">Tambah Resi</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
  
@endsection
