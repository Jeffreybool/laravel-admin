<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::dropIfExists('permissions');

        Schema::create('permissions', function(\Illuminate\Database\Schema\Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('权限名称');
            $table->string('route')->nullable()->comment('权限路由');
            $table->string('icon')->nullable()->comment('icon图标');
            $table->integer('parent_id')->default(0)->unsigned()->comment('上级权限');
            $table->tinyInteger('is_hidden')->default(0)->unsigned()->comment('是否隐藏');
            $table->integer('sort')->default(255)->unsigned()->comment('排序');
            $table->integer('status')->default(1)->comment('状态');
            $table->timestamps();
        });

        $content = file_get_contents(database_path().'/seeds/permissions.json');
        $content = json_decode($content,true);
        $content = \Illuminate\Support\Collection::make($content);
        foreach($content as $key => $item) {
            $permission = app(Permission::class);
            if (array_key_exists('children',$item)){
                foreach($item['children'] as $key1 => $item1) {
                    $permission = app(Permission::class);
                    if ($permission->where('name',$item1['name'])->count()) {
                        continue;
                    }
                    if (array_key_exists('children',$item1)){
                        foreach($item1['children'] as $key2 => $item2) {
                            $permission = app(Permission::class);
                            if ($permission->where('name',$item2['name'])->count()) {
                                continue;
                            }
                            $permission->create($item2);
                        }
                    }
                    unset($item1['children']);
                    $permission->create($item1);
                }
            }
            unset($item['children']);
            $permission->create($item);
        }
    }
}
