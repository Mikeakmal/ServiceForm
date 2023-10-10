<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class barangController extends Controller
{
    public function index()
    {   
        $kendaraan = DB::table('tbl_barang')->get();
        return view('/backend/barang/barang', [
            'tbl_kendaraan' => $kendaraan, 
        ]);
    }

    public function create()
    {
        $barang = '';
        return view('backend.barang.barang', compact('barang')          
        );
    }

    public function store(Request $request)
    {
        Barang::insert([
            'nama_barang'=> $request->barang,
            'no_inventaris_peralatan' => $request->inventaris,
            'lokasi_barang' => $request-> lokasi,
        ]);
        return redirect()->back();
    }

    public function delete($id_barang)
    {
        Barang::where('id_barang', $id_barang)->delete();
        return redirect()->back();
    }

    public function edit($id_barang)
    {   
        $id = Crypt::decrypt($id_barang);
        
        Barang::where('id_barang', $id)->first();
        return view('/backend/barang/barang', compact('barang'));
    }

}
