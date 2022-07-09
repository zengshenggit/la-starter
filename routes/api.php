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
            'icon' => 'icon-home-1'
        ],
        [
            'id' => 2,
            'pid' => 0,
            'name' => '商户管理',
            'icon' => 'icon-merchant-2',
            'description' => '可进行商户相关操作',
            'children' => [
                [
                    'id' => 3,
                    'pid' => 2,
                    'name' => '商户信息',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 4,
                    'pid' => 2,
                    'name' => '代理商信息',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 5,
                    'pid' => 2,
                    'name' => '品牌管理',
                    'route' => 'index-orders',
                ],
            ]
        ],
        [
            'id' => 6,
            'pid' => 0,
            'name' => '店铺管理',
            'icon' => 'icon-store-2',
            'description' => '可进行店铺相关操作',
            'children' => [
                [
                    'id' => 7,
                    'pid' => 6,
                    'name' => '本地生活店铺',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 8,
                    'pid' => 6,
                    'name' => '餐饮店铺',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 9,
                    'pid' => 6,
                    'name' => '网格厅店铺',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 10,
                    'pid' => 6,
                    'name' => '体育馆店铺',
                    'route' => 'index-orders',
                ],
            ]
        ],
        [
            'id' => 11,
            'pid' => 0,
            'name' => '审核管理',
            'icon' => 'icon-verify',
            'description' => '可进行审核相关操作',
            'children' => [
                [
                    'id' => 12,
                    'pid' => 11,
                    'name' => '店铺审核',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 13,
                    'pid' => 11,
                    'name' => '优惠券审核',
                    'route' => 'index-orders',
                ]
            ]
        ],
        [
            'id' => 16,
            'pid' => 0,
            'name' => '优惠买单',
            'icon' => 'icon-buy',
            'route' => 'index-orders',
            'description' => '可进行优惠买单相关操作',
            'children' => [
                [
                    'id' => 33,
                    'pid' => 16,
                    'name' => '优惠买单列表',
                    'route' => 'index-orders',
                ],
            ]
        ],
        [
            'id' => 19,
            'pid' => 0,
            'name' => '订单管理',
            'icon' => 'icon-orders',
            'description' => '可进行订单相关操作',
            'children' => [
                [
                    'id' => 20,
                    'pid' => 19,
                    'name' => '优惠券订单',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 21,
                    'pid' => 19,
                    'name' => '优惠买单订单',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 22,
                    'pid' => 19,
                    'name' => '餐饮订单',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 23,
                    'pid' => 19,
                    'name' => '体育馆订单',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 24,
                    'pid' => 19,
                    'name' => '预付卡订单',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 25,
                    'pid' => 19,
                    'name' => '卡密券订单',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 26,
                    'pid' => 19,
                    'name' => '抵扣券订单',
                    'route' => 'index-orders',
                ],
            ]
        ],
        [
            'id' => 11,
            'pid' => 0,
            'name' => '优惠券管理',
            'icon' => 'icon-coupon',
            'description' => '可进行优惠券相关操作',
            'children' => [
                [
                    'id' => 12,
                    'pid' => 11,
                    'name' => '优惠券列表',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 13,
                    'pid' => 11,
                    'name' => '优惠券评价',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 14,
                    'pid' => 11,
                    'name' => '卡密优惠券批次',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 15,
                    'pid' => 11,
                    'name' => '卡密券列表',
                    'route' => 'index-orders',
                ],
            ]
        ],
        [
            'id' => 16,
            'pid' => 0,
            'name' => '预付卡管理',
            'description' => '可进行预付卡相关操作',
            'icon' => 'icon-card',
            'children' => [
                [
                    'id' => 17,
                    'pid' => 16,
                    'name' => '预付卡列表',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 18,
                    'pid' => 16,
                    'name' => '预付卡商户',
                    'route' => 'index-orders',
                ],
            ]
        ],
        [
            'id' => 27,
            'pid' => 0,
            'name' => '系统管理',
            'icon' => 'icon-system',
            'description' => '可进行系统相关操作',
            'children' => [
                [
                    'id' => 28,
                    'pid' => 27,
                    'name' => '权限组管理',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 29,
                    'pid' => 27,
                    'name' => '权限管理',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 30,
                    'pid' => 27,
                    'name' => '角色管理',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 31,
                    'pid' => 27,
                    'name' => '用户管理',
                    'route' => 'index-orders',
                ],
                [
                    'id' => 32,
                    'pid' => 27,
                    'name' => '日志管理',
                    'route' => 'index-orders',
                ],
            ]
        ],
    ];
    return response()->json(['code' => 0, 'msg' => '', 'data' => $data]);
});

Route::get('coupons', function() {
    $data = DB::table('coupons')->paginate();
    return response()->json(['code' => 0, 'msg' => '', 'data' => $data]);
});





