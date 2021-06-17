<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(
          [
            'name' => 'Петр',
            'midname' => 'Петрович',
            'lastname' => 'Петров',
            'username' => 'petr2000',
            'email' => 'peter@mail.ru',
            'email_verified_at' => null,
            'password' => '$2y$10$uOnf1WRjmsxqWi9FO7wRwu9Kv6NxqKoNcnPPqDPWVVcOE7/He67jy'
          ]
        );
    }
}
