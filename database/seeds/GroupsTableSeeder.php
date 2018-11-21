<?php

use Illuminate\Database\Seeder;
use App\Group;
use App\Permission;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['name' => Group::ROOT_NAME];
        $group = Group::firstOrCreate($data);

        $allPerms = Permission::get();
        $group->permissions()->sync($allPerms);
    }
}
