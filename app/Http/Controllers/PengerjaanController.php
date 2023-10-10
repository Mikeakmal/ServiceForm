<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Pengerjaan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class PengerjaanController extends Controller
{
    public function index()
    {   
        $pengerjaan = DB::table('tbl_pengerjaan')->get();
        return view('/backend/kendaraan/form_pengerjaan', [
            'tbl_pengerjaan' => $pengerjaan, 
        ]);
    }

    public function store(Request $request)
    {
        Pengerjaan::insert([
            'id_kendaraan' => $request -> id_kendaraan,
            'mekanik' => $request -> mekanik,
            'tanggal_dikerjakan' => $request -> tglkerja,
            'sparepart' => $request -> sparepart,
            'keterangan_pengerjaan' => $request -> keterangan_pengerjaan
        ]);
        return redirect()->back();
    }

    public function edit($id_pengerjaan)
    {   
        // $id = Crypt::decrypt($id_pengerjaan);
        // Pengerjaan::where('id_pengerjaan', $id)->first();
        // return view('/backend/kendaraan/detail_kendaraan', compact('Kendaraan'));
    }


    public function update()
    {
        $pengerjaan = '';
        return view('backend.kendaraan.detail_kendaraan', compact('pengerjaan')       
        );
    }
 

    public function delete($id_pengerjaan)
    {
        Pengerjaan::where('id_pengerjaan', $id_pengerjaan)->delete();
        return redirect()->back();
    }
}
