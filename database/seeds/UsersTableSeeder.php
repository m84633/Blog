<?php

use Illuminate\Database\Seeder;
use App\User as UserEloquent;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        UserEloquent::truncate();//清空資料表

        UserEloquent::create([
            'name' => '管理者',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'type' => 1,
        ]);
    }
}
