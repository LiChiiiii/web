<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        for($i=0; $i<10;$i++)
        {
            $tmp =[];
            $tmp['name'] = 'aaa';
            $tmp['password'] = rand(0,1);
            $tmp['email'] = rand(100,9999).'@gmail.com';
            $arr[] = $tmp;
        }

            DB::table('users')->insert($arr);
    }
}
