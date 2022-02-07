<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function buku_panduan()
    {
        $guide = Guide::where('tipe', 'Buku Panduan')->get();
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $guide
        ], 200);
    }

    public function view($id)
    {
        $guide = Guide::find($id)->where('tipe', 'Buku Panduan')->first();
        $lst = explode('/', $guide->file);
        $txt = 'api/view/'.$lst[2];
        return redirect($txt);
    }

    public function video_panduan()
    {
        $guide = Guide::where('tipe', 'Video Panduan')->get();
        $thumbnail = Guide::select('thumbnail')->get();
        // Guide::('thumbnail', $thumbnail)->get();
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $guide,
            "thumbnail" =>base64_encode($thumbnail),
        ], 200);
    }

    public function kamus_kg()
    {
        $guide = Guide::where('tipe', 'Kamus KG')->get();
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $guide
        ], 200);
    }
}
