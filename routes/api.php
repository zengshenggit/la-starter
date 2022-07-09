<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('auth/user', [AuthController::class, 'user']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
});

Route::get('menus', function() {
    $data =  [
        [
            'id' => 1,
            'pid' => 0,
            'name' => '工作台',
            'route' => 'index-dashboard',
            'icon' => 'HomeOutlined'
        ],
        [
            'id' => 2,
            'pid' => 0,
            'name' => '订单管理',
            'icon' => 'UnorderedListOutlined',
            'children' => [
                [
                    'id' => 3,
                    'pid' => 2,
                    'name' => '本地生活订单',
                    'route' => 'index-orders',
                ]
            ]
        ]
    ];
    return response()->json(['code' => 0, 'msg' => '', 'data' => $data]);
});

Route::get('coupons', function() {
    $data = DB::table('coupons')->paginate();
    return response()->json(['code' => 0, 'msg' => '', 'data' => $data]);
});





