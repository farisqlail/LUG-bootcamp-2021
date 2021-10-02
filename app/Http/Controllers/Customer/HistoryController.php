<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transaksi = Transaksi::where('id_user', Auth::user()->id)
            ->where('status_transaksi', 'checkout')
            ->get();

        return view('pages.public.history', [
            'transaksi' => $transaksi
        ]);
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
        $transaksi = Transaksi::where('id_user', Auth::user()->id)
            ->where('status_transaksi', 'keranjang')
            ->first();
        if (empty($transaksi->kurir)) {
            return redirect()->back();
        }
        $transaksi->status_transaksi = 'checkout';
        $transaksi->save();

        $detail = DB::table('detail_transaksi')
            ->join('produk', 'produk.id_produk', '=', 'detail_transaksi.id_produk')
            ->where('detail_transaksi.id_transaksi', '=', $transaksi->id_transaksi)
            ->get();
        foreach ($detail  as $det) {
            $produk = Produk::find($det->id_produk);
            $produk->stock = $produk->stock - $det->jumlah;
            $produk->save();
        }

        return redirect()->route('history.index');
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
        $transaksi = Transaksi::where('id_user', Auth::user()->id)
            ->where('id_transaksi', $id)
            ->first();

        $detail = DB::table('detail_transaksi')
            ->join('produk', 'produk.id_produk', '=', 'detail_transaksi.id_produk')
            ->where('detail_transaksi.id_transaksi', '=', $transaksi->id_transaksi)
            ->get();
        return view('pages.public.history-detail', [
            'transaksi' => $transaksi,
            'detail' => $detail
        ]);
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
        $validator = Validator::make(request()->all(), [
            'bukti' => 'image|mimes:jpeg,png,jpg,svg|max:2024|required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        } else {
            $transaksi = Transaksi::where('id_user', Auth::user()->id)
                ->where('id_transaksi', $id)
                ->first();
            if ($request->hasFile('bukti')) {
                $img = $request->file('bukti');
                $filename = time() . '.' . $img->getClientOriginalExtension();
                Storage::putFileAs("public/history/bukti", $img, $filename);
            }
            $transaksi->bukti_pembayaran = $filename;
            $transaksi->save();
            return redirect()->route('history.index');
        }
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
