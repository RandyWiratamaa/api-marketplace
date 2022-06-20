<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'fullname' => 'Randy Wiratama',
            'username' => 'randywiratama_',
            'email' => 'randywrtm007@gmail.com',
            'password' => Hash::make('password123')
        ]);
    }
}
