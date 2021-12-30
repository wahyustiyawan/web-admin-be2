<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $profil = User::all();
        return response()->json([
            "error" => false,
            "message" => "Success",
            "data" => $profil
        ], 200);
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
                'name' => 'required',
                'no_hp' => 'required',
                'gambar' => 'required|mimes:jpg,png|max:2048',
             ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if ($gambar = $request->file('gambar')) {

            //store file into document folder
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = 'storage/images/'. $file_name;
            $request->gambar->storeAs('public/images', $file_name);

            //store your file into database
            $profil = new User();
            $profil->name = $request->name;
            $profil->no_hp = $request->no_hp;
            $profil->gambar = $txt;

            $profil->save();

            return response()->json([
                "error" => false,
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file_name
            ]);

        } else {

        }
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
        return Profil::find($id);
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
        $artikel = Profil::find($id);
        $artikel ->update($request->all());
        return $artikel;
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
        return Profil::destroy($id);
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($nama)
    {
        return Profil::where(strtolower('nama'), 'like', '%'.$nama.'%')->get();
    }
    public function latest_article()
    {
        $new_profil = Profil::latest()->take(4)->get();
        return response()->json([
            "error" => false,
            "message" => "Success",
            "data" => $new_profil
        ], 200);
    }
}
