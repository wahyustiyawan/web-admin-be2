<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $artikel = Artikel::all();
        return response()->json([
            "error" => false,
            "message" => "Success",
            "data" => $artikel
        ], 200);
        // return ResponseFormatter::success($artikel, "Daftar artikel!");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
              [
                'judul' => 'required',
                'gambar' => 'required|mimes:jpg,png|max:2048',
                'deskripsi' => 'required',
             ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if ($gambar = $request->file('gambar')) {

            //store file into document folder
            $extention = $request->file->extension();
            $file_name = time() . '.' . $extention;
            $txt = 'storage/images/'. $file_name;
            $request->gambar->storeAs('public/images', $file_name);

            //store your file into database
            $artikel = new Artikel();
            $artikel->judul = $request->judul;
            $artikel->gambar = $txt;
            $artikel->deskripsi = $request->deskripsi;


            return response()->json([
                "error" => false,
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $txt
            ]);
            // return ResponseFormatter::success(["file" => $txt], "Artikel berhasil ditambahkan!");

        }
        return Artikel::create($request->all());
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
        return Artikel::find($id);
        // return ResponseFormatter::success($artikel, "Detail artikel!");
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
        $artikel = Artikel::find($id);
        $artikel ->update($request->all());
        return $artikel;
        // return ResponseFormatter::success($artikel, "Artikel berhasil diperbarui!");
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
        return Artikel::destroy($id);
        // return ResponseFormatter::success(null, "Artikel berhasil dihapus!");
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($judul)
    {
        return Artikel::where(strtolower('judul'), 'like', '%'.$judul.'%')->get();
        // return ResponseFormatter::success($artikel, "Hasil pencarian artikel");
    }
    public function latest_article()
    {
        $new_article = Artikel::latest()->take(4)->get();
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $new_article
        ], 200);

        // return ResponseFormatter::success($new_article, "Artikel terbaru!");
    }
}
