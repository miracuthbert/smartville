<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $user = \App\User::create(
//            array('id' => '1', 'firstname' => 'Cuthbert', 'lastname' => 'Mirambo', 'username' => NULL, 'phone' => '0724308266', 'country' => 'Kenya', 'email' => 'miracuthbert@gmail.com', 'id_no' => NULL, 'password' => '$2y$10$6R0YYSP39xZniHYGGWiLj.xHwXXZfkclsydUkpdvLPVdD0OGwhEW6', 'activated' => '0', 'remember_token' => 'N2ZCkA2BzL0hq1L7txksjfNd6dcNygfRXB8EN2jFpW9G2n28toDEeTZTk6SJ', 'created_at' => '2017-01-12 14:36:50', 'updated_at' => '2017-02-17 16:41:34')
//        );
        $user = \App\User::create(
            array('id' => '2', 'firstname' => 'Jane', 'lastname' => 'Doe', 'username' => NULL, 'phone' => '0722411441', 'country' => 'KE', 'email' => 'jdoe@test.com', 'id_no' => NULL, 'password' => '$2y$10$VYOk/yTjSVQJi5EkFigaResHH/kshofNVU5vkkcmq74fgBekfLdMO', 'activated' => '0', 'remember_token' => 'O2hqQkaH6Ysw1HBtNX584j1NGgK0PBrPJMDV6Q9zrTQzEAlFU4J7UN1Rh1iK', 'created_at' => '2017-01-22 16:25:27', 'updated_at' => '2017-02-15 18:29:17')
        );
        $user = \App\User::create(
            array('id' => '3', 'firstname' => 'John', 'lastname' => 'Doe', 'username' => NULL, 'phone' => '0711444555', 'country' => 'Tz', 'email' => 'doejohns@test.com', 'id_no' => NULL, 'password' => '$2y$10$VYOk/yTjSVQJi5EkFigaResHH/kshofNVU5vkkcmq74fgBekfLdMO', 'activated' => '0', 'remember_token' => NULL, 'created_at' => '2017-01-22 16:59:05', 'updated_at' => '2017-02-09 13:34:10')
        );
        $user = \App\User::create(
            array('id' => '4', 'firstname' => 'Jacky', 'lastname' => 'Jack', 'username' => NULL, 'phone' => '0716563355', 'country' => 'Tz', 'email' => 'jjacky@test.com', 'id_no' => NULL, 'password' => '$2y$10$xfirafXhegxzgWEItLTS3O4roipGFSav626/L3U.zdUCngVJUUTGu', 'activated' => '0', 'remember_token' => NULL, 'created_at' => '2017-01-22 17:16:10', 'updated_at' => '2017-01-22 17:16:10')
        );
    }
}
