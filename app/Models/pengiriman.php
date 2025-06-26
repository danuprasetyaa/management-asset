<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [
        'id','project_id','tanggal_pengiriman','pic_pengirim','pic_penerima',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

      public function details()
    {
        return $this->hasMany(Pengirimandetail::class, 'pengiriman_id');
    }

}
