<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Pengerjaan;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PengerjaanController extends Controller
{
    public function index()
    {  
        $data = [
            'user' => Auth::user(), 
        ];
        
        $pengerjaan = Pengerjaan::all();
        $kendaraaan = Kendaraan::all();
        $datakendaraan = Kendaraan::pluck('no_polisi', 'id_kendaraan');

        return view('/backend/kendaraan/pengerjaan', [
            'pengerjaan' =>  $pengerjaan,
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
    
    public function search(Request $request)
    {
        $search = $request->input('search');
        $pengerjaan = Pengerjaan::
            where('nama_mekanik', 'like', "%$search%")
            ->orWhere('sparepart', 'like', "%$search%")
            ->get();
    
        $nomorpolis = Kendaraan::all();
        $nopolis = Kendaraan::pluck('no_polisi', 'id_kendaraan');
    
        if ($pengerjaan->count() === 0) {
            $pengerjaan = Pengerjaan::all();
        }
    
        return view('/backend/kendaraan/pengerjaan', compact('pengerjaan', 'nomorpolis', 'nopolis'));
    }
    
    // public function store(Request $request)
    // {
    //     Pengerjaan::insert([
    //         'id_kendaraan' => $request -> kendaraan,
    //         'nama_mekanik' => $request -> mekanik,
    //         'tanggal_dikerjakan' => $request -> tglkerja,
    //         'sparepart' => $request -> sparepart,
    //         'keterangan_pengerjaan' => $request -> keterangan
    //     ]);
    //     return redirect()->back();
    // }

    public function store(Request $request)
    {
        // Validasi request 
        $request->validate([
            'nopol' => 'required', 
            'mekanik' =>'required',
            'tglkerja' => 'required',
            'sparepart' => 'required',
            'keterangan' => 'required',
        ]);
    
        $selectedNopol = $request->nopol;
    
        // Cek apakah nomor polisi sudah dipilih
        if ($selectedNopol == 'no_polisi') {
            return redirect()->back()->withErrors(['Silakan pilih nomor Polisi terlebih dahulu.'])->withInput();
        } else {

            // Simpan data ke dalam tbl_pengerjaan
            Pengerjaan::insert([
                'id_kendaraan' => $request->nopol,
                'nama_mekanik' => $request->mekanik,
                'tanggal_dikerjakan' => $request->tglkerja,
                'sparepart' => $request->sparepart,
                'keterangan_pengerjaan' => $request->keterangan
            ]);
    
            return redirect()->back()->with('success', 'Data pengerjaan berhasil disimpan.');
        }
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

    public function print(Request $request)
    {
        $pengerjaan = Pengerjaan::all();
        $datakendaraan = Kendaraan::pluck('no_polisi', 'id_kendaraan');

        $pdf = PDF::loadView('/backend/kendaraan/pdf_pengerjaan', [
            'tbl_pengerjaan' =>  $pengerjaan,
            'nopolis' => $datakendaraan
        ]);

        return $pdf->download('Daftar Pengerjaan.pdf');
    }


}
