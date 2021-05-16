<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
                'email'    => 'admin@bakalauras.local',
                'password' => bcrypt('123456'),
                'role'     => 'admin',
            ],
            [
                'email'    => 'client@bakalauras.local',
                'password' => bcrypt('123456'),
                'role'     => 'client',
            ],
        ];

        foreach ($users as $row) {
            $user = User::create([
                'email'    => $row['email'],
                'password' => $row['password'],
            ]);

            $user->assignRole($row['role']);
        }
    }
}
