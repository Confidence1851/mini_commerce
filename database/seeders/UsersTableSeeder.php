<?php

namespace Database\Seeders;

use App\Helpers\Constants;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => "Admin",
                'last_name' =>  "Live",
                'email' => "admin@gelly.ng",
                'status' => "Active",
                "role" => Constants::ADMIN_USER,
                "ref_code" => User::newRefCode(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
            [
                'first_name' => "Confidence",
                'last_name' =>  "Ugolo",
                'email' => "ugoloconfidence@gmail.com",
                'status' => "Active",
                "role" => Constants::ADMIN_USER,
                "ref_code" => User::newRefCode(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],

        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ["email" => $user["email"]],
                $user
            );
        }

    }
}
