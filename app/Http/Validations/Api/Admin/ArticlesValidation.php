<?php

namespace App\Http\Validations\Api\Admin;

class ArticlesValidation
{

    public function store()
    {
        return [
            'rules' => [
                'title'       => 'required|min:2',
                'body'        => 'required|min:3',
                'category_id' => 'required|numeric',
            ],

            'messages' => [
                'title.required'       => '标题不能为空',
                'title.min'            => '标题必须至少两个字符',
                'category_id.required' => '分类不能为空',
                'body.required'        => '文章内容不能为空',
                'body.min'             => '文章内容必须至少三个字符',
            ],
        ];
    }

}
