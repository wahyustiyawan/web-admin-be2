<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DiscussionLike2;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class DiscussionLike2Controller extends Controller
{
    public function index($id)
    {
        $like = DiscussionLike2::where('discussion_reply_id', $id)->get();
        return response()->json([
            "error" => false,
            "status" => "success",
            "data" => $like
        ],200);
        // return ResponseFormatter::success($like);
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        $input = new DiscussionLike2();
        $input->discussion_reply_id = $request->discussion_reply_id;
        $input->isLike = $request->isLike;
        $input->user_id = $user->id;

        $input->save();
        
        return response()->json([
            "error" => false,
            "message" => "success"
        ],200);
        // return ResponseFormatter::success(null, "Like berhasil ditambahkan!");
    }

    public function update(Request $request, $id) 
    {
        $user = Auth::user();
        $discussion_id = DiscussionLike2::where('id', $id)->get();
        $reply = DiscussionLike2::where('user_id', $id)->first();

        $input = new DiscussionLike2();
        $input->discussion_id = $discussion_id;
        $input->isLike = $request->isLike;
        $input->user_id = $user->id;

        $input->update();
        
        return response()->json([
            "error" => false,
            "message" => "success"
        ],200);
        // return ResponseFormatter::success(null, "Like berhasil diedit!");
    }

    public function destroy($id) 
    {
        DiscussionLike2::where('id', $id)->delete();
        return response()->json([
            "error" => false,
            "message" => "success"
        ],200);
        // return ResponseFormatter::success(null, "Like berhasil dihapus!");
    }
}

