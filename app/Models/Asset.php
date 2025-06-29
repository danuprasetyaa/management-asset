<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';

    protected $fillable = [
        'id','merk','type','spesifikasi'
    ];

    public function detailassets()
    {
        return $this->hasMany(DetailAsset::class);
    }

}
