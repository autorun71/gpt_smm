<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admin = Admin::where('email', 'admin@example.com')->first();

        if (!$admin) {
            Admin::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('7xTcL5q')
            ]);
        }
    }
}
