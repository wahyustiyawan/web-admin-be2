<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Administration;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function store(Request $request)
    {
        if (isset($request->pakta_integritas)) {
            $extention = $request->pakta_integritas->extension();
            $file_pakta_integritas = time() . '.' . $extention;
            $pakta_integritas = 'storage/pakta_integritas/'. $file_pakta_integritas;
            $request->pakta_integritas->storeAs('public/pakta_integritas', $file_pakta_integritas);
        } else {
            $file_pakta_integritas = null;
        }

        if (isset($request->scan_ktp)) {
            $extention = $request->scan_ktp->extension();
            $file_scan_ktp = time() . '.' . $extention;
            $scan_ktp = 'storage/scan_ktp/'. $file_scan_ktp;
            $request->scan_ktp->storeAs('public/scan_ktp', $file_scan_ktp);
        } else {
            $file_scan_ktp = null;
        }

        if (isset($request->scan_kk)) {
            $extention = $request->scan_kk->extension();
            $file_scan_kk = time() . '.' . $extention;
            $scan_kk = 'storage/scan_kk/'. $file_scan_kk;
            $request->scan_kk->storeAs('public/scan_kk', $file_scan_kk);
        } else {
            $file_scan_kk = null;
        }

        if (isset($request->scan_ijazah)) {
            $extention = $request->scan_ijazah->extension();
            $file_scan_ijazah = time() . '.' . $extention;
            $scan_ijazah = 'storage/scan_ijazah/'. $file_scan_ijazah;
            $request->scan_ijazah->storeAs('public/scan_ijazah', $file_scan_ijazah);
        } else {
            $file_scan_ijazah = null;
        }

        if (isset($request->pas_foto)) {
            $extention = $request->pas_foto->extension();
            $file_pas_foto = time() . '.' . $extention;
            $pas_foto = 'storage/pas_foto/'. $file_pas_foto;
            $request->pas_foto->storeAs('public/pas_foto', $file_pas_foto);
        } else {
            $file_pas_foto = null;
        }

        if (isset($request->transkip)) {
            $extention = $request->transkip->extension();
            $file_transkip = time() . '.' . $extention;
            $transkip = 'storage/transkip/'. $file_transkip;
            $request->transkip->storeAs('public/transkip', $file_transkip);
        } else {
            $file_transkip = null;
        }

        if (isset($request->surat_rekomendasi)) {
            $extention = $request->surat_rekomendasi->extension();
            $file_surat_rekomendasi = time() . '.' . $extention;
            $surat_rekomendasi = 'storage/surat_rekomendasi/'. $file_surat_rekomendasi;
            $request->surat_rekomendasi->storeAs('public/surat_rekomendasi', $file_surat_rekomendasi);
        } else {
            $file_surat_rekomendasi = null;
        }

        $data = Administration::create([
            'nama_lengkap'=> $request->nama_lengkap,
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
            'kebutuhan_khusus' =>$request->kebutuhan_khusus,
            'tinggal'=> $request->tinggal,
            'pembiaya'=> $request->pembiaya,
            'nama_ayah'=> $request->nama_ayah,
            'nama_ibu'=> $request->nama_ibu,
            'kerja_ayah'=> $request->kerja_ayah,
            'kerja_ibu'=> $request->kerja_ibu,
            'pekerjaan'=> $request->pekerjaan,
            'penghasilan'=> $request->penghasilan,
            'penghasilan_ayah'=> $request->penghasilan_ayah,
            'penghasilan_ibu'=> $request->penghasilan_ibu,
            'pakta_integritas'=> $pakta_integritas,
            'scan_ktp'=> $scan_ktp,
            'scan_kk'=> $scan_kk,
            'scan_ijazah'=> $scan_ijazah,
            'pas_foto'=> $pas_foto,
            'transkip'=> $transkip,
            'surat_rekomendasi'=> $surat_rekomendasi,
            'program'=> $request->program,
        ]);

        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $data
        ]);
    }
}