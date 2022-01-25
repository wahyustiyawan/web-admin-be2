<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;


class SertifikatController extends Controller
{
    public function sertifikat()
    {
        $user = User::where('id', 1)->first();

        $image = ('sertifikat/sertifikat.jpg');
        $path = ('sertifikat/'.Str::random(5).'.jpg');
        // create Image from Input
        $img = Image::make($image);

        // write text
        $img->text('The quick brown fox jumps over the lazy dog.');

        // write text at position x , y 
        $img->text('The quick brown fox jumps over the lazy dog.', 120, 100);

        // use callback to define details
        $img->text('foo', 0, 0, function ($font) {
            $font->file(public_path('font/roboto.regular.ttf'));
            $font->size(24);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('top');
            $font->angle(45);
        });

        // draw transparent text
        $img->text('foo', 0, 0, function ($font) {
            $font->color(array(255, 255, 255, 0.5));
        });

        // Save Image to Path

        $img->save($path);

        // dd($img);

        // print($img);
        // return redirect($img);
    }
}
