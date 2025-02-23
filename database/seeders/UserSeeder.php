<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ['name' => 'Mohammed Helmy1', 'email' => 'test@test.com', 'password' => bcrypt('123456789'),'role'=>1,'created_at' => now(),'updated_at' => now()],
            ['name' => 'Mohammed Helmy2', 'email' => 'egyman930@gmail.com', 'password' => bcrypt('123456789'),'role'=>2,'created_at' => now(),'updated_at' => now()],
        ]);
    }
}
