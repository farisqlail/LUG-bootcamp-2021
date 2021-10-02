<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_transaksi';

    protected $table = 'transaksi';

    protected $fillable = [
        'id_user',
        'kode_transaksi',
        'harga_total',
        'status_transaksi',
        'bukti_pembayaran',
    ];

    /**
     * Returns the user this transaksi belongs to
     *
     * @return  \App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }

}
