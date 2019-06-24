<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/8/28
 * Time: 13:07
 */

namespace App\Transformers;

use App\Models\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $role)
    {
        return [
            'id'         => $role->id,
            'name'       => $role->name,
            'remark'     => $role->remark,
            'status'     => $role->status,
            'created_at' => $role->created_at->diffForHumans(),
            'updated_at' => $role->updated_at->diffForHumans(),
            'permissions'=> make_tree($role->permissions->toArray(),0)
        ];
    }
}