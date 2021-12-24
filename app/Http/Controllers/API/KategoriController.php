<?php

namespace App\Http\Controllers\API;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Helpers\ResponseFormatter;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategori = Kategori::all();
        return ResponseFormatter::success($kategori);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            //'kategori' => 'required',
        ]);
        return Kategori::create($request->all());
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
        $kategori = Kategori::find($id);
        return ResponseFormatter::success($kategori);
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
        $kategori = Kategori::find($id);
        $kategori ->update($request->all());
        return ResponseFormatter::success($kategori, "Skill level berhasil diedit!");
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
        Kategori::destroy($id);
        return ResponseFormatter::success(null, "Skill level berhasil dihapus!");
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $kategori = Kategori::where(strtolower('nama'), 'like', '%'.$name.'%')->get();
        return ResponseFormatter::success($kategori, "Hasil pencarian skill level");
    }

    public function kelas_dokumen($id)
    {
        $kategori = Kategori::find($id)->get_dokumen;
        return ResponseFormatter::success($kategori, "Hasil pencarian dokumen");
    }


    public function kelas_video($id)
    {
        $kategori = Kategori::find($id)->get_video;
        return ResponseFormatter::success($kategori, "Hasil pencarian video");
    }

}
