<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $table = 'rental'; 
    
    protected $fillable = [
        'id',
        'project_id',
        'pengiriman_id',
        'status',
        'periode_mulai',
        'periode_ahir',
        'total_tagihan',
    ];

    // default otomatis
    protected $attributes = [
        'status' => 'aktif',
    ];

    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tagihan()
    {
        return $this->hasOne(Tagihan::class);
    } 
}