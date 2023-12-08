<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Models\Pengerjaan;
use PDF;

class kendaraanController extends Controller
{
   
    public function index()
    {
        $data = [
            'user' => Auth::user(), 
        ];

        $kendaraan = DB::table('tbl_kendaraan')->get();
        
        return view('/backend/kendaraan/kendaraan', [
            'kendaraan' => $kendaraan, 
        ]);
    }
 
    public function move($id_kendaraan)
    {   
        $id = Crypt::decrypt($id_kendaraan);
        
        $kendaraan = Kendaraan::where('id_kendaraan', $id)->first();
        $pengerjaan = Pengerjaan::where('id_kendaraan', $id)->get();
        
        return view('/backend/kendaraan/detail_kendaraan', compact('kendaraan', 'pengerjaan'));
    }
    
    public function edit($id_kendaraan)
    {   
        $id = Crypt::decrypt($id_kendaraan);
        
        Kendaraan::where('id_kendaraan', $id)->first();
        return view('/backend/kendaraan/kendaraan', compact('kendaraan'));
    }
    
    public function update(Request $request)
    {
        Kendaraan::where('id_kendaraan', $request-> id_kendaraan)-> update([
            'no_polisi' => $request -> val_nopol,
            'tanggal_masuk_bengkel' => $request -> val_tglmasuk,
            'tanggal_selesai' => $request -> val_tglselesai,
        ]);
        return redirect()->back();
    }

    public function store(Request $request)
    {
        Kendaraan::insert([
            'no_polisi'=> $request->nopol,
            'tanggal_masuk_bengkel' => $request->tglmasuk,
            'tanggal_selesai' => $request-> tglselesai,
        ]);
        return redirect()->back();
    }

    public function delete($id_kendaraan)
    {
        try {
            $kendaraan = Kendaraan::find($id_kendaraan);
    
            if (!$kendaraan) {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }
            // Periksa apakah ada relasi terkait sebelum menghapus
            if ($kendaraan->pengerjaan()->count() > 0) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus data ini karena masih terkait dengan data lain.');
            }
            $kendaraan->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data. Pastikan data ini tidak terkait dengan data lain.');
        }
    }

    public function print(Request $request)
    {
        $kendaraan = Kendaraan::all();

        $pdf = PDF::loadView('/backend/kendaraan/pdf_kendaraan', [
            'tbl_kendaraan' => $kendaraan, 
        ]);

        return $pdf->download('Daftar Kendaraan.pdf');
    }

    public function cetak( $id)
    {
        $kendaraan = Kendaraan::find($id);
        // dd ($kendaraan);
        if (!$kendaraan) {
            return abort(404); 
        }
        
        $pengerjaan = $kendaraan->pengerjaan;
    
        $pdf = PDF::loadView('backend.kendaraan.pdf_details', [
            'kendaraan' => $kendaraan, 
            'pengerjaan' => $pengerjaan,
        ]);
    
        return $pdf->download('Data Pengerjaan Kendaraan.pdf');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $kendaraan = Kendaraan::
            where('no_polisi', 'like', "%$search%")
            ->orWhere('tanggal_masuk_bengkel', 'like', "%$search%")
            ->get();

        if ($kendaraan->count() === 0) {
            $kendaraan = Kendaraan::all();
            return view('/backend/kendaraan/kendaraan', compact('kendaraan'));

        } else {
            return view('/backend/kendaraan/kendaraan', compact('kendaraan'));
        }
    }  
    
    public function search2(Request $request)
    {
        $search = $request->input('search2');
        $pengerjaan = Pengerjaan::where('nama_mekanik', 'like', "%$search%")
        ->orWhere('sparepart', 'like', "%$search%")
        ->get();
        
        if ($pengerjaan->count() === 0) {
            $pengerjaan = Pengerjaan::all();
        }
        
        $kendaraan = Kendaraan::all();
        $idPerngerjaan = $pengerjaan->pluck('id_kendaraan');
        $kendaraan = Kendaraan::where('id_kendaraan', $idPerngerjaan)->first();

        if (!$kendaraan) {
            return abort(404);
        }
        return view('/backend/kendaraan/detail_kendaraan', compact('pengerjaan', 'kendaraan'));
    }
}
