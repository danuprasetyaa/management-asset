<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [
        'id','detailasset_id','tanggal_pengiriman','pic_pengirim','pic_penerima',
    ];

    public function detailasset()
    {
        return $this->belongsTo(DetailAsset::class);
    }
    public function rental()      
    { 
        return $this->hasOne(Rental::class); 
    }
}
