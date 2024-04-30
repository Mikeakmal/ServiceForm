<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class KendaraanOnProgressController extends Controller
{
    public function index()
    {
        $data = [
            'user' => Auth::user(), 
        ];

        $kendaraanOnProgress = Kendaraan::whereNull('tanggal_selesai')->paginate(10);

        return view('/backend/kendaraan/kendaraanOnProgress',  [
            'kendaraan' => $kendaraanOnProgress, 
        ]);

    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $kendaraan = Kendaraan::
            where('no_polisi', 'like', "%$search%")
            ->get();

        if ($kendaraan->count() === 0) {
            $kendaraan = Kendaraan::all();
            return view('/backend/kendaraan/kendaraanOnProgress', compact('kendaraan'));

        } else {
            return view('/backend/kendaraan/kendaraanOnProgress', compact('kendaraan'));
        }
    }  

    public function update(Request $request)
    {
        $kendaraan = Kendaraan::find($request->pk);
        
        if ($kendaraan) {
            $kendaraan->{$request->name} = $request->value;
            $kendaraan->save();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }




    // /**
    //  * Update data using custom method.
    //  *
    //  * @param Request $request
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function update(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'id_kendaraan' => 'required|exists:tbl_kendaraan,id_kendaraan',
    //         'no_polisi' => 'required',
    //         'tanggal_masuk_bengkel' => 'required',
    //         'tanggal_selesai' => 'required',
    //         // Tambahkan validasi sesuai dengan kebutuhan Anda
    //     ]);

    //     if ($validator->fails()) {
    //         throw ValidationException::withMessages($validator->errors()->toArray());
    //     }

    //     // Update data berdasarkan ID
    //     $kendaraan = Kendaraan::find($request->input('id_kendaraan'));
    //     $kendaraan->no_polisi = $request->input('no_polisi');
    //     $kendaraan->tanggal_masuk_bengkel = $request->input('tanggal_masuk_bengkel');
    //     $kendaraan->tanggal_selesai = $request->input('tanggal_selesai');
    //     // Update kolom lain sesuai kebutuhan

    //     $kendaraan->save();

    //     return response()->json(['message' => 'Data berhasil diperbarui']);
    // }
}
