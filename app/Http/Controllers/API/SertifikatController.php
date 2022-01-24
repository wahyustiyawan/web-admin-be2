<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Image;


class SertifikatController extends Controller
{
    public function sertifikat(Request $request)  
    { 
       $host = $request->getSchemeAndHttpHost(); 
       $user = Auth::user();
       $img = Image::make(public_path('sertifikat/sertifikat.jpg'));  
       $img->text(strval($user->name), 120, 100, function() {  
        //   $font->file(public_path('path/font.ttf'));  
        //   $font->size(28);  
        //   $font->color('#e1e1e1');  
        //   $font->align('center');  
        //   $font->valign('bottom');  
        //   $font->angle(90);  
      });  
       $img->save(public_path('sertifikat/sertifikat.jpg'));
       
        return response()->json([
            "error" => false,
            "message" => "Success",
            "data" => base64_encode($host.'/'.$img)
        ], 200);
    }


}
