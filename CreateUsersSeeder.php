<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin1',
               'email'=>'admin1@stagebit.com',
                //'is_admin'=>'1',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User1',
               'email'=>'user1@stagebit.com',
                //'is_admin'=>'0',
               'password'=> bcrypt('123456'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
