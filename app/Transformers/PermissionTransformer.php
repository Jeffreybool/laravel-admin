<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/8/29
 * Time: 00:17
 */

namespace App\Transformers;

use App\Models\Permission;
use League\Fractal\TransformerAbstract;

class PermissionTransformer extends TransformerAbstract
{
    public function transform(Permission $permission)
    {
        return [
            'id'          => $permission->id,
            'name'        => $permission->name,
            'route'       => $permission->route,
            'parent_id'   => $permission->parent_id,
            'is_hidden'   => $permission->is_hidden,
            'sort'        => $permission->sort,
            'status'      => $permission->status,
            'created_at'  => $permission->created_at->diffForHumans(),
            'updated_at'  => $permission->updated_at->diffForHumans(),
        ];
    }
}