<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'auth.login', 'display_name' => 'Вхід по логіну', 'type' => 'Авторизація'],
            ['name' => 'users.manage', 'display_name' => 'Управління користувачами', 'type' => 'Користувачі'],
            ['name' => 'groups.manage', 'display_name' => 'Управління групами користувачів', 'type' => 'Користувачі'],
            ['name' => 'permissions.groups', 'display_name' => 'Управління доступами груп користувачів', 'type' => 'Користувачі'],
            ['name' => 'roles.manage', 'display_name' => 'Управління ролями користувачів', 'type' => 'Користувачі'],
        ];
        foreach($data as $item) {
            $perm = Permission::firstOrCreate(['name' => $item['name']]);
            $perm->display_name = $item['display_name'];
            $perm->type = $item['type'];
            $perm->save();
        }
    }
}
