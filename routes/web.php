<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//后台路由部分（不需要权限判断)
Route::group(['prefix' => 'admin'],function(){
	//后台登录页面
	Route::get('public/login','Admin\PublicController@login') -> name('login');
	//后台登陆处理页面
	Route::post('public/check','Admin\PublicController@check');
	//退出地址
	Route::get('public/logout','Admin\PublicController@logout');
});

//后台路由部分（需要权限判断)
Route::group(['prefix' => 'admin','middleware' => ['auth:admin','rbac']],function(){

	//后台首页路由
	Route::get('index/index', function () { return view('admin.index.index'); });
	Route::get('index/welcome', function () { return view('admin.index.welcome'); });

    //异步头像上传
    Route::post('/uploader/webuploader','Admin\Uploader\UploaderController@webuploader');

	//角色的管理模块
	Route::get('/role/index','Admin\RoleController@index');
	Route::any('/role/assign','Admin\RoleController@assign');

	//用户的管理模块
    Route::get('/user/user/index','Admin\User\UserController@index');
    Route::get('/user/user/auth','Admin\User\UserController@auth');//审核情况
    Route::post('/user/user/status','Admin\User\UserController@status');//修改用户状态
    Route::any('/user/user/update','Admin\User\UserController@update');
    Route::get('/user/user/info','Admin\User\UserController@info');//用户信息
    Route::get('/user/user/accountBind','Admin\User\UserController@accountBind');//用户提现绑定信息
    Route::get('/user/user/package','Admin\User\UserController@package');//套餐购买
    Route::get('/user/user/invite','Admin\User\UserController@invite');//用户邀请详情
    //用户审核
    Route::get('/user/userAuthApply/index','Admin\User\UserAuthApplyController@index');
    Route::any('/user/userAuthApply/auth','Admin\User\UserAuthApplyController@auth');//审核用户
    //用户资产
    Route::get('/user/userAssetLog/index','Admin\User\UserAssetLogController@index');

    //类目的管理模块
    Route::get('/category/index','Admin\Category\CategoryController@index');
    Route::any('/category/add','Admin\Category\CategoryController@add');
    Route::any('/category/update','Admin\Category\CategoryController@update');
    Route::get('/category/option','Admin\Category\CategoryController@option');

    //发类的管理模块
    Route::get('/hairstyle/index','Admin\Hairstyle\HairstyleController@index');
    Route::any('/hairstyle/update','Admin\Hairstyle\HairstyleController@update');
    Route::any('/hairstyle/add','Admin\Hairstyle\HairstyleController@add');

    //门店的管理模块
    Route::get('/store/store/index','Admin\Store\StoreController@index');
    Route::post('/store/store/status','Admin\Store\StoreController@status');//修改门店状态
    Route::get('/store/store/auth','Admin\Store\StoreController@auth');//门店审核
    Route::get('/store/store/asset','Admin\Store\StoreController@asset');//门店资产
    Route::any('/store/store/update','Admin\Store\StoreController@update');
    Route::any('/store/store/add','Admin\Store\StoreController@add');
    Route::get('/store/store/info','Admin\Store\StoreController@info');//门店信息
    Route::get('/store/store/nexus0','Admin\Store\StoreController@nexus0');//门店入驻量
    Route::get('/store/store/nexus1','Admin\Store\StoreController@nexus1');//门店签约量
    Route::get('/store/store/service','Admin\Store\StoreController@service');//门店服务量
    Route::get('/store/store/nexus','Admin\Store\StoreController@nexus');//门店-美发师
    //门店的审核模块
    Route::get('/store/storeAuthApply/index','Admin\Store\StoreAuthApplyController@index');
    Route::any('/store/storeAuthApply/auth','Admin\Store\StoreAuthApplyController@auth');//门店审核

    //美发师的管理模块
    Route::get('/stylist/stylist/index','Admin\Stylist\StylistController@index');
    Route::any('/stylist/stylist/update','Admin\Stylist\StylistController@update');
    Route::get('/stylist/stylist/auth','Admin\Stylist\StylistController@auth');//美发师审核
    Route::get('/stylist/stylist/asset','Admin\Stylist\StylistController@asset');//美发师资产
    Route::get('/stylist/stylist/time','Admin\Stylist\StylistController@time');//时间信息
    Route::get('/stylist/stylist/locktime','Admin\Stylist\StylistController@locktime');//锁定时间
    Route::get('/stylist/stylist/stylistCount','Admin\Stylist\StylistController@stylistCount');//累计评价
    Route::get('/stylist/stylist/service','Admin\Stylist\StylistController@service');//美发师服务量
    Route::get('/stylist/stylist/coupon','Admin\Stylist\StylistController@coupon');//优惠券
    Route::get('/stylist/stylist/setting','Admin\Stylist\StylistController@setting');//美发师-门店
    Route::get('/stylist/stylist/couponDay','Admin\Stylist\StylistController@couponDay');//优惠券-查看日志
    Route::get('/stylist/stylist/package','Admin\Stylist\StylistController@package');//套餐券
    Route::get('/stylist/stylist/packageContent','Admin\Stylist\StylistController@packageContent');//套餐券-查看内容
    Route::get('/stylist/stylist/serviceInfo','Admin\Stylist\StylistController@serviceInfo');//服务
    Route::post('/stylist/stylist/serviceStatus','Admin\Stylist\StylistController@serviceStatus');//服务状态更改
    Route::get('/stylist/stylist/serviceOption','Admin\Stylist\StylistController@serviceOption');
    //美发师的审核模块
    Route::get('/stylist/stylistAuthApply/index','Admin\Stylist\StylistAuthApplyController@index');
    Route::any('/stylist/stylistAuthApply/auth','Admin\Stylist\StylistAuthApplyController@auth');

    //脸型的管理模块
    Route::get('/feature/index','Admin\Feature\FeatureController@index');
    Route::any('/feature/add','Admin\Feature\FeatureController@add');
    Route::any('/feature/update','Admin\Feature\FeatureController@update');

    //奖励的管理模块
    Route::get('/reward/register','Admin\Reward\RewardController@register');//注册奖励
    Route::get('/reward/invite','Admin\Reward\RewardController@invite');//邀请奖励
    Route::get('/reward/consume','Admin\Reward\RewardController@consume');//消费奖励
    Route::get('/reward/binvite','Admin\Reward\RewardController@binvite');//被邀请奖励

    //订单管理
    Route::get('/order/order/one','Admin\Order\OrderController@one');//待处理
    Route::get('/order/order/two','Admin\Order\OrderController@two');//待完成
    Route::get('/order/order/three','Admin\Order\OrderController@three');//已完成
    Route::get('/order/order/four','Admin\Order\OrderController@four');//退款
    Route::get('/order/order/five','Admin\Order\OrderController@five');//已评价
    Route::get('/order/order/pay','Admin\Order\OrderController@pay');//订单支付
    Route::get('/order/order/refund','Admin\Order\OrderController@refund');//订单退单
    Route::get('/order/order/addMoney','Admin\Order\OrderController@addMoney');//订单退单
    Route::get('/order/order/storeReviews','Admin\Order\OrderController@storeReviews');//订单-门店评论
    Route::get('/order/order/stylistReviews','Admin\Order\OrderController@stylistReviews');//订单-美发师评论

    //代币管理
    Route::get('/coin/index','Admin\Coin\CoinController@index');

    //营销活动
    Route::get('/coupon/index','Admin\Coupon\CouponController@index');
    Route::any('/coupon/add','Admin\Coupon\CouponController@add');
    Route::any('/coupon/update','Admin\Coupon\CouponController@update');
    Route::post('/coupon/status','Admin\Coupon\CouponController@status');
    Route::get('/coupon/day','Admin\Coupon\CouponController@day');//优惠券每日详情

    //反馈投诉
    Route::get('/user/userFeedback/index','Admin\User\UserFeedbackController@index');//反馈列表
    Route::get('/order/complaintOrder/index','Admin\Order\ComplaintOrderController@index');//投诉列表
    Route::get('/order/complaintOrder/complaint','Admin\Order\ComplaintOrderController@complaint');//投诉内容

    //提现管理
    Route::get('/user/userTake/handle','Admin\User\UserTakeController@handle');//已拒绝-已完成
    Route::get('/user/userTake/apply','Admin\User\UserTakeController@apply');//申请中
    Route::any('/user/userTake/auth','Admin\User\UserTakeController@auth');//审核申请
    Route::any('/user/userTake/finish','Admin\User\UserTakeController@finish');//导出已完成数据
    Route::any('/user/userTake/export','Admin\User\UserTakeController@export');//导出处理中数据

    //数据字典
    Route::get('/dataConf/index','Admin\DataConf\DataConfController@index');
    Route::any('/dataConf/add','Admin\DataConf\DataConfController@add');
    Route::any('/dataConf/update','Admin\DataConf\DataConfController@update');

    //代理管理
    Route::get('/agency/agencyOrder/index','Admin\Agency\OrderController@index');
    Route::any('/agency/agencyOrder/auth','Admin\Agency\OrderController@auth');//审核
    //代理配置
    Route::get('/agency/agencySetting/index','Admin\Agency\SettingController@index');
    Route::any('/agency/agencySetting/update','Admin\Agency\SettingController@update');
    // 代理管理--用户列表
    Route::get('/agency/user/index', 'Admin\Agency\UserController@index');
    Route::any('/agency/user/reset', 'Admin\Agency\UserController@reset');
    Route::get('/agency/user/asset', 'Admin\Agency\UserController@asset');
    Route::get('/agency/user/accountBind', 'Admin\Agency\UserController@accountBind');
    // 代理管理--用户提现
    Route::get('/agency/userTake/index', 'Admin\Agency\UserTakeController@index');
    Route::any('/agency/userTake/auth', 'Admin\Agency\UserTakeController@auth');
    Route::any('/agency/userTake/export', 'Admin\Agency\UserTakeController@export');
    // 代理管理--代理区域
    Route::get('/agency/area/index', 'Admin\Agency\AreaController@index');
    Route::any('/agency/area/add', 'Admin\Agency\AreaController@add');
    Route::any('/agency/area/update', 'Admin\Agency\AreaController@update');
    // 代理管理--代理区域
    Route::get('/agency/agencyLog/index', 'Admin\Agency\AgencyLogController@index');

    // 系统管理--菜单管理
    Route::get('/system/menu/index', 'Admin\System\MenuController@index');
    Route::any('/system/menu/add', 'Admin\System\MenuController@add');
    Route::any('/system/menu/update', 'Admin\System\MenuController@update');

    // 系统管理--系统管理
    Route::get('/system/permission/index', 'Admin\System\PermissionController@index');
    Route::any('/system/permission/add', 'Admin\System\PermissionController@add');
    Route::any('/system/permission/update', 'Admin\System\PermissionController@update');

    // 系统管理--角色管理
    Route::get('/system/role/index', 'Admin\System\RoleController@index');
    Route::any('/system/role/add', 'Admin\System\RoleController@add');
    Route::any('/system/role/update', 'Admin\System\RoleController@update');

    // 系统管理--管理员管理
    Route::get('/system/manager/index', 'Admin\System\ManagerController@index');
    Route::any('/system/manager/add', 'Admin\System\ManagerController@add');
    Route::any('/system/manager/update', 'Admin\System\ManagerController@update');

    // 系统管理--角色菜单
    Route::get('/system/rolemenu/index', 'Admin\System\RoleMenuController@index');
    Route::any('/system/rolemenu/add', 'Admin\System\RoleMenuController@add');
    Route::any('/system/rolemenu/update', 'Admin\System\RoleMenuController@update');

    // 系统管理--角色权限
    Route::get('/system/rolepermission/index', 'Admin\System\RolePermissionController@index');
    Route::any('/system/rolepermission/add', 'Admin\System\RolePermissionController@add');
    Route::any('/system/rolepermission/update', 'Admin\System\RolePermissionController@update');

});



