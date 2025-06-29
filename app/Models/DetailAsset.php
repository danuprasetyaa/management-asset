<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAsset extends Model
{
    use HasFactory;

    protected $table = 'detailasset';

    protected $fillable = [
        'id','asset_id','serialnumber','kondisi'
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function pengiriman()
    { 
        return $this->hasOne(Pengiriman::class,'detailasset_id'); 
    }


}
