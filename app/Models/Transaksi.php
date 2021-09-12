<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table  = 'transaksi';
    protected $fillable = ['id_user', 'kode_transaksi', 'harga_total', 'status_transaksi', 'bukti_pembayaran'];
    protected $primaryKey = 'id_transaksi';
}
