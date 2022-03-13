<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            ['name'=>'arat','email'=>'arat@gmail.com','password'=>'12345678'],
            ['name'=>'khan','email'=>'khan@gmail.com','password'=>'12345678'],
            ['name'=>'arats','email'=>'arats@gmail.com','password'=>'12345678'],
            ['name'=>'arat khan','email'=>'aratkhan@gmail.com','password'=>'12345678'],
        ];
        User::insert($users);
    }
}
