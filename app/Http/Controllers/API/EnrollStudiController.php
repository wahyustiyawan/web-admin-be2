<?php

namespace App\Http\Controllers\API;

use App\Models\Enrolls;
use App\Models\Kelas;
use App\Models\KontenDokumen;
use App\Models\KontenVideo;
use App\Models\UserDokumen;
use App\Models\UserVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Http\Resources\EnrollMataKuliahResource;
use App\Http\Resources\UserVideoResource;
use App\Http\Resources\UserDokumenResource;
use App\Http\Resources\EnrollsResource;
use App\Http\Resources\EnrollsCollection;
use App\Http\Resources\EnrollStudiResource;
use App\Http\Resources\EnrollStudiCollection;
use App\Models\Administration;
use App\Models\EnrollMataKuliah;
use App\Models\EnrollStudi;
use App\Models\MataKuliah;

class EnrollStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user       =   Auth::user();
        $enrolls       =  EnrollStudi::where('user_id', $user->id)->get();
        return new EnrollStudiCollection($enrolls);
    }

    public function enroll($id)
    {
        $enrolls = EnrollStudi::where('kelas_id', $id)->count();
        // $enrolls = EnrollStudi::all();
        return response()->json([
            "error" => false,
            "success" => true,
            "data" => $enrolls
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user   =   Auth::user();
        $validator = Validator::make($request->all(),
            [
                'kelas_id' => 'required',
            ]
        );

        if($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()]);
        }
        $kelas = Kelas::find($request->kelas_id);
        if(is_null($kelas)) {
            $success['error']  =   true;
            $success['message'] =   "id kelas tidak ditemukan";

            return response()->json($success);
        }
        
        $taskInput      =       array( 
            'user_id'     =>      $user->id,
            'kelas_id'   =>  $kelas->id,
            'isComplete'     =>   false,
        );
        try{
            $enrolls   =  EnrollStudi::create($taskInput);
        }catch (QueryException $e){
            $success['error']  =   true;
            $success['message'] =   $e->getMessage();

            return response()->json($success);
        }

        $semester = Administration::where('user_id', $user->id)->first()->semester;
        $listMkuliah = MataKuliah::where('kelas_id', $kelas->id)->where('semester', $semester)->get();
        foreach ($listMkuliah as $Mkuliah){
            $Input      =       array(
                'user_id'     =>      $user->id,
                'mata_kuliah_id'   =>  $Mkuliah->id,
                'semester' => $Mkuliah->semester,
                'isComplete'     =>   false,
            );
            $enroll_Mkuliah = new EnrollMataKuliah($Input);
            // $enroll_Mkuliah->save();    
            $enrolls->enroll_mata_kuliah()->save($enroll_Mkuliah);

            $kontendokumen = KontenDokumen::where('mata_kuliah_id', $Mkuliah->id)->get();
            $kontenvideo = KontenVideo::where('mata_kuliah_id', $Mkuliah->id)->get();

            foreach ($kontenvideo as $kvideo){
                $Input      =       array(
                    'progress'     => 0,
                    'user_id' => $user->id,
                    'konten_video_id' => $kvideo->id,
                );
                $video = new UserVideo($Input);  
                $enroll_Mkuliah->get_video()->save($video);
            }
    
            foreach ($kontendokumen as $kdokumen){
                $Input      =       array(
                    'progress'     => 0,
                    'user_id' => $user->id,
                    //'enroll_id'    => $enrolls->id,
                    'konten_dokumen_id' => $kdokumen->id,
                );
                $dokumen = new UserDokumen($Input);    
                //UserDokumen::create($Input);
                $enroll_Mkuliah->get_dokumen()->save($dokumen);
            }
        }
        
        
        if(!is_null($enrolls)) {
            $success['error']  =   false;
            $success['message']  =   "berhasil enroll ke kelas ".$enrolls->kelas->nama;
        }
        else {
            $success['error']  =   true;
            $success['message'] =   "Whoops! no detail found";

            return response()->json($success);
        }

        return response()->json($success);
    }

    public function findbyid($id){
        $user       =   Auth::user();
        $enrolls       =  EnrollMataKuliah::find($id);
        $my_array1      =       array(
            'user_video' => UserVideoResource::collection($enrolls->video),
            'user_dokumen' => UserDokumenResource::collection($enrolls->dokumen),
        );
        $my_array2 = new EnrollMataKuliahResource($enrolls);
        //$res = array_merge($my_array1, $my_array2);
        return $my_array2;
    }

    public function unenrollsbykelasid(Request $request){
        $user       =       Auth::user();
        if($request->kelas){
            $matchThese = [
                ['user_id', '=', $user->id],
                ['kelas_id', '=', $request->kelas],
            ];
            $enroll_kelas = EnrollStudi::where($matchThese)->get()->first();

            if(!is_null($enroll_kelas)) {
                if($user->id == $enroll_kelas->user_id) {
                    $response   =   EnrollStudi::where('id', $enroll_kelas->id)->delete();
                    $kelas = Kelas::find($enroll_kelas->kelas->id);
                }
                else {
                    $success['error']  =   true;
                    $success['message'] =   "Akses ditolak";
                    return response()->json($success);
                }
                if($response == 1) {
                    $success['error']  =   false;
                    $success['message'] =   'Berhasil unenrolls dari course ' . $kelas->nama;
                    return response()->json($success);
                }
            }
        }else{
            $success['error']  =   true;
            $success['message'] =   "Sertakan kelas=id yang akan di unenroll";
            return response()->json($success);
        }
    }

    public function unenrolls($id) {
        
        $user       =       Auth::user();
        $enrolls       =    EnrollStudi::findOrFail($id);
    
        if(!is_null($enrolls)) {
            if($user->id == $enrolls->user_id) {
                $response   =   EnrollStudi::where('id', $id)->delete();
                $kelas = Kelas::find($enrolls->kelas_id);
            }
            else {
                $success['error']  =   true;
                $success['message'] =   "Akses ditolak";
                return response()->json($success);
            }
            if($response == 1) {
                $success['error']  =   false;
                $success['message'] =   'Berhasil unenrolls dari course ' . $kelas->nama;
                return response()->json($success);
            }
        }
    }


    public function enroll_dokumen()
    {
        $user       =   Auth::user();
        $enrolls       =  UserDokumen::where('user_id', $user->id)->get();
        return $enrolls;
    }

    public function enroll_video()
    {
        $user       =   Auth::user();
        $enrolls       =  UserVideo::where('user_id', $user->id)->get();
        return $enrolls;
    }
}