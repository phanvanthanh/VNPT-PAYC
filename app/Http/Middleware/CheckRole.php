<?php
/*
    Chú ý: Check role này phải khai báo trong kernel.php
    protected $routeMiddleware = [
        'check-role' => \App\Http\Middleware\CheckRole::class,
    ];
*/

namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Support\Facades\Route;
use App\Modules\TaiNguyen\Models\AdminResource;
use Illuminate\Support\Facades\Auth;
use DB;

class CheckRole
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
        $userId = Auth::id();
        /*$currentAction=Route::getCurrentRoute()->getActionName();
        $currentMethods=Route::getCurrentRoute()->methods()[0];

        $checkPermissionResource = AdminResource::where('admin_resource.action', '=', $currentAction)
        ->where('admin_resource.method','=',$currentMethods)
        ->where('users.id','=',$userId)
        ->join('admin_rule', 'admin_resource.id', '=', 'admin_rule.resource_id')
        ->join('users', 'admin_rule.role_id', '=', 'users.role_id')
        ->get()->toArray();
        if(count($checkPermissionResource)<=0){
            if(!Auth::check()){
                die(var_dump(Auth::check()));
                return redirect()->intended('/');    
            }            
            echo 'Bạn không có quyền truy cập địa chỉ này <a href="/">quay lại</a>';
            exit();
        }*/
        return $next($request);
    }
}

