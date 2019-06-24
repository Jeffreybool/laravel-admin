<?php
if(!function_exists('request_intersect')) {

    /**
     * request intersect
     * @param $keys
     * @return array
     */
    function request_intersect($keys)
    {
        return array_filter(request()->only(is_array($keys) ? $keys : func_get_args()));
    }
}


if(!function_exists('make_excerpt')) {
    /**
     * 提取字符
     * @param     $value
     * @param int $length
     * @return string
     */
    function make_excerpt($value, $length = 200)
    {
        //        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
        return str_limit($value, $length);
    }
}


if(!function_exists('make_tree')) {
    /**
     * @param array $list
     * @param int   $parentId
     * @return array
     */
    function make_tree(array $list, $parentId = 0)
    {
        $tree = [];
        if(empty($list)) {
            return $tree;
        }
        $newList = [];
        foreach($list as $k => $v) {
            $newList[$v['id']] = $v;
        }

        foreach($newList as $value) {
            if($parentId == $value['parent_id']) {
                $tree[] = &$newList[$value['id']];
            } elseif(isset($newList[$value['parent_id']])) {
                $newList[$value['parent_id']]['children'][] = &$newList[$value['id']];
            }
        }
        return $tree;
    }
}


if(!function_exists('add_copyright')) {
    function add_copyright(\App\Models\Article $article)
    {
        $str = <<<EOT
$article->body_original\n
原文链接：[https://www.zhanggaoyuan.com/article/$article->id](https://www.zhanggaoyuan.com/article/$article->id)\n
原文标题：[$article->title]\n
本站使用「 [署名-非商业性使用 4.0 国际 (CC BY-NC 4.0)](https://creativecommons.org/licenses/by-nc/4.0/deed.zh)」创作共享协议，转载或使用请署名并注明出处。
EOT;
        return $str;
    }
}