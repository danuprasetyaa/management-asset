<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough; 
use App\Models\Tagihan;
use App\Models\Rental;

class project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'id','nama','durasi_kontrak','harga_sewa'];
    
    
    
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function tagihanTerbaru(): HasOneThrough
{
    return $this->hasOneThrough(
        \App\Models\Tagihan::class,     // tujuan
        \App\Models\Rental::class,      // perantara
        'project_id',                   // FK di rentals
        'id',                           // PK di tagihan
        'id',                           // PK di project
        'rental_id'                     // FK di tagihan ke rental
    )->latestOfMany('tanggal_tagihan'); // ambil tagihan terbaru
}

}
