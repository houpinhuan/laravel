<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Auth;

class CheckRbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //RBAC鉴权
        /*if(Auth::guard('admin') -> user() -> role_id != '1'){
            //获取当前的路由 App\Http\Controllers\Admin\IndexController@index
            $route = Route::currentRouteAction();
            $routeArr = explode('\\', $route);//分割，一个反斜杠带转译功能
            $routeArr = strtolower(end($routeArr));//获得\后面最后一个字段，并且都转化成小写
            //获取当前用户对应的角色已经具备的权限，注意例外
            $ac = Auth::guard('admin') -> user() -> role -> auth_ac;//关联role模型
            $ac .=",indexcontroller@index,indexcontroller@welcome"; //记得统一大小写
            //判断权限
            if (strpos($ac, $routeArr) === false) {
                exit("<h1>您没有访问权限！</h1>");
            }
        }*/
        
        //继续后续请求
        return $next($request);
    }
}
