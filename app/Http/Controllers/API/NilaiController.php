<?php

namespace App\Http\Controllers\API;

use App\Models\Nilai;
use App\Http\Controllers\Controller;
use App\Models\UserAssignment;
use App\Models\UserExam;
use App\Models\UserQuiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        Nilai::create([
            'user_id' => $user->id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'tipe' => $request->tipe,
            'nilai' => $request->nilai,
        ]);

        return response()->json([
            "error" => false,
            "message" => "success"
        ]);
    }

    public function postExam(Request $request)
    {
        $user = Auth::user();
        UserExam::create([
            'user_id' => $user->id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'exam_id' => $request->exam_id,
            'tipe' => $request->tipe,
            'grade' => $request->grade,
        ]);

        return response()->json([
            "error" => false,
            "message" => "success"
        ]);
    }

    public function gradeAssignment($id)
    {
        $user = Auth::user();
        $count = UserAssignment::where('user_id', $user->id)->where('mata_kuliah_id',$id)->count();
        $grade = UserAssignment::where('user_id', $user->id)->where('mata_kuliah_id',$id)->sum('grade');
        $total = $grade / $count;

        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $total
        ], 200);
    }

    public function gradeExam($id)
    {
        $user = Auth::user();
        $count = UserExam::where('user_id', $user->id)->where('mata_kuliah_id',$id)->count();
        $grade = UserExam::where('user_id', $user->id)->where('mata_kuliah_id',$id)->sum('grade');
        $total = $grade / $count;

        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $total
        ], 200);
    }
}
