<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengerjaan extends Model
{
    use HasFactory;
    protected $table = 'tbl_pengerjaan';
    protected $primaryKey ='id_pengerjaan';


    protected $fillable = [
        'id_pengerjaan',
        'id_kendaraan',
        'nama_mekanik',
        'tanggal_dikerjakan',
        'sparepart',
        'keterangan_pengerjaan'
    ];
}
