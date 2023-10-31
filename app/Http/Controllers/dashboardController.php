<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Peralatan;
use App\Models\Barang;



class dashboardController extends Controller
{
    public function index()
    {   
        $data = [
            'user' => Auth::user(), 
        ];

        // $dashboard = '';
        // return view('frontend.dashboard', compact('dashboard')
             
        // );

        $dataRusak = Peralatan::join('tbl_barang', 'tbl_peralatanrusak.id_barang', '=', 'tbl_barang.id_barang')
        ->where('tbl_barang.kondisi', 'RUSAK')
        ->select('tbl_peralatanrusak.*')
        ->get();
        

    $databarang = Barang::pluck('No_inventaris_peralatan', 'id_barang');
    $kondisibarang = Barang::pluck('kondisi', 'id_barang');
    $kendaraanOnprogress = Kendaraan::whereNull('tanggal_selesai')->get();
    
    return view('frontend.dashboard', [
        'noinventaris' => $databarang,
        'kondisibarang' => $kondisibarang,
        'dataRusak' => $dataRusak,
        'kendaraanOnprogress' => $kendaraanOnprogress,
    ]);
    }
}
