<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/8/26
 * Time: 23:26
 */

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Illuminate\Contracts\Support\Arrayable;


class DefaultTransformer extends TransformerAbstract
{
    /**
     * default transformer.
     *
     * @param Arrayable $model
     * @return array
     */
    public function transform(Arrayable $model)
    {
        return $model->toArray();
    }

}