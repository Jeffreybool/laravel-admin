<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Transformers\RoleTransformer;
use App\Http\Controllers\Api\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RoleController extends Controller
{

    /**
     * 获取角色列表 (分页)
     * @param Request $request
     * @param Role    $role
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request, Role $role)
    {
        $model = $role->query();
        $querys = $this->ignoreReserved($request->all());
        foreach ($querys as $key=>$query){
            if ($query){
                if ($key == 'name'){
                    $model = $model->where($key,'like','%'.$query.'%');
                }else{
                    $model = $model->where($key,$query);
                }
            }
        }
        $roles = $model->paginate();
        return $this->response->paginator($roles, new RoleTransformer());
    }


    /**
     * 获取全部角色列表
     * @param Role $role
     * @return \Dingo\Api\Http\Response
     */
    public function list(Role $role)
    {
        $roles = $role->get();

        return $this->response->collection($roles, new RoleTransformer());
    }


    /**
     * 新建角色.
     * @param Request $request
     * @param Role    $role
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request, Role $role)
    {
        $this->validateRequest($request);
        $permission_ids = $request->get("permission_ids");
        if(!is_null($permission_ids))$this->permissionExist($permission_ids);

        $role->fill($request->all());
        $role->save();

        $role->permissions()->attach($request->get("permission_ids"));

        return $this->response->item($role, new RoleTransformer())->setStatusCode(201);
    }


    /**
     * 获取某个角色信息.
     * @param Request $request
     * @param Role    $role
     * @return \Dingo\Api\Http\Response
     */
    public function show(Request $request,Role $role)
    {
        return $this->response->item($role,new RoleTransformer())->setStatusCode(200);
    }


    /**
     * 更新角色信息.
     * @param Request $request
     * @param Role    $role
     * @return \Dingo\Api\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validateRequest($request,'update');
        $permission_ids = $request->get("permission_ids");
        if(!is_null($permission_ids))$this->permissionExist($permission_ids);
        $role->fill($request->all());
        $role->save();
        $role->permissions()->sync($permission_ids);

        return $this->response->noContent();
    }

    /**
     * @param array $permission_ids
     */
    protected function permissionExist(array $permission_ids): void
    {
        collect($permission_ids)->map(function($item, $key) {
            if(!app(Permission::class)->find($item)) {
                throw new HttpException(422, "权限id不存在");
            }
        });
    }

    /**
     * 删除角色以及对应的权限
     * @param Request $request
     * @param Role    $role
     * @return \Dingo\Api\Http\Response
     * @throws \Exception
     */
    public function delete(Request $request,Role $role)
    {
        $role->permissions()->detach();
        $role->delete();
        return $this->response->noContent();
    }
}
