<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DiscussionForum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\DiscussionReply;
use App\Models\DiscussionReply2;
use App\Models\DiscussionLike;
use App\Models\DiscussionLike2;
use App\Http\Resources\DiscussionForumResource;
use App\Http\Resources\DiscussionForumCollection;
use App\Helpers\ResponseFormatter;

class DiscussionForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $diskusi = DiscussionForum::all();
        $reply = DiscussionReply::all();
        $reply2 = DiscussionReply2::all();

        $ada1 = NULL;
        $ada = NULL;
        $arr1 = [];

        if ($diskusi != NULL) {
            foreach ($diskusi as $diskusis) {
                foreach ($reply as $replys) {
                    foreach ($reply2 as $replys2) {
                        if ($replys2->discussion_reply_id == $replys->id) {
                            $like3 = DiscussionLike2::where('discussion_reply_id', $replys2->id)->count();
                            $ada1[] = [
                                'id' => $replys2->id,
                                'user_id' => $replys2->user->name,
                                'isi' => $replys2->isi,
                                'like' => $like3,
                                'discussion_reply_id' => $replys2->discussion_reply_id,
                                'created_at' => $replys2->created_at,
                            ];                            
                        }                       
                        else{
                            // $ada1 = NULL;
                        }
                        // $ada1 = NULL;
                    }
                    if ($replys->discussion_id == $diskusis->id) {

                        $like2 = DiscussionLike2::where('discussion_reply_id', $replys->id)->count();
                        $ada[] = [
                            'id' => $replys->id,
                            'user_id' => $replys->user->name,
                            'isi' => $replys->isi,
                            'like' => $like2,
                            'discussion_id' => $replys->discussion_id,
                            'reply2' => $ada1,
                            'created_at' => $replys->created_at,
                        ];
                        $ada1 = NULL;
                    }
                    else{
                        $ada1 = NULL;
                    }
                }

                $like = DiscussionLike::where('discussion_id', $diskusis->id)->count();
                $arr1[] = [
                    'id' => $diskusis->id,
                    'user_id' => $diskusis->user->name,
                    'mata_kuliah_id' => $diskusis->mata_kuliah_id,
                    'judul' => $diskusis->judul,
                    'isi' => $diskusis->isi,
                    'like' => $like,
                    'gambar' => $diskusis->gambar,
                    'reply' => $ada,
                    'created_at' => $diskusis->created_at,
                ];
                $ada = NULL;
            }
        } else {
            $arr1 = [];
        }

        // dd($arr1);
        return response()->json([
            "status" => "success",
            "data" => $arr1,
        ], 200);
        // return ResponseFormatter::success($arr1, "Selamat Datang di Discussion Forum!");
        // return new DiscussionForumCollection($arr1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function created()
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
        $user   =   Auth::user();
        $input = new DiscussionForum();
        if ($files = $request->file('gambar')) {

            //store file into document folder
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = 'storage/images/' . $file_name;
            $request->gambar->storeAs('public/images', $file_name);
            $input->gambar = $txt;
        }
        // $discussionForum = new DiscussionForum();
        // $user = Auth::user();

        $input->judul = $request->judul;
        $input->isi = $request->isi;
        $input->user_id = $user->id;
        $input->mata_kuliah_id = $request->mata_kuliah_id;

        $input->save();
        // return ResponseFormatter::success(null, "Discussion Forum berhasil ditambahkan!");
        return response()->json([
            "error" => false,
            "message" => "success"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiscussionForum  $discussionForum
     * @return \Illuminate\Http\Response
     */
    public function show(DiscussionForum $discussionForum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiscussionForum  $discussionForum
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscussionForum $discussionForum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiscussionForum  $discussionForum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $DiscussionForum = DiscussionForum::findOrFail($id);
        $DiscussionForum->judul = $request->judul;
        $DiscussionForum->isi = $request->isi;
        if (isset($request->gambar)) {
            $extention = $request->gambar->extension();
            $file_name = time() . '.' . $extention;
            $txt = 'storage/images/' . $file_name;
            $request->gambar->storeAs('public/images', $file_name);
            $DiscussionForum->gambar = $txt;
        } else {
        }

        $DiscussionForum->save();

        return response()->json([
            "error" => false,
            "message" => "success"
        ]);
        // return ResponseFormatter::success(null, "Discussion forum berhasil diedit!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiscussionForum  $discussionForum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DiscussionForum::where('id', $id)->delete();
        return response()->json([
            "error" => false,
            "message" => "success"
        ]);
        // return ResponseFormatter::success(null, "Discussion forum berhasil dihapus!");
    }

    public function leaderboard(Request $request)
    {
        $user   =   Auth::user();
  
        $data = NULL;        
        // return ResponseFormatter::success(null, "Discussion Forum berhasil ditambahkan!");
        return response()->json([
            "error" => false,
            "message" => "success",
            "data" => $data                                
        ]);
    }
}
