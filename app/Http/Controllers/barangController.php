<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use PDF;

class barangController extends Controller
{
    public function index()
    {   
        $data = [
            'user' => Auth::user(), 
        ];

        $barang = DB::table('tbl_barang')->get();
        
        return view('/backend/barang/barang', [
            'barang' => $barang, 
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
            'No_inventaris_peralatan' => $request->inventaris,
            'lokasi_barang' => $request-> lokasi,
            'kondisi' => $request -> kondisi,
            'tanggal_pengambilan' => $request -> tglpengambilan,
        ]);
        return redirect()->back();
    }

    public function delete($id_barang)
    {
        try {
            $barang = Barang::find($id_barang);
    
            if (!$barang) {
                return redirect()->back()->with('error', 'Data barang tidak ditemukan.');
            }
            // Periksa apakah ada relasi terkait sebelum menghapus
            if ($barang->peralatan()->count() > 0) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus data barang ini karena masih terkait dengan data lain.');
            }
            $barang->delete();
            return redirect()->back()->with('success', 'Data barang berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data barang. Pastikan data ini tidak terkait dengan data lain.');
        }
    }
    

    public function edit($id_barang)
    {   
        $id = Crypt::decrypt($id_barang);
        
        Barang::where('id_barang', $id)->first();
        return view('/backend/barang/barang', compact('barang'));
    }

    public function update(Request $request)
    {
        Barang::where('id_barang', $request-> id_barang)-> update([

            'nama_barang' => $request -> val_barang,
            'No_inventaris_peralatan' => $request -> val_inventaris,
            'lokasi_barang' => $request -> val_lokasi,
            'kondisi' => $request -> val_kondisi,
            'tanggal_pengambilan' => $request -> val_tglpengambilan,
        ]);
        return redirect()->back();
    }

    public function print(Request $request)
    {
        $barang = Barang::all();
        $pdf = PDF::loadView('/backend/barang/pdf_barang', [
            'tbl_barang' => $barang, 
        ]);

        return $pdf->download('Daftar Peralatan Inventaris.pdf');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $barang = Barang::
            where('nama_barang', 'like', "%$search%")
            ->orWhere('No_inventaris_peralatan', 'like', "%$search%")
            ->get();

        if ($barang->count() === 0) {
            $barang = Barang::all();
            return view('/backend/barang/barang', compact('barang'));
        } else {
            return view('/backend/barang/barang', compact('barang'));
        }
    }
}
