<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/11/4
 * Time: 22:06
 */

namespace App\Http\Controllers\Api\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Transformers\AdminTransformer;
use App\Http\Controllers\Api\Controller;
use App\Transformers\PermissionTransformer;

class AdminsController extends Controller
{


    /**
     * 获取所有
     * @param Admin $admin
     * @return \Dingo\Api\Http\Response
     */
    public function index(Admin $admin)
    {
        return $this->response->paginator($admin->paginate(request("per_page")), new AdminTransformer());
    }


    /**
     * 新增管理员
     * @param Request $request
     * @param Admin   $admin
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request, Admin $admin)
    {
        $this->validateRequest($request);
        $admin->fill($request->all());
        $admin->password = bcrypt($request->get('password'));
        $admin->save();

        return $this->response->item($admin, new AdminTransformer())->setStatusCode(201);
    }


    /**
     * 查看
     * @param Admin $admin
     * @return \Dingo\Api\Http\Response
     */
    public function show(Admin $admin)
    {
        return $this->response->item($admin, new AdminTransformer())->setStatusCode(200);
    }


    /**
     * 更新
     * @param Request $request
     * @param Admin   $admin
     * @return \Dingo\Api\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $this->validateRequest($request, 'update');

        $admin->fill($request->all());
        if(!empty($request->get('password'))) {
            $admin->password = bcrypt($request->get('password'));
        }
        $admin->save();

        return $this->response->noContent();
    }


    /**
     * 删除
     * @param Admin $admin
     * @throws \Exception
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
    }


    /**
     * 获取个人信息.
     * @return \Dingo\Api\Http\Response
     */
    public function info()
    {
        return $this->response->item($this->user(), new AdminTransformer());
    }

    /**
     * 获取某个用户的所有权限列表.
     * @return \Dingo\Api\Http\Response
     */
    public function permissions()
    {
        $permissions = $this->user()->getAllPermissions();
        return $this->response->collection($permissions, new PermissionTransformer());
    }
}