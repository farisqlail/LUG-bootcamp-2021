<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table  = 'detail_transaksi';
    protected $fillable = ['id_produk', 'id_transaksi', 'jumlah', 'subtotal'];
    protected $primaryKey = 'id_detail';
}
