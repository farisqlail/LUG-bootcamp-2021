<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $transaksi = Transaksi::where('id_user', Auth::user()->id)
            ->where('status_transaksi', 'keranjang')
            ->first();
        $keranjang = DB::table('detail_transaksi')
            ->join('produk', 'produk.id_produk', '=', 'detail_transaksi.id_produk')
            ->where('detail_transaksi.id_transaksi', '=', $transaksi->id_transaksi)
            ->get();
        $daftarProvinsi = Province::all();

        return view('pages.public.checkout', [
            'keranjang' => $keranjang,
            'transaksi' => $transaksi,
            'daftarProvinsi' => $daftarProvinsi
        ]);
    }

    public function kurir($id)
    {
        $daftarKota = City::where('province_id', $id)
            ->pluck('name', 'city_id');

        return json_decode($daftarKota);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make(request()->all(), [
            'provinsi' => 'required',
            'kota' => 'required',
            'kurir' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            $transaksi = Transaksi::where('id_user', Auth::user()->id)
                ->where('status_transaksi', 'keranjang')
                ->first();
            $keranjang = DB::table('detail_transaksi')
                ->join('produk', 'produk.id_produk', '=', 'detail_transaksi.id_produk')
                ->where('detail_transaksi.id_transaksi', '=', $transaksi->id_transaksi)
                ->get();
            $daftarProvinsi = Province::all();
            foreach ($keranjang as $ker) {
                $berat = +$ker->berat;
            }

            $ongkir = RajaOngkir::ongkosKirim([
                'origin'        => 444,     // ID kota/kabupaten asal
                'destination'   => $request->get('kota'),      // ID kota/kabupaten tujuan
                'weight'        => $berat,    // berat barang dalam gram
                'courier'       => $request->get('kurir')    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ]);

            $biaya = $ongkir->get();

            $nama_jasa = $biaya[0]['name'];
            foreach ($biaya[0]['costs'] as $row) {
                $result[] = array(
                    'deskripsi' => $row['description'],
                    'servis' => $row['service'],
                    'biaya' => $row['cost'][0]['value'],
                    'etd' => $row['cost'][0]['etd'],
                );
            }

            return view('pages.public.checkout', [
                'keranjang' => $keranjang,
                'transaksi' => $transaksi,
                'daftarProvinsi' => $daftarProvinsi,
                'nama_jasa' => $nama_jasa,
                'result' => $result
            ]);
        }
    }

    public function jasa(Request $request)
    {
        $transaksi = Transaksi::where('id_user', Auth::user()->id)
            ->where('status_transaksi', 'keranjang')
            ->first();
        $keranjang = DB::table('detail_transaksi')
            ->join('produk', 'produk.id_produk', '=', 'detail_transaksi.id_produk')
            ->where('detail_transaksi.id_transaksi', '=', $transaksi->id_transaksi)
            ->get();
        $daftarProvinsi = Province::all();

        $transaksi->kurir = $request->get('kurir');
        $transaksi->biaya = $request->get('biaya');
        $transaksi->jasa = $request->get('jasa');
        $transaksi->etd = $request->get('etd');
        $transaksi->save();
        
        return view('pages.public.checkout', [
            'keranjang' => $keranjang,
            'transaksi' => $transaksi,
            'daftarProvinsi' => $daftarProvinsi
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
