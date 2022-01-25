<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Intervention\Image\Facades\Image;


class SertifikatController extends Controller
{
    public function sertifikat()  
    { 
    //    $host = $request->getSchemeAndHttpHost(); 
       $user = Auth::user();
       $img = Image::make('sertifikat/sertifikat.jpg');  
       $img->text(strval($user->name), 120, 100, function($font) {  
        $font->file('font/roboto.regular.ttf');  
        $font->size(28);  
        $font->color('#e1e1e1');  
        $font->align('center');  
        $font->valign('bottom');  
        $font->angle(90);  
    });  
       $img->save('sertifikat/sertifikat.jpg');
       
        return response()->json([
            "error" => false,
            "message" => "Success",
            "data" => base64_encode($img)
        ], 200);

        // print($img);
        // return redirect($img);
    }


}
