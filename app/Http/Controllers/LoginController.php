<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginOffice(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            $token = $user->createToken('token-frontend-office');
            return response()->success([
                'token' => $token->plainTextToken,
                'name' => $user->name
            ]);
        }
        return response()->error(['Username หรือ รหัสผ่านไม่ถูกต้อง'], '2');
    }

    public function logoutOffice(Request $request)
    {
        if($request->has('all')){
            return response()->success([
                'logout' => $request->user()->tokens()->delete(),
            ]);
        }
        return response()->success([
            'logout' => $request->user()->currentAccessToken()->delete(),
        ]);
    }

    public function info(Request $request)
    {
        return response()->success($request->user());
    }

}
