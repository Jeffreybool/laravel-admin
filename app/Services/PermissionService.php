<?php
/**
 * Created by PhpStorm.
 * User: JeffreyBool
 * Date: 2018/10/13
 * Time: 22:00
 */

namespace App\Services;

class PermissionService
{

    /**
     * 权限数据结构处理
     * @param $permissions
     * @param string $parentKeyName
     * @param int $pid
     * @param int $level
     * @return array|bool
     */
    public function getPermissionsTree($permissions, $parentKeyName = 'parent_id', $pid = 0, $level = 0)
    {
        $arr = [];
        foreach ( $permissions as $record )
        {
            if ((int)$record[$parentKeyName] === $pid) {
                $record['child'] = $this->getPermissionsTree($permissions, $parentKeyName, $record['id'], $level+1);
                $record['level'] = $level;
                $arr[] = $record;
            }
        }

        return $arr ? $arr : false;
    }
}