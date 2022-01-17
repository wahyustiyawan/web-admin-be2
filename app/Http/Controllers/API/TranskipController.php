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
        //Nilai dan semester where user tersebut || Output Nilai Akhir per semester
        $transkip = EnrollMataKuliah::select('semester',DB::raw('SUM(nilai_akhir) as nilai'))->groupBy('semester')->where('user_id', $id)->get();

        
        //SKS di Tabel Mata Kuliah, kalau bisa ditambah langsung/Deteksi Persemester
        

        // Ngambil jumlah sks yang diambil mahasiswa tersebut disemester itu
        //Total SKS Mahasiswa Dalam Semester Itu
        $sks = EnrollMataKuliah::select('mata_kuliah.sks','enroll_mata_kuliah.semester','enroll_mata_kuliah.nilai_akhir', )->join('mata_kuliah','mata_kuliah.id','=','enroll_mata_kuliah.mata_kuliah_id')->where('user_id',$id)->get();
        
        $nilaiawal = 0;
        $i = 0;
        foreach($sks as $item){          

            if($item->semester == $i){
                $totalsks = $sks->where('semester',$item->semester)->SUM('sks');
                $dataenroll = $sks->where('semester',$item->semester);
                $nilai1 = $dataenroll->sks*$dataenroll->nilai_akhir;
                $nilaiawal = $nilaiawal + $nilai1;

                $data[] = [
                    'semester' => $item->semester,
                    'totalnilai'=>$nilaiawal,
                    'totalsks' => $totalsks,
                ];          
                
            
            }
            $i++;
        }

        dd($totalsks);

        return response()->json([
            "error" => false,
            "message" => "Success",
            "data" => $transkip
        ], 200);
    }
}
