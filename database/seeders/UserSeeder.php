<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pass = Hash::make("make@lara");
        User::create([
            'name' => "Site Super Admin",
            'email' => "ahmad@path2quality.com",
            'password' => $pass,
            'company' => "qcostaffing",
            'phone' => "+12222223333",
            'fax' => "+12222233333",
            'skill_email' => "skill-email@qcostaffing.com",
            'app_email' => "app-email@qcostaffing.com"
        ]);
    }
}
