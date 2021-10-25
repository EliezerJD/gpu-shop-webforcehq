<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = 'admin1234';
        $user->role_id  = 0;
        $user->save();

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@user.com';
        $user->password = 'user1234';
        $user->role_id  = 1;
        $user->save();
    }
}