<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
               'name'=>'Admin',
               'email'=>'admin@school.com',
               'role'=>1,
               'password'=> '123456',
               'userable_type' => 'App\Models\Admin',
               'userable_id' => 1
            ]
        ];

        Admin::create();
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
