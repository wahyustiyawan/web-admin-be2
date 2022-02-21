<?php

namespace App\Http\Controllers\API;

use App\Models\Nilai;
use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\NilaiQuiz;
use App\Models\UserAssignment;
use App\Models\UserExam;
use App\Models\UserQuiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NilaiController extends Controller
{

    public function gradeAssignment($id)
    {
        $user = Auth::user();
        $matkul = MataKuliah::find($id);
        $count = UserAssignment::where('user_id', $user->id)->where('mata_kuliah_id',$id)->count();
        $grade = UserAssignment::where('user_id', $user->id)->where('mata_kuliah_id',$id)->sum('grade');
        $total = $grade / $count;
        
        $data = [
            'mata_kuliah' => $matkul->judul,
            'total' => $total
        ];

        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $data
        ], 200);
    }

    public function gradeQuiz($id)
    {
        $user = Auth::user();
        $matkul = MataKuliah::find($id);
        $count = NilaiQuiz::where('user_id', $user->id)->where('mata_kuliah_id',$id)->count();
        $grade = NilaiQuiz::where('user_id', $user->id)->where('mata_kuliah_id',$id)->sum('grade');
        $total = $grade / $count;
        $data = [
            'mata_kuliah' => $matkul->judul,
            'total' => $total
        ];
        
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $data
        ], 200);
    }

    public function nilaiQuiz(Request $request)
    {
        $user = Auth::user();
        $nilai = NilaiQuiz::create([
            'user_id' => $user->id,
            'grade' => $request->grade,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'quiz_id' => $request->quiz_id,
            'isComplete' => 1
        ]);

        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $nilai
        ]);

    }

    public function gradeUts($id)
    {
        $user = Auth::user();
        $uts = UserExam::select('mata_kuliah.id','mata_kuliah.judul','user_exam.*')->join('mata_kuliah','user_exam.mata_kuliah_id','mata_kuliah.id')->where('user_id', $user->id)->where('tipe', 'uts')->where('mata_kuliah_id',$id)->get();
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $uts
        ], 200);
    }

    public function gradeUas($id)
    {
        $user = Auth::user();
        $uas = UserExam::select('mata_kuliah.id','mata_kuliah.judul','user_exam.*')->join('mata_kuliah','user_exam.mata_kuliah_id','mata_kuliah.id')->where('user_id', $user->id)->where('tipe', 'uas')->where('mata_kuliah_id',$id)->get();
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $uas
        ], 200);
    }
}
