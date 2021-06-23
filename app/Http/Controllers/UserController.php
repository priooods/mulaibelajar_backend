<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
            'level' => 'required',
            'no_hp' => 'required|int',
        ]);

        if($validator->fails()){
            return response()->json([
                'error_code' => 1,
                'message' => $validator->errors()
            ], 200);
        }

        if ($request->image!=null){
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $filename = 'avatar_'.$request->username.'_'.$file->getClientOriginalName();
                $path = $file->move(public_path('avatar'), $filename);
                $request['avatar'] = $filename;
            }else
                return $this->resFailed("3","avatar file extention not supported!");
        }

        $request['password'] = Hash::make($request->get('password'));
        $user = User::create($request->all());
        $token = JWTAuth::fromUser($user);

        return $this->resSuccess(compact('user','token'),201);
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error_code' => 1,'message' => 'invalid credentials'], 200);
            }
        } catch (JWTException $e) {
            return response()->json(['error_code' => 1,'message' => 'could not create token'], 200);
        }
        
        return response()->json(['error_code' => 0,'message' => '', 'token' => $token]);
    }

    public function show(){
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 200);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getCode());
        }
        return $this->resSuccess($user->get());
    }

    public function userall(){
        return $this->resSuccess(User::all());
    }
}
