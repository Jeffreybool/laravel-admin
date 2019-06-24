<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Transformers\PermissionTransformer;

class PermissionController extends Controller
{

    /**
     * 获取权限列表 (分页).
     * @param Permission $permission
     * @return \Dingo\Api\Http\Response
     */
    public function index(Permission $permission)
    {
        $permissions = $permission->paginate(request('per_page'));

        return $this->response->paginator($permissions, new PermissionTransformer);
    }


    /**
     * 获取全部权限列表.
     * @param Permission $permission
     * @return \Dingo\Api\Http\Response
     */
    public function list(Permission $permission)
    {
        if(request()->has('is_tree')){
            return response()->json([
                'data'=> make_tree($permission->orderBy('sort','asc')->get()->toArray())
            ]);
        }else{
            $permissions = $permission->orderBy('sort','asc')->get();
        }

        return $this->response->collection($permissions,new PermissionTransformer());
    }


    /**
     * 添加权限.
     * @param Request    $request
     * @param Permission $permission
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request,Permission $permission)
    {
        $this->validateRequest($request);
        $permission->fill($request->all());
        $permission->save();

        return $this->response->item($permission,new PermissionTransformer)->setStatusCode(201);
    }


    /**
     * 查看
     * @param Permission $permission
     * @return \Dingo\Api\Http\Response
     */
    public function show(Permission $permission)
    {
        return $this->response->item($permission,new PermissionTransformer);
    }


    /**
     * 修改权限信息.
     * @param Request    $request
     * @param Permission $permission
     * @return \Dingo\Api\Http\Response
     */
    public function update(Request $request,Permission $permission)
    {
        $this->validateRequest($request);
        $permission->fill($request->all());
        $permission->save();

        return $this->response->noContent();
    }


    /**
     * 删除权限
     * @param Permission $permission
     * @return \Dingo\Api\Http\Response
     * @throws \Exception
     */
    public function delete(Permission $permission)
    {
        $permission->delete();
        return $this->response->noContent();
    }
}
