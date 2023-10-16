<?php
use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;

use App\Models\Peralatan;
use App\Models\Barang;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class peralatanController extends Controller
{
    public function index()
    {   
        $peralatan = Peralatan::all();
        $barang = Barang::all();
        $databarang = Barang::pluck('No_inventaris_peralatan', 'id_barang');


        return view('/backend/peralatan/peralatan', [
            'tbl_peralatan' => $peralatan,
            'inventaris' => $barang,
            'noinventaris' => $databarang
        ]);
    }

    public function store(Request $request)
    {
        Peralatan::insert([
            'merek' => $request-> merek,
            'nama_karyawan' => $request-> karyawan,
            'alat_rusak'=> $request-> alat,
            'tanggal_digunakan'=> $request-> tgldigunakan,
            'nama_teknisi' => $request-> teknisi,
            'id_barang' => $request-> inventaris
    
        ]);
        return redirect()->back();
    }

    public function edit($id_peralatan)
    {   
        $id = Crypt::decrypt($id_peralatan);
        
        Peralatan::where('id_peralatan', $id)->first();
        return view('/backend/peralatan/peralatan', compact('peralatan'));
    }
    
    public function delete($id_peralatan)
    {
        Peralatan::where('id_peralatan', $id_peralatan)->delete();
        return redirect()->back();
    }


    
}
