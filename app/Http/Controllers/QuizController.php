<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Support\Facades\Storage;
use App\Imports\QuizImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Akses;
use Illuminate\Support\Facades\Auth;
use App\Models\Kalender;
use App\Models\AksesKelas;
use App\Models\Nilai;
use App\Models\NilaiQuiz;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        View::share('AksesKelas', AksesKelas::all());
    }

    public function QuizImport(Request $request)
    {

        //$assignmentPilgan = AssignmentPilgan::all();
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        //$assignmentPilgan = new AssignmentPilgan();
        $file = $request->file('file');

        $taskInput      =       array(
            //'tipe'    =>      $request->tipe,
            'judul'    =>      $request->judul,
            'deskripsi'     =>      $request->deskripsi,
            'mata_kuliah_id'    =>      $request->mata_kuliah_id,
            'pertemuan_id'    =>      $request->pertemuan_id,
        );
        Kalender::create([
            'judul' => $request->judul,
            'deadline' => $request->deadline,
            'user_id' => Auth::user()->id,
            'tipe' => 'kuis',
            'color' => 'bg-gradient-success',
        ]);

        $myQuiz = Quiz::create($taskInput);

        $file_name = rand() . $file->getClientOriginalName();
        $file->storeAs('public/Quiz', $file_name);
        // dd($pertemuan_id, $mata_kuliah_id, $file);
        Excel::import(new QuizImport($myQuiz->id), public_path('/storage/Quiz/' . $file_name));
        Storage::delete("public/Quiz/$file_name");
        // dd($soal_id);

        return redirect()->back()
            ->with('success', 'Quiz Berhasil diimport');
    }

    public function destroy($id)
    {
        Quiz::where('id', $id)->delete();
        //notify()->success('Kelas berhasil dihapus!');
        return redirect()->back()
            ->with('delete', 'Quiz Berhasil Dihapus');
    }

    public function show($id)
    {
        $quiz = Quiz::find($id);
        $nilai = NilaiQuiz::get();
        return view('admin.assignment.show-quiz', compact('quiz', 'nilai'));
    }
}
