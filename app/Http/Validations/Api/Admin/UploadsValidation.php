<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2019/4/13
 * Time: 15:47
 */

namespace App\Http\Validations\Api\Admin;

class UploadsValidation
{
    public function upload()
    {
        return [
            'rules' => [
                'image' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
                'type'=>'required|string',
            ],

            'messages' => [
                'image.mimes'       => '头像格式不支持,目前只支持jpeg,bmp,png,gif格式',
                'image.dimensions'  => '头像的清晰度不够，宽和高需要 50px 以上',
            ]
        ];
    }
}