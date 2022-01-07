<?php

namespace App\Http\Controllers\API;

use App\Models\Nilai;
use App\Http\Controllers\Controller;
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
        $count = UserAssignment::where('user_id', $user->id)->where('mata_kuliah_id',$id)->count();
        $grade = UserAssignment::where('user_id', $user->id)->where('mata_kuliah_id',$id)->sum('grade');
        $total = $grade / $count;
        // dd($count);

        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $total
        ], 200);
    }

    public function gradeQuiz($id)
    {
        $user = Auth::user();
        $count = NilaiQuiz::where('user_id', $user->id)->where('mata_kuliah_id',$id)->count();
        $grade = NilaiQuiz::where('user_id', $user->id)->where('mata_kuliah_id',$id)->sum('grade');
        $total = $grade / $count;

        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $total
        ], 200);
    }

    public function nilaiQuiz(Request $request)
    {
        $user = Auth::user();
        $nilai = NilaiQuiz::create([
            'user_id' => 5,
            'grade' => $request->grade,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'quiz_id' => $request->quiz_id,
            'iscomplete' => 1
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
        $uts = UserExam::where('user_id', $user->id)->where('tipe', 'uts')->where('mata_kuliah_id',$id)->get();
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $uts
        ], 200);
    }

    public function gradeUas($id)
    {
        $user = Auth::user();
        $uas = UserExam::where('user_id', $user->id)->where('tipe', 'uas')->where('mata_kuliah_id',$id)->get();
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $uas
        ], 200);
    }
}
