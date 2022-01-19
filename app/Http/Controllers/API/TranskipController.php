<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\EnrollMataKuliah;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TranskipController extends Controller
{
    public function index($id)
    {
        $transkip = EnrollMataKuliah::join('mata_kuliah', 'mata_kuliah.id', '=', 'enroll_mata_kuliah.mata_kuliah_id')
            ->select('enroll_mata_kuliah.semester', DB::raw('SUM(mata_kuliah.sks) as jumlahsks'), DB::raw('SUM(enroll_mata_kuliah.nilai_akhir*mata_kuliah.sks) as nilai'))
            ->groupBy('semester')->where('enroll_mata_kuliah.user_id', $id)->get();

        foreach ($transkip as $item) {
            $data[] = [
                'SKS' => (int)$item->jumlahsks,
                // 'IPS' => (int)$item->nilai/$item->jumlahsks,
                'IPS' => (int)($item->nilai / $item->jumlahsks) / 25,
                'Semester' => $item->semester,
            ];
        }

        // dd($transkip);

        return response()->json([
            "error" => false,
            "message" => "Success",
            "data" => $data
        ], 200);
    }

    public function transkipSemester($id, $semester)
    {
        $transkipsemester = EnrollMataKuliah::select('mata_kuliah.sks', 'mata_kuliah.kode', 'mata_kuliah.judul', 'enroll_mata_kuliah.semester', 'enroll_mata_kuliah.nilai_akhir')
            ->join('mata_kuliah', 'mata_kuliah.id', '=', 'enroll_mata_kuliah.mata_kuliah_id')
            ->where('enroll_mata_kuliah.user_id', $id)
            ->where('enroll_mata_kuliah.semester', $semester)->get();

        $transkip = EnrollMataKuliah::join('mata_kuliah', 'mata_kuliah.id', '=', 'enroll_mata_kuliah.mata_kuliah_id')
            ->select('enroll_mata_kuliah.semester', DB::raw('SUM(mata_kuliah.sks) as jumlahsks'), DB::raw('SUM(enroll_mata_kuliah.nilai_akhir*mata_kuliah.sks) as nilai'))
            ->groupBy('semester')->where('enroll_mata_kuliah.user_id', $id)->get();

        $totalnilai = 0;
        foreach ($transkipsemester as $item) {
            $nilai = Helper::variabel_nilai($item->nilai_akhir);
            $var1 = $item->nilai_akhir * $item->sks;
            $totalnilai = $totalnilai + $var1;

            $data[] = [
                'kode' => $item->kode,
                'mata_kuliah' => $item->judul,
                'sks' => $item->sks,
                'nilai' => $nilai,
            ];
        }

        $IPK = 0;
        foreach ($transkip as $item) {
            $a = (int)($item->nilai / $item->jumlahsks) / 25;
            $IPK = $IPK + $a;
        }
        $totalsemester = $transkip->count('semester');
        $hasil = [
            'totalsks' => (int)$transkip->SUM('jumlahsks'),
            'IPS' => (int)($totalnilai / $transkipsemester->sum('sks')) / 25,
            'IPK' => $IPK / $totalsemester,
            'detail' => $data,
        ];
        
        return response()->json([
            "error" => false,
            "message" => "Success",
            "data" => $hasil
        ], 200);
    }
}
