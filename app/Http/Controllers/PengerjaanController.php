<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Pengerjaan;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class PengerjaanController extends Controller
{
    public function index()
    {  
        $pengerjaan = Pengerjaan::all();
        $kendaraaan = Kendaraan::all();
        $datakendaraan = Kendaraan::pluck('no_polisi', 'id_kendaraan');

        return view('/backend/kendaraan/pengerjaan', [
            'tbl_pengerjaan' =>  $pengerjaan,
            'nomorpolis' => $kendaraaan,
            'nopolis' => $datakendaraan
        ]);
    }
    
    public function create()
    {
        $pengerjaan = '';
        $nomorpolis = Kendaraan::all();
        return view('backend.kendaraan.pengerjaan', compact('pengerjaan','nomorpolis')          
        );
    }

    public function store(Request $request)
    {
        Pengerjaan::insert([
            'id_kendaraan' => $request -> kendaraan,
            'nama_mekanik' => $request -> mekanik,
            'tanggal_dikerjakan' => $request -> tglkerja,
            'sparepart' => $request -> sparepart,
            'keterangan_pengerjaan' => $request -> keterangan
        ]);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        Pengerjaan::where('id_pengerjaan', $request->id_pengerjaan)->update([
            'nama_mekanik' => $request->val_mekanik,
            'tanggal_dikerjakan' => $request->val_dikerjakan,
            'sparepart' => $request->val_sparepart,
            'keterangan_pengerjaan' => $request->val_keterangan,
        ]);
        return redirect()->back();
    }

    public function delete($id_pengerjaan)
    {
        Pengerjaan::where('id_pengerjaan', $id_pengerjaan)->delete();
        return redirect('/pengerjaan');
    }

    public function edit($id_tbl)
    {
        // Dekripsi ID
        $id = Crypt::decrypt($id_tbl);

        // mengambil data asset berdasarkan ID
        $kendaraan = Kendaraan::where('id_kendaraan', $id)->first();
        $logErrors = '';
        $pengerjaan = Pengerjaan::all();
        return view('/backend/kendaraan/pengerjaan', compact('pengerjaan','kendaraan', 'logErrors'));
    }

   
}