<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;



class Peralatan extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'tbl_peralatanrusak';
    protected $primaryKey ='id_peralatan';

    protected static $logAttributes = ['merek', 'nama_karyawan', 'alat_rusak', 'tanggal_diperbaiki', 'nama_teknisi', 'id_barang'];


    protected $fillable = [
        'id_peralatan',
        'merek',
        'nama_karyawan',
        'alat_rusak',
        'tanggal_diperbaiki',
        'nama_teknisi',
        'id_barang'
    ];

    public function barang()
    {
        return $this-> hasOne(Barang::class, 'id_barang');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults() 
        -> logUnguarded()
        -> logOnlyDirty(); 
    }
}
