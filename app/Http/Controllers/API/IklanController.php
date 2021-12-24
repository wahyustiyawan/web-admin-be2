<?php

namespace App\Http\Controllers\API;

use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Helpers\ResponseFormatter;

class IklanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() 
    {
        //return IklanResource::collection(Iklan::all());
        $iklan = Iklan::all();
        return response()->json([
            "error" => false,
            "message" => "Success",
            "data" => $iklan
        ], 200);
        // return ResponseFormatter::success($iklan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
              [
                'gambar' => 'required|mimes:jpeg,png,jpg',
             ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if ($files = $request->file('gambar')) {

            //store file into document folder
            $extention = $request->gambar->extension();
            $file_name = time().'.'.$extention;
            $txt = 'storage/images/'. $file_name;
            $request->gambar->storeAs('public/images', $file_name);

            //store your file into database
            $iklan = new Iklan();
            $iklan->gambar = $file_name;
            $iklan->save();

            return response()->json([
                "error" => false,
                "success" => true,
                "message" => "Images successfully uploaded",
                "file" => $txt
            ]);
            // return ResponseFormatter::success(["file" => $txt], "Iklan berhasil ditambahkan!");

        }
        return Iklan::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Iklan::find($id);
        // return ResponseFormatter::success($iklan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $iklan = Iklan::find($id);
        $iklan ->update($request->all());
        return $iklan;
        // return ResponseFormatter::success($iklan, "Iklan berhasil diedit!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return Iklan::destroy($id);
        // return ResponseFormatter::success(null, "Iklan berhasil dihapus!");
    }

    public function download($id)
    {
        $iklan = Iklan::find($id);
        $lst = explode('/', $iklan->gambar);
        $txt = 'api/download_images/'.$lst[2];
        return redirect($txt);
    }

    public function view($id)
    {
        $iklan = Iklan::find($id);
        $lst = explode('/', $iklan->gambar);
        $txt = $iklan->gambar;
        print($txt);
        return redirect($txt);
    }
}