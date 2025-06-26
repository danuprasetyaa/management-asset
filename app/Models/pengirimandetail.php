<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengirimandetail extends Model
{
    use HasFactory;
    
    protected $table = 'pengiriman_detail';

    protected $fillable = [
        'id','pengiriman_id','asset_id','keterangan',
    ];

    
    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class, 'pengiriman_id');
    }

}
