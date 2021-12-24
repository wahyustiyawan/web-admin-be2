<?php

namespace App\Http\Controllers\API;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MataKuliahResource;
use App\Http\Resources\MataKuliahCollection;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->kelas){
            $mata_kuliah = MataKuliah::where('kelas_id', $request->kelas)->get();
        }else{
            $mata_kuliah =  MataKuliah::all();
        }
        return new MataKuliahCollection($mata_kuliah);
        
        // return response()->json([
        //     "status" => "success",
        //     "data" => $mata_kuliah
        // ], 200);
    }

    public function findbyid($id)
    {
        $meet = MataKuliah::find($id);
        return new MataKuliahResource($meet);
    }
}
