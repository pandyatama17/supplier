<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name' => 'Admin 1',
        'phone' => '081111221122',
        'email' => 'admin@supplier.com',
        'email_verified_at' =>\Carbon\Carbon::now(),
        'password' => Hash::make('admin'),
        'created_at' =>\Carbon\Carbon::now(),
        'updated_at' =>\Carbon\Carbon::now(),
      ]);
    }
}
