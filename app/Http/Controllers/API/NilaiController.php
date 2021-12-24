<?php

namespace App\Http\Controllers\API;

use App\Models\Nilai;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function store(Request $request)
    {
        Nilai::create([
            'user_id' => $request->user_id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'tipe' => $request->tipe,
            'nilai' => $request->nilai,
        ]);

        return response()->json([
            "error" => false,
            "message" => "success"
        ]);
    }
}
