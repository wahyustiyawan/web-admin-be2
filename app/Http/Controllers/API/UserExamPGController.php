<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserExamPG;
use Illuminate\Http\Request;

class UserExamPGController extends Controller
{
    public function store(Request $request)
    {
        UserExamPG::create([
            'user_id' => $request->user_id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'exam_id' => $request->exam_id,
            'soal' => $request->soal,
            'jawaban' => $request->jawaban,
        ]);

        return response()->json([
            "error" => false,
            "message" => "success"
        ]);
    }
}
