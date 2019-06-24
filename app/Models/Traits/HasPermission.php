<?php

namespace App\Models\Traits;

use Auth;

trait HasPermission
{

    /**
     * 检验权限
     * @param $route
     * @return bool
     */
    public function checkPermission($route)
    {
        //获取用户角色验证权限.
        $user = Auth::guard('admin')->user();
        if($user::getRole() && in_array($user::getRole()->id, config('permission.WHITE_ROLES'))) {
            return true;
        }

        return in_array($route, $user->getAllPermissions()->pluck('route')->toArray());
    }

}