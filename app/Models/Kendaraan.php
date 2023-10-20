<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    protected $table = 'tbl_kendaraan';
    protected $primaryKey ='id_kendaraan';

    protected $fillable = [
        'id_kendaraan',
        'no_polisi',
        'tanggal_masuk_bengkel',
        'tanggal_selesai',
    ];

    public function pengerjaan()
    {
        return $this->hasMany(Pengerjaan::class, 'id_kendaraan', 'id_kendaraan');
    }

}
