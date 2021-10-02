<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiDetail extends Model
{
    use SoftDeletes;

    protected $table  = 'detail_transaksi';

    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_produk', 
        'id_transaksi', 
        'jumlah', 
        'subtotal'
    ];

    /**
     * Returns the product this transaksi detail belongs to
     *
     * @return  \App\Models\Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class,'id_produk','id');
    }

    /**
     * Returns the transaksi this transaksi detail belongs to
     *
     * @return  \App\Models\Transaksi
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class,'id_transaksi','id');
    }

}
