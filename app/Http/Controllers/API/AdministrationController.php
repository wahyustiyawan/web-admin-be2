<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Administration;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function store(Request $request)
    {

        $data = Administration::create([
            'nama_depan'=> $request->nama_depan,
            'nama_tengah'=> $request->nama_tengah,
            'nama_akhir'=> $request->nama_akhir,
            'nik'=> $request->nik,
            'email'=> $request->email,
            'prodi'=> $request->prodi,
            'tahun_ajar'=> $request->tahun_ajar,
            'semester'=> $request->semester,
            'alamat_domisili'=> $request->alamat_domisili,
            'alamat_ktp'=> $request->alamat_ktp,
            'no_hp'=> $request->no_hp,
            'tempat_lahir'=> $request->tempat_lahir,
            'tgl_lahir'=> $request->tgl_lahir,
            'kelamin'=> $request->kelamin,
            'tinggal'=> $request->tinggal,
            'pembiayaan'=> $request->pembiayaan,
            'nama_ayah'=> $request->nama_ayah,
            'nama_ibu'=> $request->nama_ibu,
            'kerja_ayah'=> $request->kerja_ayah,
            'kerja_ibu'=> $request->kerja_ibu,
            'pekerjaan'=> $request->pekerjaan,
            'penghasilan'=> $request->penghasilan,
            'pakta_integritas'=> $request->pakta_integritas,
            'scan_ktp'=> $request->scan_ktp,
            'scan_kk'=> $request->scan_kk,
            'scan_ijazah'=> $request->scan_ijazah,
            'pas_foto'=> $request->pas_foto,
            'transkip'=> $request->transkip,
            'surat_rekomendasi'=> $request->surat_rekomendasi,
        ]);

        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $data
        ]);
    }
}
