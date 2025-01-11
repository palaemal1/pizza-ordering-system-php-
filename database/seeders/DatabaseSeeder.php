<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'09436882321',
            'gender'=>'male',
            'address'=>'taunggyi',
            'role'=>'admin',
            'password'=>Hash::make('admin123')
        ]);
    }
}
