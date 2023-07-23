<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Zeena Choudhury',
            'username' => 'zeena',
            'is_dmo' => true,
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'name' => 'Raktim Phukan',
            'username' => 'raktim',
            'is_dmo' => true,
            'password' => bcrypt('12345'),
        ]);

        User::create([
            'name' => 'Mayuri Gohain',
            'username' => 'mayuri',
            'is_dmo' => true,
            'password' => bcrypt('12345'),
        ]);


        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'is_admin' => true,
            'password' => bcrypt('admin123@'),
        ]);
    }
}
