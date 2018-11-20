<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'admin',
            'email' => 'admin@div-art.com',
        ];

        $user = User::firstOrNew($data);
        if ( ! $user->exists) {
            $user->password = 'admin';
        }
        $user->save();
    }
}
