<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            //Admin
            [
                'full_name'=>'Andrii Admin',
                'username'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('1111'),
                'role'=>'admin',
                'status'=>'active',
            ],
            //Vendor
            [
                'full_name'=>'Andrii Seller',
                'username'=>'Seller',
                'email'=>'seller@gmail.com',
                'password'=>Hash::make('1111'),
                'role'=>'seller',
                'status'=>'active',
            ],
            //Customer
            [
                'full_name'=>'Andrii Customer',
                'username'=>'Customer',
                'email'=>'customer@gmail.com',
                'password'=>Hash::make('1111'),
                'role'=>'customer',
                'status'=>'active',
            ],
        ]);
    }
}
