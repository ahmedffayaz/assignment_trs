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
       $users = [
            ['name'=>'Admin','email'=>'admin@admin.com','password'=>bcrypt('Pass@123'),'userType'=>'admin'],
            ['name'=>'Sub Admin','email'=>'subadmin@admin.com','password'=>bcrypt('Pass@123'),'userType'=>'sub_admin'],
        ];

        foreach($users as $value) {
            $user = User::updateOrCreate([
                'email' => $value['email']
            ], [
                'name' => $value['name'],
                'password' => $value['password'],
                'userType' => $value['userType']
            ]);

            $user->assignRole($user->userType);
        }
    }
}
