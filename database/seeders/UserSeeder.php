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
        User::insert([
            // ['name'=>'admin','email'=>'admin@admin.com','password'=>bcrypt('Pass@123'),'userType'=>'admin'],
            ['name'=>'Sub-admin','email'=>'subadmin@admin.com','password'=>bcrypt('Pass@123'),'userType'=>'subAdmin'],
        ]);
    }
}
