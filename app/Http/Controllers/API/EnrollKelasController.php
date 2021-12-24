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
use App\Http\Resources\UserVideoResource;
use App\Http\Resources\UserDokumenResource;
use App\Http\Resources\EnrollsResource;
use App\Http\Resources\EnrollsCollection;
use App\Http\Resources\EnrollKelasResource;
use App\Http\Resources\EnrollKelasCollection;
use App\Models\EnrollKelas;
use App\Models\MataKuliah;

class EnrollKelasController extends Controller
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
        $enrolls       =  EnrollKelas::where('user_id', $user->id)->get();
        return new EnrollKelasCollection($enrolls);
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
            'iscomplete'     =>   false,
        );
        try{
            $enrolls   =  EnrollKelas::create($taskInput);
        }catch (QueryException $e){
            $success['error']  =   true;
            $success['message'] =   $e->getMessage();
            //$success['data']    =   new EnrollsResource(Enrolls::where(['kelas_id' => $kelas->id, 'user_id' => $user->id])->get());
            return response()->json($success);
        }

        $listMkuliah = MataKuliah::where('kelas_id', $kelas->id)->get();
        
        foreach ($listMkuliah as $Mkuliah){
            $Input      =       array(
                'user_id'     =>      $user->id,
                'mata_kuliah_id'   =>  $Mkuliah->id,
                'iscomplete'     =>   false,
            );
            $enroll_Mkuliah = new Enrolls($Input);    
            //UserDokumen::create($Input);
            $enrolls->enroll_mata_kuliah()->save($enroll_Mkuliah);

            $kontendokumen = KontenDokumen::where('mata_kuliah_id', $Mkuliah->id)->get();
            $kontenvideo = KontenVideo::where('mata_kuliah_id', $Mkuliah->id)->get();

            foreach ($kontenvideo as $kvideo){
                $Input      =       array(
                    'progress'     => 0,
                    'user_id' => $user->id,
                    //'enroll_id'    => $enrolls->id,
                    'konten_video_id' => $kvideo->id,
                );
                $video = new UserVideo($Input);  
                //UserVideo::create($Input);
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
        
        // $kontendokumen = MataKuliah::find($kelas->id)->get_dokumen;
        // $kontenvideo = MataKuliah::find($kelas->id)->get_video;

        // foreach ($kontenvideo as $kvideo){
        //     $Input      =       array(
        //         'progress'     => 0,
        //         'user_id' => $user->id,
        //         //'enroll_id'    => $enrolls->id,
        //         'konten_video_id' => $kvideo->id,
        //     );
        //     $video = new UserVideo($Input);  
        //     //UserVideo::create($Input);
        //     $enrolls->get_video()->save($video);
        // }

        // if(!is_null($enrolls)) {
        //     $success['error']  =   false;
        //     $success['status']  =   "success";
        //     $success['data']    =   new EnrollsResource($enrolls);
        // }
        // else {
        //     $success['error']  =   true;
        //     $success['status']  =   "failed";
        //     $success['message'] =   "Whoops! no detail found";

        //     return response()->json($success);
        // }
        
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
        $enrolls       =  Enrolls::find($id);
        $my_array1      =       array(
            'user_video' => UserVideoResource::collection($enrolls->video),
            'user_dokumen' => UserDokumenResource::collection($enrolls->dokumen),
        );
        $my_array2 = new EnrollsResource($enrolls);
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
            $enroll_kelas = EnrollKelas::where($matchThese)->get()->first();

            if(!is_null($enroll_kelas)) {
                if($user->id == $enroll_kelas->user_id) {
                    $response   =   EnrollKelas::where('id', $enroll_kelas->id)->delete();
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
        $enrolls       =    EnrollKelas::findOrFail($id);
    
        if(!is_null($enrolls)) {
            if($user->id == $enrolls->user_id) {
                $response   =   EnrollKelas::where('id', $id)->delete();
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