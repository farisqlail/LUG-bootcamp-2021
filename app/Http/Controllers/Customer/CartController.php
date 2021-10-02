<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
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
            ->where('status_transaksi', 'keranjang')
            ->first();
        if ($transaksi) {
            $keranjang = DB::table('detail_transaksi')
                ->join('produk', 'produk.id_produk', '=', 'detail_transaksi.id_produk')
                ->where('detail_transaksi.id_transaksi', '=', $transaksi->id_transaksi)
                ->get();

            return view('pages.public.cart', [
                'keranjang' => $keranjang,
                'transaksi' => $transaksi
            ]);
        }
        return view('pages.public.cart');
    }

    public function keranjang(Request $request, $id)
    {
        if (!Auth::user()) {
            if (Auth::user()->role != 'customer') {
                return redirect()->route('home.index');
            }
            return redirect()->route('login');
        }

        $transaksi = Transaksi::where('id_user', Auth::user()->id)->where('status_transaksi', 'keranjang')
            ->first();
        $produk = Produk::find($id);
        if (empty($transaksi)) {
            $transaksi = new Transaksi();
            $transaksi->id_user = Auth::user()->id;
            $transaksi->status_transaksi = 'keranjang';
            $transaksi->harga_total = $request->get('jumlah') * $produk->harga;
            $transaksi->save();
            if (!$transaksi->kode_transaksi) {
                $transaksi->kode_transaksi = 'TR-' . $transaksi->id_transaksi;
                $transaksi->save();
            }
        } else {
            $transaksi->harga_total = $transaksi->harga_total + ($request->get('jumlah') * $produk->harga);
            $transaksi->save();
        }

        $detail = new TransaksiDetail();
        $detail->id_produk = $produk->id_produk;
        $detail->id_transaksi = $transaksi->id_transaksi;
        $detail->jumlah = $request->get('jumlah');
        $detail->subtotal = $request->get('jumlah') * $produk->harga;
        $detail->save();

        return redirect()->route('cart.index');
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

        $transaksi = Transaksi::where('id_user', Auth::user()->id)
            ->where('status_transaksi', 'keranjang')
            ->first();
        if ($transaksi) {
            $detail = DB::table('detail_transaksi')
                ->join('produk', 'produk.id_produk', '=', 'detail_transaksi.id_produk')
                ->where('detail_transaksi.id_transaksi', '=', $transaksi->id_transaksi)
                ->where('detail_transaksi.id_detail',  $id)
                ->first();

            return view('pages.public.cart-update', [
                'detail' => $detail
            ]);
        }
        
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
        $transaksi = Transaksi::where('id_user', Auth::user()->id)
            ->where('status_transaksi', 'keranjang')
            ->first();
        
            $subTotal = DB::table('detail_transaksi')
                ->join('produk', 'produk.id_produk', '=', 'detail_transaksi.id_produk')
                ->where('detail_transaksi.id_transaksi', '=', $transaksi->id_transaksi)
                ->where('detail_transaksi.id_detail',  $id)
                ->first();

                $transaksi->harga_total = $transaksi->harga_total - $subTotal->subtotal + ($request->get('jumlah') * $subTotal->harga);
                $transaksi->save();
                
                $detail = TransaksiDetail::where('id_detail', $id)->first();
                $detail->jumlah = $request->get('jumlah');
                $detail->subtotal = $request->get('jumlah') * $subTotal->harga;
                $detail->save();
                return redirect()->route('cart.index');
            
        
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
        $detail = TransaksiDetail::find($id);
        if(!empty($detail)){
            $transaksi= Transaksi::where('id_transaksi', $detail->id_transaksi)->first();
            $jumlahDetail= TransaksiDetail::where('id_transaksi', $transaksi->id_transaksi)->count();
            if($jumlahDetail===1){
                $detail->delete();
                $transaksi->delete();
            }else{
                $transaksi->harga_total = $transaksi->harga_total - $detail->subtotal;
                $transaksi->update();
            }
            $detail->delete();
        }
        return redirect()->route('cart.index');
    }
}
