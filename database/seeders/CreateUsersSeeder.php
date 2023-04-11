<?php

namespace Database\Seeders;

use App\Models\User;
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
            ],
            [
               'name'=>'Teacher',
               'email'=>'teacher@school.com',
               'role'=> 2,
               'password'=> '123456',
            ],
            [
               'name'=>'Student',
               'email'=>'student@school.com',
               'role'=>0,
               'password'=> '123456',
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
