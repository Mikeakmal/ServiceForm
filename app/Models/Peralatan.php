<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;
    protected $table = 'tbl_peralatanrusak';
    protected $primaryKey ='id_peralatan';

    protected $fillable = [
        'id_peralatan',
        'merek',
        'No_inventaris_peralatan',
        'nama_karyawan',
        'alat_rusak',
        'tanggal_diperbaiki',
        'nama_teknisi',
        'kondisi',
    ];

    public function barang()
    {
        return $this-> hasOne(Barang::class, 'id_barang');
    }

}
