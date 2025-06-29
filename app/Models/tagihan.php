<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';

    protected $fillable = [
        'rental_id',
        'nomor_invoice',
        'keterangan',
        'tanggal_tagihan',
        'jumlah_unit',
        'durasi_tagih',
        'grand_total',
    ];

    public function rental()      
    { 
        return $this->belongsTo(Rental::class,'rental_id'); 
    }
}
