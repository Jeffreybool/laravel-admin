<?php
namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class UsersController extends Controller
{
    /**
     * @param Request $request
     * @param User    $user
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request, User $user)
    {
        return $this->response->paginator($user->paginate($request->get('per_page')),new UserTransformer);
    }


    /**
     * @param Request $request
     * @param User    $user
     * @return \Dingo\Api\Http\Response
     */
    public function list(Request $request,User $user)
    {
        $query = $user->query();
        if($name = $request->get('name')) {
            $query->where('name', 'like','%'.$name .'%');
        }
        $users = $query->get();
        return $this->response->collection($users, new UserTransformer());
    }


    public function store()
    {

    }


    public function show()
    {

    }


    public function update()
    {

    }


    public function destroy()
    {

    }
}
