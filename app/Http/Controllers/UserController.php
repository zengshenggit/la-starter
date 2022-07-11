<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $data = $user->paginate($request->limit);
        return response()->json(['code' => 0, 'msg' => '', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //echo hash('sha256', '_1');
        //die;
        $data = $request->all();
        $validator = $this->getValidationFactory()->make($data, [
            'name' => 'required|string|unique:users',
            'password' => 'required|string|confirmed',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json(['code' => 1001, 'msg' => $validator->errors()->first()]);
        }
        $data['password'] = Hash::make($data['password']);
        if (!$user->create($data)) {
            return response()->json(['code' => 1002, 'msg' => '操作失败']);
        }
        return response()->json(['code' => 0, 'msg' => '操作成功']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $validator = $this->getValidationFactory()->make($data, [
            'name' => 'sometimes|string',
            'email' => 'sometimes|email',
            'phone' => 'sometimes|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['code' => 1001, 'msg' => $validator->errors()->first()]);
        }
        if (!$user->update($data)) {
            return response()->json(['code' => 1002, 'msg' => '操作失败']);
        }
        return response()->json(['code' => 0, 'msg' => '操作成功']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
