<?php

namespace Database\Seeders;

use App\Constant\Role;
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
        User::factory()->create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'email'=>'admin@gmail.com',
            'password'=>'11111111',
            'role'=>Role::ADMIN, 
        ]);
        User::factory()->create([
            'name'=>'Seller',
            'email'=>'seller@gmail.com',
            'password'=>'11111111',
        ]);
    }
}
