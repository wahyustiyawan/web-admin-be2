<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Kategori;
use App\Models\Kelas;
use App\Models\KontenDokumen;
use App\Models\KontenVideo;
use App\Models\MataKuliah;
use App\Models\Pertemuan;
use App\Models\Quiz;
use App\Models\Exam;
use App\Models\AksesKelas;
use App\Models\EnrollMataKuliah;
use App\Models\Enrolls;
use App\Models\ExamPilgan;
use App\Models\Nilai;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        View::share('AksesKelas', AksesKelas::all());
    }
    
    public function index()
    {
        $mataKuliah = MataKuliah::all();
        $pertemuan =Pertemuan::get();
        $kategori = kategori::all();
        return view('admin.mata_kuliah.show',['pertemuan'=> $pertemuan], compact('mataKuliah', 'kategori', 'pertemuan'));
    }

    public function create()
    {
        $mataKuliah = MataKuliah::all();
        $kategori = kategori::all();
        $kelas = Kelas::all();
        return view('admin.mata_kuliah.tambah',compact('mataKuliah', 'kategori','kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'sks' => 'required',
            'kategori_id' => 'required',
            'kelas_id' => 'required',
            'kode' => 'required',
        ]);
        MataKuliah::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'sks' => $request->sks,
            'kategori_id' => $request->kategori_id,
            'kelas_id' => $request->kelas_id,
            'kode' => $request->kode,
        ]);
        //notify()->success('Kelas berhasil ditambahkan!');
        return back()
            ->with('success', 'Mata kuliah Berhasil Ditambahkan');
    }

    public function show($id)
    {
        $mataKuliah = MataKuliah::where('id', $id)->first();
        $kategori = Kategori::all();
        $kontenDokumen = kontenDokumen::where('mata_kuliah_id', $id)->get();
        $kontenVideo = kontenVideo::where('mata_kuliah_id', $id)->get();
        $mataKuliahselect = MataKuliah::all();
        $assignment = Assignment::where('mata_kuliah_id', $id)->get();
        $quiz = Quiz::where('mata_kuliah_id', $id)->get();
        $pertemuan = Pertemuan::all();
        $pertemuanselect = Pertemuan::where('mata_kuliah_id', $id)->get();
        $ujian = Exam::where('mata_kuliah_id', $id)->get();
        $ujianpilgan = ExamPilgan::where('mata_kuliah_id', $id)->get();
        $enrolls = EnrollMataKuliah::where('mata_kuliah_id', $id)->get();
        $nilai = Nilai::where('mata_kuliah_id', $id)->get();
        return view('admin.mata_kuliah.show', compact('enrolls', 'nilai','kategori','mataKuliahselect','kontenDokumen','kontenVideo', 'assignment','pertemuan','mataKuliah', 'quiz', 'pertemuanselect', 'ujian', 'ujianpilgan'));
    }


    public function edit($id)
    {
        $kategori = kategori::all();
        $matakuliah = MataKuliah::find($id);
        return view('admin.mata_kuliah.edit', compact('matakuliah','kategori'));
    }

    public function update(Request $request, $id)
    {
        $mata_kuliah = MataKuliah::findOrFail($id);
        $mata_kuliah->kategori_id = $request->kategori_id;
        $mata_kuliah->judul = $request->judul;
        $mata_kuliah->deskripsi = $request->deskripsi;
        $mata_kuliah->sks = $request->sks;
        $mata_kuliah->kelas_id = $request->kelas_id;
        $mata_kuliah->kode = $request->kode;
        $mata_kuliah->save();
        //notify()->success('Kelas berhasil diedit!');
        return redirect()->route('kelas.show',$request->kelas_id)
        ->with('edit', 'mata_kuliah Berhasil Diedit');
    }

    public function destroy($id)
    {
        MataKuliah::where('id', $id)->delete();
        //notify()->success('Kelas berhasil dihapus!');
        return redirect()->back()
            ->with('delete', 'Mata Kuliah Berhasil Dihapus');
    }
}
