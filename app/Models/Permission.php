<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name 权限名称
 * @property string|null $route 权限路由
 * @property int $parent_id 上级权限
 * @property int $is_hidden 是否隐藏
 * @property int $sort 排序
 * @property int $status 状态: 1 正常, 2=>禁止
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereIsHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $icon icon图标
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission query()
 */
class Permission extends Model
{
    protected $fillable = ['name', 'route','icon', 'parent_id','is_hidden','sort'];

    /**
     * 定义权限和角色多对多关系.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class,"role_has_permissions","permission_id","role_id");
    }

}
