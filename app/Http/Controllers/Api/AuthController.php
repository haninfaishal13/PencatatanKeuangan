<?php

namespace App\Http\Controllers\Api;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->only('email', 'password'), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
        }
        $credentials = $request->only('email', 'password');
        if(auth()->attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('tokenKeuangan')->plainTextToken;
            DB::table('personal_access_tokens')
                ->where('token', Hash('sha256', substr($token, strpos($token, "|") + 1)))
                ->update([
                    'last_used_at'=>date("Y-m-d H:i:s", strtotime('now')),
            ]);
            return (new UserResource($user))->additional([
                'token' => substr($token, strpos($token, "|") + 1),
            ]);
        }
        return response()->json([
            'success' => false,
            'code' => 100,
            'message' => 'Email atau password salah'
        ], 400);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'unique:users,email'],
            'name' => ['required'],
            'password' => ['required']
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422);
        }
        $user = UserHelper::tambahUser($request);
        $token = $user->createToken('tokenKeuangan')->plainTextToken;
        return (new UserResource($user))->additional([
            'token' => substr($token, strpos($token, "|") + 1),
        ]);
    }

    public function logout(Request $request)
    {
        $bearer = $request->bearerToken();
        DB::table('personal_access_tokens')->where('token',Hash('sha256', $bearer))->delete();
        return response()->json([
            'success' => true,
            'message' => 'Sukses Logout'
        ]);
    }

    public function checkToken()
    {
        return response()->json([
            'success' => true,
            'message' => 'Token active'
        ]);
    }
}
