<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;
    protected $table = 'tbl_peralatan';
    protected $primaryKey ='id_peralatan';

    protected $fillable = [
        'id_peralatan',
        'merek',
        'No_inventaris_peralatan',
        'nama_karyawan',
        'alat_rusak',
        'tanggal_digunakan',
        'nama_teknisi'
    ];

    public function barang()
    {
        return $this-> hasOne(Barang::class, 'id_barang');
    }

}
