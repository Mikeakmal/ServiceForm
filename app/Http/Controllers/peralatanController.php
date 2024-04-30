<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Peralatan;
use App\Models\Barang;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;


class peralatanController extends Controller
{
    public function index(Request $request)
    {   
        $data = [
            'user' => Auth::user(), 
        ];

        $dataRusak = Peralatan::join('tbl_barang', 'tbl_peralatanrusak.id_barang', '=', 'tbl_barang.id_barang')
            ->where('tbl_barang.kondisi', 'RUSAK')
            ->select('tbl_peralatanrusak.*')
            ->get();
         
        // MENGATUR PILIHAN PADA COMBOBOX
        $pg = Peralatan::all();
        $peralatan = Peralatan::paginate(10);

        $barang = Barang::where('kondisi', 'RUSAK')
            ->whereNotIn('id_barang', function ($query) {
                $query->select('id_barang')
                    ->from('tbl_peralatanrusak');
            })
            ->get();
            
        $databarang = Barang::pluck('No_inventaris_peralatan', 'id_barang');
        $kondisibarang = Barang::pluck('kondisi', 'id_barang');

        return view('backend.peralatan.peralatan', [
            'pg'=>$pg,
            'peralatan' => $peralatan,
            'inventarisNo' => $barang,
            'noinventaris' => $databarang,
            'kondisibarang' => $kondisibarang,
            'dataRusak' => $dataRusak,
        ]);
    }

    // public function store(Request $request)
    // {
    //     $selectedInventaris = $request->inventaris;

    //     // Cek nomor inventaris 
    //     if ($selectedInventaris === 'id_barang') {
    //         return redirect()->back()->with('error', 'Silakan pilih nomor inventaris');
    //     } else {
           
    //         Peralatan::insert([
    //             'id_barang' => $request-> inventaris,
    //             'merek' => $request->merek,
    //             'nama_karyawan' => $request->karyawan,
    //             'alat_rusak' => $request->alat,
    //             'tanggal_diperbaiki' => $request->tgldiperbaiki,
    //             'nama_teknisi' => $request->teknisi,
    //         ]);

    //         // Catat aktivitas menggunakan Activity Log
    //         activity()->causedBy(auth()->user())->log('Create');

    //         return redirect()->back()->with('success', 'Data peralatan berhasil disimpan.');
    //     }

    // }
    public function store(Request $request)
    {
        $selectedInventaris = $request->inventaris;

        // Cek nomor inventaris 
        if ($selectedInventaris === 'id_barang') {
            return redirect()->back()->with('error', 'Silakan pilih nomor inventaris');
        } else {
            $peralatan = Peralatan::create([
                'id_barang' => $request->inventaris,
                'merek' => $request->merek,
                'nama_karyawan' => $request->karyawan,
                'alat_rusak' => $request->alat,
                'tanggal_diperbaiki' => $request->tgldiperbaiki,
                'nama_teknisi' => $request->teknisi,
            ]);
    
            // Catat aktivitas menggunakan Activity Log
            activity()
                ->causedBy(auth()->user())
                ->performedOn($peralatan)
                ->withProperties(['id_barang' => $peralatan->id_barang, 'merek' => $peralatan->merek]) // Properti yang ingin Anda sertakan
                ->log('Peralatan dengan ID ' . $peralatan->id_barang . ' ditambahkan'); // Deskripsi aktivitas
    
            return redirect()->back()->with('success', 'Data peralatan berhasil disimpan.');
        }
    }


    // public function create()
    // {
    //     $peralatan = '';
    //     $inventarisNo = Barang::all();
    //     return view('backend.peralatan.peralatan', compact('peralatan','inventarisNo')          
    //     );
    // }

    public function edit($id_tbl)
    {   
        // Dekripsi ID
        $id = Crypt::decrypt($id_tbl);

        // mengambil data inventaris peralatan berdasarkan ID
        $barang = Barang::where('id_barang', $id)->first();
        $peralatan = Peralatan::all();
        return view('/backend/peralatan/peralatan', compact('peralatan','barang', 'logErrors'));
    }

    public function update(Request $request)
    {
        Barang::where('id_barang', $request->id_barang)->update([
            'kondisi' => $request->val_kondisi
        ]);

        // Temukan peralatan berdasarkan ID 
        $peralatan = Peralatan::findOrFail($request->id_peralatan);

        //Simpan old data sebelum melakukan update
        $oldData = $peralatan->toArray();

        Peralatan::where('id_peralatan', $request->id_peralatan)->update([
            'merek' => $request->val_merek,
            'nama_karyawan' => $request->val_karyawan,
            'alat_rusak' => $request->val_alatrusak,
            'tanggal_diperbaiki' => $request->val_tgldiperbaiki,
            'nama_teknisi' => $request->val_teknisi,
          ]);

        // Temukan kembali peralatan setelah melakukan update
        $peralatan = Peralatan::findOrFail($request->id_peralatan);

        // Simpan new data setelah melakukan update
         $newData = $peralatan->getAttributes();

        activity()
            ->causedBy(auth()->user()) 
            ->performedOn($peralatan) 
            ->withProperties(['old_data' => $oldData, 'new_data' => $newData])
            ->log('update'); 

        return redirect()->back();
    }
    
    public function delete($id_peralatan)
    {

        // Temukan peralatan yang akan dihapus
        $peralatan = Peralatan::findOrFail($id_peralatan);

        // Simpan data sebelum penghapusan
        $oldData = $peralatan->toArray();

        Peralatan::where('id_peralatan', $id_peralatan)->delete();

        activity()
            ->causedBy(auth()->user()) 
            ->performedOn($peralatan) 
            ->withProperties(['deleted_data' => $oldData]) 
            ->log('delete'); 

        return redirect()->back();

    }
   
    public function search(Request $request)
    {
        $search = $request->input('search');

        $peralatan = Peralatan::where(function ($query) use ($search) {
                $query->where('merek', 'like', "%$search%")
                    ->orWhere('nama_karyawan', 'like', "%$search%")
                    ->orWhere('alat_rusak', 'like', "%$search%")
                    ->orWhere('tanggal_diperbaiki', 'like', "%$search%")
                    ->orWhere('nama_teknisi', 'like', "%$search%");
            })
            ->get();

        $dataRusak = Peralatan::where('tbl_barang.kondisi', 'RUSAK')
            ->where(function ($query) use ($search) {
                $query->where('merek', 'like', "%$search%")
                    ->orWhere('nama_karyawan', 'like', "%$search%")
                    ->orWhere('alat_rusak', 'like', "%$search%")
                    ->orWhere('tanggal_diperbaiki', 'like', "%$search%")
                    ->orWhere('nama_teknisi', 'like', "%$search%");
            })
            ->join('tbl_barang', 'tbl_peralatanrusak.id_barang', '=', 'tbl_barang.id_barang')
            ->select('tbl_peralatanrusak.*')
            ->get();

        if ($dataRusak->isEmpty()) {
            return redirect()->back();
        }

        $inventarisNo = Barang::all();
        $noinventaris = Barang::pluck('No_inventaris_peralatan', 'id_barang');
        $kondisibarang = Barang::pluck('kondisi', 'id_barang');

        return view('/backend/peralatan/peralatan', compact('peralatan', 'inventarisNo', 'noinventaris', 'kondisibarang', 'dataRusak'));
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
        $dari_tanggal = $request->input('dari_tanggal');
        $sampai_tanggal = $request->input('sampai_tanggal');
    
        // Periksa format tanggal
        if (!strtotime($dari_tanggal) || !strtotime($sampai_tanggal)) {
            'Periksa kembali tanggal yang Anda masukkan.';
        }
    
        // Lanjutkan dengan query database
        $cetakPertanggal = Peralatan::whereDate('tanggal_diperbaiki', '>=', $dari_tanggal)
            ->whereDate('tanggal_diperbaiki', '<=', $sampai_tanggal)
            ->get();
    
        // mengambil data yang sesuai dengan rentang tanggal yang dipilih.
        $databarang = Barang::pluck('No_inventaris_peralatan', 'id_barang');
        $kondisibarang = Barang::pluck('kondisi', 'id_barang');
    
        $pdf = PDF::loadView('/backend/peralatan/pdf_cetakpertanggal', [
            'tbl_peralatan' => $cetakPertanggal, 
            'noinventaris' => $databarang,
            'kondisi' => $kondisibarang,
        ]);
    
        return $pdf->download('Data-Service-pertanggal.pdf');
    }

    public function searchInventaris(Request $request)
    {
        $query = $request->input('q');

        $results = Barang::where('No_inventaris_peralatan', 'like', '%' . $query . '%')
            ->get(['id_barang', 'No_inventaris_peralatan']);

        return response()->json($results);
    }

}
