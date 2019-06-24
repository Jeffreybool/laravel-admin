<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/11/4
 * Time: 22:25
 */

namespace App\Transformers;

use App\Models\Admin;
use League\Fractal\TransformerAbstract;

class AdminTransformer extends TransformerAbstract
{

    /**
     * @var array
     */
    protected $availableIncludes = ['role'];

    /**
     * @param Admin $admin
     * @return array
     */
    public function transform(Admin $admin)
    {
        return [
            'id'              => $admin->id,
            'name'            => $admin->name,
            'email'           => $admin->email,
            'avatar'           => $admin->avatar,
            'login_count'     => $admin->login_count,
            'create_ip'       => $admin->create_ip,
            'last_login_ip'   => $admin->last_login_ip,
            'last_actived_at' => $admin->last_actived_at,
            'status'          => $admin->status,
            'role_id'         => $admin->role_id,
            'created_at'      => $admin->created_at->diffForHumans(),
            'updated_at'      => $admin->updated_at->diffForHumans(),
        ];
    }

    /**
     * @param Admin $admin
     * @return \League\Fractal\Resource\Item
     */
    public function includeRole(Admin $admin)
    {
        if ($admin->role){
            return $this->item($admin->role, new RoleTransformer());
        }
    }
}