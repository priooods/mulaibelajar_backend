<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
            'fullname' => 'required',
            'level' => 'required',
            'no_hp' => 'required|int',
        ]);

        if($validator->fails()){
            return response()->json([
                'error_code' => 1,
                'message' => $validator->errors()
            ], 200);
        }

        $request['password_verified'] = Crypt::encrypt($request['password']);
        $request['password'] = Hash::make($request->get('password'));
        $user = User::create($request->all());
        $token = JWTAuth::fromUser($user);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $user->id . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('avatar'), $filename);
            $user->update(['avatar' => $filename]);
        }

        return $this->resUserSuccess(compact('user','token'),201);
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->resFailed(1,"invalid credentials");
            }
        } catch (JWTException $e) {
            return $this->resFailed(1,"could not create token");
        }
        
        return response()->json(['error_code' => 0,'message' => '', 'token' => $token]);
    }


    public function update(Request $request){
        if ($validate = $this->validing($request->all(),[
            'token' => 'required',
        ]))
            return $validate;

        $user = User::find(Auth::user()->id);
        if ($request->avatar != null){
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $filename = $user->id . '_' . $file->getClientOriginalName();
                if ($user->avatar) {
                    $file_loc = public_path('avatar/') . $user->avatar;
                    unlink($file_loc);
                }
                $path = $file->move(public_path('avatar'), $filename);
                $user->avatar = $request->avatar = $filename;
            }
        }
        if (!is_null($request->password)) $user->password_verified = Crypt::encrypt($request->password);
        if (!is_null($request->fullname)) $user->fullname = $request->fullname;
        if (!is_null($request->password)) $user->password = Hash::make($request->password);
        if (!is_null($request->username)) $user->username = $request->username;
        if (!is_null($request->no_hp)) $user->no_hp = $request->no_hp;
        if (!is_null($request->level)) $user->level = $request->level;
        if (!is_null($request->email)) $user->email = $request->email;
        $user->update();
        return $this->resUserSuccess($user);
    }

    public function me(){
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
        return $this->resUserSuccess($user->get());
    }

    public function delete(){
        $db = Auth::user();
        $user = User::where('username', $db->username)->first();
        if (!$user){
            return response()->json([
                'error_code' => '1',
                'error_message' => 'Pengguna tidak ditemukan!',
            ]);
        }
        $file_loc = public_path('avatar/') . $user->avatar;
        unlink($file_loc);
        $user->delete();
        return $this->resSuccess("Pengguna berhasil di hapus");
    }

    public function all(){
        return $this->resUserSuccess(User::all());
    }
}
