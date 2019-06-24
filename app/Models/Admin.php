<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/10/24
 * Time: 13:39
 */

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use App\Models\Traits\HasPermission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Admin
 *
 * @property int                                                                                                            $id
 * @property string                                                                                                         $name             用户名
 * @property string                                                                                                         $password         密码
 * @property string|null                                                                                                    $email            email
 * @property string|null                                                                                                    $avatar           头像
 * @property int                                                                                                            $login_count      登录次数
 * @property string|null                                                                                                    $create_ip        注册ip
 * @property string|null                                                                                                    $last_login_ip    最后登录IP
 * @property string|null                                                                                                    $last_actived_at  最后活跃时间
 * @property int                                                                                                            $status           状态: 1 正常, 2=>禁止
 * @property int|null                                                                                                       $role_id          关联角色
 * @property \Carbon\Carbon|null                                                                                            $created_at
 * @property \Carbon\Carbon|null                                                                                            $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[]                                       $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\Role|null                                                                                     $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[]                                        $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereAvatr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreateIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereLastActivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereLoginCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereAvatar($value)
 */
class Admin extends Authenticatable
{
    use HasApiTokens, HasPermission, Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
        'email',
        'avatar',
        'login_count',
        'create_ip',
        'last_login_ip',
        'last_actived_at',
        'status',
        'role_id'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * 登录支持用户名和邮箱
     * @param $username
     * @return Admin|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function findForPassport($username)
    {
        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['name'] = $username;
        return self::where($credentials)->first();
    }

    /**
     * 用户关联角色反向一对一关系.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * 获取用户角色
     * @return mixed
     */
    public static function getRole()
    {
        return \Auth::guard('admin')->user()->role;
    }


    /**
     * 获取用户的权限列表.
     * @return Collection|\Illuminate\Support\Collection|mixed
     */
    public function getAllPermissions()
    {
        $role = $this->role;
        if($role && in_array($role->id, config('permission.WHITE_ROLES'))) {
            return app(Permission::class)->get();
        }

        if(is_null($role)) {
            return new Collection();
        }

        return optional($role)->permissions()->get();
    }
}