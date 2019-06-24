<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/8/28
 * Time: 11:04
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * App\Models\Model
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent()
 * @mixin \Eloquent
 */
class Model extends EloquentModel {

    public function scopeRecent($query) {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query) {
        return $query->orderBy('order', 'desc');
    }
}