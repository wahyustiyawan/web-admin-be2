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
        //Nilai dan semester where user tersebut
        $transkip = EnrollMataKuliah::select('semester', DB::raw('SUM(nilai_akhir) as nilai'))->groupBy('semester')->where('user_id', $id)->get();

        //SKS di Tabel Mata Kuliah, kalau bisa ditambah langsung/Deteksi Persemester
        

        //Total SKS Mahasiswa Dalam Semester Itu
        $sks = MataKuliah::all();

        dd($transkip);

        return response()->json([
            "error" => false,
            "message" => "Success",
            "data" => $transkip
        ], 200);
    }
}
