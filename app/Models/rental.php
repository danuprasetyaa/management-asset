<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rental extends Model
{
    use HasFactory;

    protected $table = 'rental'; 
    
    protected $fillable = [
        'asset_id',
        'project_id',
        'pengiriman_detail_id',
        'status',
    ];

    // default otomatis
    protected $attributes = [
        'status' => 'aktif',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function pengirimanDetail()
    {
        return $this->belongsTo(PengirimanDetail::class);
    }

    public function pengiriman()   { return $this->hasOne(Pengiriman::class); }
}