<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();
        $validator = $this->getValidationFactory()->make($data, [
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha_api:'. $data['key'] ?? '' . ',math',
        ]);
        if ($validator->fails()) {
            $msg = $validator->errors()->has('captcha') ? '验证码错误' : '用户名或密码不能为空';
            return response()->json(['code' => 40001, 'msg' => $msg]);
        }
        $user = User::where('email', $data['username'])->first();
        if (!$user or !Hash::check($data['password'], $user->password)) {
            return response()->json(['code' => 40001, 'msg' => '用户名或密码错误']);
        }
        $token = $user->createToken($user->phone ?? $user->email)->plainTextToken();
        return response()->json(['code' => 0, 'msg' => '', 'data' => compact('token')]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['code' => 0, 'msg' => '']);
    }
}
