<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
          'id' => Uuid::uuid4(),
          'name' => 'Eliel',
          'email' => 'teste@gmail.com',
          'password' => Hash::make('123456'),
        ]);
    }
}
