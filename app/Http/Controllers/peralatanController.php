<?php
use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;

use App\Models\Peralatan;
use App\Models\Barang;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class peralatanController extends Controller
{
    public function index()
    {   
        $data = [
            'user' => Auth::user(), 
        ];

        $dataRusak = Peralatan::join('tbl_barang', 'tbl_peralatanrusak.id_barang', '=', 'tbl_barang.id_barang')
            ->where('tbl_barang.kondisi', 'RUSAK')
            ->select('tbl_peralatanrusak.*')
            ->get();
            
        // MENGATUR PILIHAN PADA COMBOBOX
        $peralatan = Peralatan::all();
        $barang = Barang::where('kondisi','RUSAK')->orWhere('No_inventaris_peralatan')
            ->whereNotIn('id_barang', function ($query) {
                $query->select('id_barang')
                    ->from('tbl_kendaraan');
            })
            ->get();
            
        $databarang = Barang::pluck('No_inventaris_peralatan', 'id_barang');
        $kondisibarang = Barang::pluck('kondisi', 'id_barang');

        return view('backend.peralatan.peralatan', [
            'peralatan' => $peralatan,
            'inventarisNo' => $barang,
            'noinventaris' => $databarang,
            'kondisibarang' => $kondisibarang,
            'dataRusak' => $dataRusak,
        ]);
    }

    public function store(Request $request)
    {
        Peralatan::insert([
            'id_barang' => $request-> inventaris,
            'merek' => $request-> merek,
            'nama_karyawan' => $request-> karyawan,
            'alat_rusak'=> $request-> alat,
            'tanggal_diperbaiki'=> $request-> tgldiperbaiki,
            'nama_teknisi' => $request-> teknisi,
        ]);
        return redirect()->back();
    }

    public function create()
    {
        $peralatan = '';
        $inventarisNo = Barang::all();
        return view('backend.peralatan.peralatan', compact('peralatan','inventarisNo')          
        );
    }

    public function edit($id_tbl)
    {   
        // Dekripsi ID
        $id = Crypt::decrypt($id_tbl);

        // mengambil data inventaris peralatan berdasarkan ID
        $barang = Barang::where('id_barang', $id)->first();
        $logErrors = '';
        $peralatan = Peralatan::all();
        return view('/backend/peralatan/peralatan', compact('peralatan','barang', 'logErrors'));
    }

    public function update(Request $request)
    {
        Barang::where('id_barang', $request->id_barang)->update([
            'kondisi' => $request->val_kondisi
        ]);
        Peralatan::where('id_peralatan', $request->id_peralatan)->update([
            'merek' => $request->val_merek,
            'nama_karyawan' => $request->val_karyawan,
            'alat_rusak' => $request->val_alatrusak,
            'tanggal_diperbaiki' => $request->val_tgldiperbaiki,
            'nama_teknisi' => $request->val_teknisi,
          ]);
        return redirect()->back();
    }
    
    public function delete($id_peralatan)
    {
        Peralatan::where('id_peralatan', $id_peralatan)->delete();
        return redirect()->back();
    }
   
    public function search(Request $request)
    {
        $search = $request->input('search');
        $peralatan = Peralatan::
            where('merek', 'like', "%$search%")
            ->orWhere('alat_rusak', 'like', "%$search%")
            ->get();
    
        $inventarisNo = Barang::all();
        $noinventaris = Barang::pluck('No_inventaris_peralatan', 'id_barang');
    
        if ($peralatan->count() === 0) {
            $peralatan = Peralatan::all();
        }
    
        return view('/backend/peralatan/peralatan', compact('peralatan', 'inventarisNo', 'noinventaris'));
    }


    public function print(Request $request)
    {
        $peralatan = Peralatan::all();
        $databarang = Barang::pluck('No_inventaris_peralatan', 'id_barang');

        $pdf = PDF::loadView('/backend/peralatan/pdf', [
            'tbl_peralatanrusak' => $peralatan, 
            'noinventaris' => $databarang,
        ]);

        return $pdf->download('Daftar Peralatan Rusak.pdf');
    }

    public function cetakPertanggal(Request $request)
    {
        $dari_tanggal = $request->dari_tanggal;
        $sampai_tanggal = $request->sampai_tanggal;

        $cetakPertanggal = Peralatan::whereDate('tanggal_diperbaiki', '>=', $dari_tanggal)
            ->whereDate('tanggal_diperbaiki', '<=', $sampai_tanggal)
            ->get();

        // Sekarang, Anda hanya mengambil data yang sesuai dengan rentang tanggal yang dipilih.

        $databarang = Barang::pluck('No_inventaris_peralatan', 'id_barang');
        $kondisibarang = Barang::pluck('kondisi', 'id_barang');

        $pdf = PDF::loadView('/backend/peralatan/pdf_cetakpertanggal', [
            'tbl_peralatan' => $cetakPertanggal, // Menggunakan data yang sesuai dengan tanggal
            'noinventaris' => $databarang,
            'kondisi' => $kondisibarang,
        ]);

        return $pdf->stream('Data-Service-pertanggal.pdf');
    }

}
