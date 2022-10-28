<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Models\media;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\RegisterCode;
use App\Models\UserMeta;

class UserController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        $user->role()->sync(2);
        $new_code_register = new RegisterCode();
        $new_code_register->user_id = $user->id;
        $new_code_register->code = random_int(10000, 99999);
        $new_code_register->save();
        // $token = $user->createToken('myapptoken')->plainTextToken;
        SendEmail::dispatch($new_code_register->code,$user->email)->delay(now()->addMinute(1));

        $response = [
            'url' => env('APP_URL'),
            'user' => $user,
            'success' => true,
            'message' => "Enter the code to complete the registration",
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        // Check email
        $user = User::with('media','user_meta')->where('email', $fields['email'])->first();
        if($user && !$user->email_verified_at){
            if($user->register_code){
                SendEmail::dispatch($user->register_code->code,$user->email)->delay(now()->addMinute(1));
            }else{
                $new_code_register = new RegisterCode();
                $new_code_register->user_id = $user->id;
                $new_code_register->code = random_int(10000, 99999);
                $new_code_register->save();
                SendEmail::dispatch($new_code_register->code,$user->email)->delay(now()->addMinute(1));
            }
           
            $response = [
                'url' => env('APP_URL'),
                'user' => $user,
                'success' => true,
                'message' => "Enter the code to complete the registration",
            ];
            return response($response, 201);
        }
        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'url' => env('APP_URL'),
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        $a = Auth::user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
    public function CheckRegisterCode(Request $request) {
        $fields = $request->validate([
            'user_id' => 'required',
            'email' => 'required|string',
            'code' => 'required',
        ]);

        $user = User::with('media','user_meta')->find($fields['user_id']);
        // return response($user, 201);
        if($user->register_code){
            if((int)$user->register_code->code == (int)$fields['code']){
                $user->email_verified_at = now();
                $user->save();
                $user->register_code->delete();
                
                $token = $user->createToken('myapptoken')->plainTextToken;
                $response = [
                    'url' => env('APP_URL'),
                    'user' => $user,
                    'token' => $token
                ];
                return response($response, 201);

            }else{
                return response([
                    'message' => 'The code is not correct'
                ], 401);
            }
        }else{
            return response([
                'message' => 'Bad creds'
            ], 401);
        }
    }
    public function createEditAvatar(Request $request){
        $image = $request['avatar']? $request['avatar']:'';
        $folder = 'avatar';
        $user = User::with('media','user_meta')->where('id','=',$request['user_id'])->first();
        if($user && $image ){
            $media = $user->media;
            if($image){
                $avatar = UploadImgApp($image,$folder);
            }else{
                $avatar = null;
            }
            if($media){
                
                $media -> url = 'storage/'.$avatar;
                $media -> save();
            }else{
                $new_media = new media();
                $new_media->user_id = $request['user_id'];
                $new_media -> type = 0;
                $new_media ->type_media = 'avatar';
                $new_media ->url = 'storage/'.$avatar;
                $new_media -> save();
            }
            $user = User::with('media','user_meta')->where('id','=',$request['user_id'])->first();
            return response($user, 201);
        }
        
    }
    public function updateUser(Request $request)
    {
       $request->validate([
            'name' => 'required|string',
            'gender' => 'required'
        ]);

        $user = User::find($request['user_id']);
        if($user){
            $user->name = $request['name'];
            $user->gender = $request['gender'];
            $user->save();
        }
        $check = $this->checkAndUpdateUserMeta($request);
        if($check){
            $user = User::with('media','user_meta')->find($request['user_id']);
            return response($user, 201);
        }
        
    }
    public function checkAndUpdateUserMeta($request){
        if($request['birthday']){
            $check_bth = UserMeta::Where('user_id',$request['user_id'])->where('meta_field','birthday')->first();
            if( $check_bth){
                $check_bth->meta_value = $request['birthday'];
            }else{
                $new_meta = new UserMeta();
                $new_meta -> user_id = $request['user_id'];
                $new_meta -> meta_field = 'birthday';
                $new_meta -> meta_value = $request['birthday'];
                $new_meta ->save();
            }
        }
        if($request['address']){
            $check_bth = UserMeta::Where('user_id',$request['user_id'])->where('meta_field','address')->first();
            if( $check_bth){
                $check_bth->meta_value = $request['address'];
            }else{
                $new_meta = new UserMeta();
                $new_meta -> user_id = $request['user_id'];
                $new_meta -> meta_field = 'address';
                $new_meta -> meta_value = $request['address'];
                $new_meta ->save();
            }
        }
        return true;
    }
}
