<?php
namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserHelper
{
    public static function checkToken($token)
    {
        if($token) {
            $last_used = Carbon::parse($token->last_used_at);
            $current_used = Carbon::parse(date("Y-m-d H:i:s", strtotime('now')));
            if($last_used->diffInMinutes($current_used) > 30) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getId($bearer)
    {
        $token = DB::table('personal_access_tokens')
            ->select('tokenable_id', 'last_used_at')
            ->where('token', Hash('sha256', $bearer))->first();

        $checkToken = self::checkToken($token);
        if(!$checkToken) {
            return response()->json([
                'success' => false,
                'message' => 'Access Denied'
            ], 422);
        }
        return $token->tokenable_id;
    }

    public static function getUser($bearer)
    {
        $user_id = self::getId($bearer);
        $user = User::find($user_id);
        return $user;
    }

    public static function tambahUser($request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return $user;
    }
}

?>
