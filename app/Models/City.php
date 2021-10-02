<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    
    protected $table = 'cities';

    protected $primaryKey = 'city_id';

    protected $fillable = [
        'province_id',
        'city_id',
        'name',
    ];

    protected $guarded = [];


    /**
     * Returns the province this city belongs to
     *
     * @return  \App\Models\Province
     */
    public function province()
    {
        return $this->belongsTo(Province::class,'province_id','id');
    }
}
