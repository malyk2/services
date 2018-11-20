<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;
use App\Group;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => Role::ROOT_NAME,
            'group_id' => Group::ROOT_ID,
        ];
        $role = Role::firstOrCreate($data);

        $allPerms = Permission::get();
        $role->permissions()->sync($allPerms);
    }
}
