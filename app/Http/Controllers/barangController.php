<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
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

    public function update(Request $request)
    {
        Barang::where('id_barang', $request-> id_barang)-> update([

            'nama_barang' => $request -> val_barang,
            'No_inventaris_peralatan' => $request -> val_inventaris,
            'lokasi_barang' => $request -> val_lokasi,
        ]);
        return redirect()->back();
    }

    public function print(Request $request)
    {
        $barang = Barang::all();
        $pdf = PDF::loadView('/backend/barang/pdf_barang', [
            'tbl_barang' => $barang, 
        ]);

        return $pdf->download('Data Barang.pdf');
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
