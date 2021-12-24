<?php

namespace App\Http\Controllers\API;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KalenderResource;
use App\Http\Resources\KalenderCollection;
use App\Models\Assignment;
use App\Helpers\ResponseFormatter;

class KalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mata_kuliah =  Assignment::all();
        $kalender =  new KalenderCollection($mata_kuliah);
        return ResponseFormatter::success($kalender);
    }

    public function findbyid($id)
    {
        $meet = Assignment::find($id);
        $kalender = new KalenderResource($meet);
        return ResponseFormatter::success($kalender);
    }

    // records.sort((a, b) => {
    //     return new Date(a.order_date) - new Date(b.order_date); // descending
    //   })
      
    //   records.sort((a, b) => {
    //     return new Date(b.order_date) - new Date(a.order_date); // ascending
    //   })
}
