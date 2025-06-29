<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough; 
use App\Models\Tagihan;
use App\Models\Rental;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'id','nama','durasi_kontrak','harga_sewa'];

    public function rental()      
    { 
        return $this->hasOne(Rental::class,'project_id'); 
    }

    public function rentals()  { return $this->hasMany(Rental::class, 'project_id'); }
}
