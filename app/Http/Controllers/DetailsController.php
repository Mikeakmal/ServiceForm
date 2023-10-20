<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Kendaraan;
use App\Models\Pengerjaan;
use PDF;

class DetailsController extends Controller
{
    // public function index()
    // {
    //     $kendaraan = Kendaraan::with('pengerjaan')->get();

    //     return view('backend.kendaraan.pdf_details', [
    //     'kendaraan' => $kendaraan,
    // ]);

    // }
     
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
        $pengerjaan = Pengerjaan::
            where('nama_mekanik', 'like', "%$search%")
            ->orWhere('sparepart', 'like', "%$search%")
            ->get();

        if ($pengerjaan->count() === 0) {
            $pengerjaan = Pengerjaan::all();
            return view('/backend/kendaraan/detail_kendaraan', compact('pengerjaan'));

        } else {
            return view('/backend/kendaraan/detail_kendaraan', compact('pengerjaan'));
        }
    }
    
}
