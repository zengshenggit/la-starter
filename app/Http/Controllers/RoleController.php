<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Role $role)
    {
        $data = $role->paginate($request->limit);
        return response()->json(['code' => 0, 'msg' => '', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role)
    {
        $data = $request->all();
        $validator = $this->getValidationFactory()->make($data, [
            'name' => 'required|string|unique:roles'
        ]);
        if ($validator->fails()) {
            return response()->json(['code' => 1001, 'msg' => $validator->errors()->first()]);
        }
        $role->name = $data['name'];
        $role->remark = $data['remark'] ?? '';
        if (!$role->save()) {
            return response()->json(['code' => 1002, '操作失败']);
        }
        return response()->json(['code' => 0, 'msg' => '操作成功']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->all();
        $validator = $this->getValidationFactory()->make($data, [
            'name' => 'sometimes|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['code' => 1001, 'msg' => $validator->errors()->first()]);
        }
        $role->name = $data['name'] ?? $role->name;
        $role->remark = $data['remark'] ?? $role->remark;
        if (!$role->save()) {
            return response()->json(['code' => 1002, '操作失败']);
        }
        return response()->json(['code' => 0, 'msg' => '操作成功']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
