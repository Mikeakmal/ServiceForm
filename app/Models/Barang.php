<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'tbl_barang';
    protected $primaryKey ='id_barang';

    protected $fillable = [
        'id_barang',
        'nama_barang',
        'no_inventaris_peralatan',
        'lokasi_barang',
    ];


}
