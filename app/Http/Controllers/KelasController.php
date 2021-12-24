<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Kategori;
use App\Models\Kelas;
use App\Models\KontenDokumen;
use App\Models\KontenVideo;
use App\Models\MataKuliah;
use App\Models\Pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\AksesKelas;
class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        View::share('AksesKelas', AksesKelas::all());
    }
    
    public function index()
    {
        $kelas = Kelas::all();
        $kategori = kategori::all();
        return view('admin.kelas.index', compact('kelas', 'kategori'));
    }

    public function create()
    {
        $kategori = kategori::all();
        $kelas = Kelas::all();
        return view('admin.kelas.tambah',compact('kategori', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            //'kategori_id' => 'required',
            'sebelum' => 'required',
        ]);
        Kelas::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            //'kategori_id' => $request->kategori_id,
            'sebelum' => $request->sebelum,
        ]);
        //notify()->success('Kelas berhasil ditambahkan!');
        return redirect()->route('kelas.index')
            ->with('success', 'Program Studi Berhasil Ditambahkan');
    }

    public function show($id)
    {
        $kelas = Kelas::where('id', $id)->first();
        //$kontenDokumen = kontenDokumen::where('kelas_id', $id)->get();
        //$kontenVideo = kontenVideo::where('kelas_id', $id)->get();
        $kelasselect = Kelas::all();
        $kategori = Kategori::all();
        $assignment = Assignment::all();
        $mataKuliah = MataKuliah::all();
        $pertemuan = Pertemuan::all();
        return view('admin.kelas.show', compact('kelas','kategori', 'mataKuliah','kelasselect', 'assignment','pertemuan'));
    }


    public function edit($id)
    {
        $kelas = Kelas::find($id);
        //$kategori = kategori::all();
        return view('admin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    { 
        $kelas = Kelas::findOrFail($id);
        $kelas->nama = $request->nama;
        $kelas->deskripsi = $request->deskripsi;
        //$kelas->kategori_id = $request->kategori_id;
        $kelas->sebelum = $request->sebelum;
        $kelas->save();
        //notify()->success('Kelas berhasil diedit!');
        return redirect()->route('kelas.index')
        ->with('edit', 'Program Studi Berhasil Diedit');
    }

    public function destroy($id)
    {
        Kelas::where('id', $id)->delete();
        //notify()->success('Kelas berhasil dihapus!');
        return redirect()->route('kelas.index')
            ->with('delete', 'Program Studi Berhasil Dihapus');
    }
}
