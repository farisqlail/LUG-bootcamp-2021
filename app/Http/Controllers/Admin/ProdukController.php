<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produk = Produk::all();
        return view('pages.admin.products', [
            'produk' => $produk
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
        return view('pages.admin.product-create');
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
        $validator = Validator::make(request()->all(),[
            'nama_produk' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'stock' => 'required',
            'thumb' => 'image|mimes:jpeg,png,jpg,svg|max:2024|required',
            'deskripsi' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }else{
            $produk = new Produk();
            $produk->nama_produk = $request->get('nama_produk');
            $produk->harga = $request->get('harga');
            $produk->berat = $request->get('berat');
            $produk->stock = $request->get('stock');
            if($request->hasFile('thumb')){
                $img = $request->file('thumb');
                $filename = time(). '.'. $img->getClientOriginalExtension();
                Storage::putFileAs("public/thumbs/produk", $img, $filename);
            }
            $produk->thumb = $filename;
            $produk->deskripsi = $request->get('deskripsi');
            $produk->save();
            return redirect()->route('produk.index')->with('msg', "Produk Berhasil Disimpan");
        }
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
        $produk = Produk::find($id);
        return view('pages.admin.product-detail', ['produk' => $produk]);
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
        $produk = Produk::find($id);
        return view('pages.admin.product-update', ['produk' => $produk]);
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
        $validator = Validator::make(request()->all(),[
            'nama_produk' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'stock' => 'required',
            'thumb' => 'image|mimes:jpeg,png,jpg,svg|max:2024|required',
            'deskripsi' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }else{
            $produk = Produk::find($id);
            $produk->nama_produk = $request->get('nama_produk');
            $produk->harga = $request->get('harga');
            $produk->berat = $request->get('berat');
            $produk->stock = $request->get('stock');
            if($request->hasFile('thumb')){
                $img = $request->file('thumb');
                File::delete(public_path("/storage/thumbs/produk".$produk->thumb));
                $filename = time(). '.'. $img->getClientOriginalExtension();
                Storage::putFileAs("public/thumbs/produk", $img, $filename);
            }
            $produk->thumb = $filename;
            $produk->deskripsi = $request->get('deskripsi');
            $produk->save();
            return redirect()->route('produk.index')->with('msg', "Produk Berhasil Diedit");
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
        $produk = Produk::find($id);
        File::delete(public_path("/storage/thumbs/produk".$produk->thumb));
        $produk->delete();
        return redirect()->route('produk.index')->with('msg', "Produk Berhasil Dihapus");
    }
}
