<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use lcobucci\jwt\Token\RegisteredClaimGiven;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\UserResource;

class PassportAuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'mahasiswa',
            'firebaseUID' => $request->firebaseUID,
        ]);
       
        //$token = $user->createToken('LaravelAuthApp')->accessToken;
 
        return response()->json([
            'error'=> false,
            'message'=>"Success",
            ], 200);
    }

    public function login(Request $request) {
        
        //return FirebaseAuth::listUsers();
        // Launch Firebase Auth
        $auth = app('firebase.auth');
        // Retrieve the Firebase credential's token
        $idTokenString = $request->input('Firebasetoken');
      
        
        try { // Try to verify the Firebase credential token with Google
          
          $verifiedIdToken = $auth->verifyIdToken($idTokenString);
          
        } catch (\InvalidArgumentException $e) { // If the token has the wrong format
          
          return response()->json([
              'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
          ], 401);        
          
        } catch (InvalidToken $e) { // If the token is invalid (expired ...)
          
          return response()->json([
              'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
          ], 401);
          
        }
      
        // Retrieve the UID (User ID) from the verified Firebase credential's token
        //$uid = $verifiedIdToken->getClaim('sub');
        $uid = $verifiedIdToken->claims()->get('sub');

        // Retrieve the user model linked with the Firebase UID
        $user = User::where('firebaseUID',$uid)->first();
        
        // Here you could check if the user model exist and if not create it
        // For simplicity we will ignore this step
      
        // Once we got a valid user model
        // Create a Personnal Access Token
        $tokenResult = $user->createToken('Personal Access Token');
        
        // Store the created token
        $token = $tokenResult->token;
        
        // Add a expiration date to the token
        $token->expires_at = Carbon::now()->addWeeks(1);
        
        // Save the token to the user
        $token->save();
        
        // Return a JSON object containing the token datas
        // You may format this object to suit your needs
        return response()->json([
            'success' => true,
            'id' => $user->id,
            'name' => $user->name,
            'email'=> $user->email,
            'no_hp'=> $user->no_hp,
            'gambar'=> $user->gambar,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
      
      }
 
    /**
     * Login
     */
    // public function login(Request $request)
    // {
    //     $data = [
    //         'email' => $request->email,
    //         'password' => $request->password
    //     ];
 
    //     if (auth()->attempt($data)) {
    //         $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
    //         return response()->json([
    //             'message'=>"Success",
    //             'token' => $token], 200);
    //     } else {
    //         return response()->json([
    //             'message'=>"Failed",
    //             'error' => 'Unauthorised'], 401);
    //     }
    // }
    
     // ---------------------------- [ Use Detail ] -------------------------------
     public function userDetail() {
        $user       =       Auth::user();
        return new UserResource($user);
    }

    public function updateuserDetail(Request $request) {
        $user       =       Auth::user();
        $validator      =            Validator::make($request->all(),
            [
                'name' =>         'required',
                'gambar' =>         'required',
                'no_hp' =>         'required',
            ]
        );

        if ($request->file('gambar')) {
            //store file into document folder
            $gambar2 = Str::slug($request->gambar);
            $extention = $request->gambar->getClientOriginalExtension();
            $file_name = time().'.'.$extention;
            $txt = 'storage/images/'. $file_name;
            $request->gambar->storeAs('public/images', $file_name);
            $input = $txt;
        }else{
            $input = $user->gambar;
        }

        $inputData      =       array(
            'name' =>         $request->name,
            'gambar' =>       $input,
            'no_hp' =>        $request->no_hp, 
        );
        $userdetail      =   User::where('id', $user->id)->update($inputData);
    
        if($userdetail == 1) {
            return new UserResource(User::find($user->id));
        }

        else {
            $success['error']      =       true;
            $success['message']     =       "Failed to update the task please try again";
        } 
        return response()->json($success);
    }
}
