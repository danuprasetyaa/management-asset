<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tagihandetail extends Model
{
    use HasFactory;

    protected $table = 'tagihan_detail';             
    protected $fillable = [
        'id',
        'tagihan_id',
        'rental_id',
        'periode_mulai',
        'periode_ahir',
        'jumlah_unit',
        'total_tagihan',
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

     public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
