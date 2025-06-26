<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';

    protected $fillable = ['id','nomor_invoice', 'keterangan', 'tanggal_tagihan'];

      public function details()
    {
        return $this->hasMany(TagihanDetail::class);
    }

}
