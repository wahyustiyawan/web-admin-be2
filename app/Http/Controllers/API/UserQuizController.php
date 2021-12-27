<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserQuizController extends Controller
{
    public function index()
    {   
        // $userassignment = UserAssignment::where('user_id',$id)->get();
        $userquiz = UserQuiz::all();
        // dd($userassignment);
        return response()->json([
            "message" => "Success",
            "data" => $userquiz
        ], 200); 
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        UserQuiz::create([
            'user_id' => $user->id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'quiz_id' => $request->quiz_id,
            'soal' => $request->soal,
            'jawaban' => $request->jawaban,
        ]);

        return response()->json([
            "error" => false,
            "message" => "success"
        ]);
    }
}
