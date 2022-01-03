<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\MataKuliah;
use App\Models\Nilai;
use App\Models\UserAssignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $userassignment = UserAssignment::where('user_id',$id)->get();
        $userassignment = UserAssignment::all();
        // dd($userassignment);
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $userassignment
        ], 200); 
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $input = new UserAssignment();
        $input->assignment = $request->assignment;
        $input->grade = 0;
        $input->user_id = $user->id;
        $input->mata_kuliah_id = $request->mata_kuliah_id;
        $input->assignment_id = $request->assignment_id;
        $input->iscomplete = 0;
        $input->save();
  
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $input
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAssignment  $userAssignment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return UserAssignment::where('id',$id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAssignment  $userAssignment
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAssignment $userAssignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAssignment  $userAssignment
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request)
    // {
    //     $user       =       Auth::user();
    //     $validator  =       Validator::make($request->all(),
    //         [
    //             'id'         =>   'required',
    //             'assignment' =>   'required',
    //             'grade'      =>   'required',
    //             'feedback'   =>   'required',
    //             'iscomplete' =>   'required',
    //             'assignment_id' => 'required',
    //             'mata_kuliah_id'  => 'required'
    //         ]
    //     );
    //     $inputData      =       array(
    //         'assignment' =>      $request->assignment,
    //         'grade'      =>      $request->grade,  
    //         'feedback'   =>      $request->feedback,
    //         'iscomplete' =>      $request->iscomplete,
    //         'assignment_id' =>   $request->assignment_id,
    //         'mata_kuliah_id'  =>      $request->mata_kuliah_id
    //     );

    //     $assignment      =   UserAssignment::where('id', $request->id)->where('user_id', $user->id)->update($inputData);
        
    //     if($assignment == 1) {
    //         $success['status']      =       "success";
    //         $success['message']     =       " Nilai peserta ". $request->grade ."%";
    //     }

    //     else {
    //         $success['status']      =       "failed";
    //         $success['message']     =       "Gagal input!";
    //     }
        
    //     return response()->json($success);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAssignment  $userAssignment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Assignment::destroy($id);
    }
}
