<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'name' => 'Vijaykumar',
                'email' => 'vijaykumar@email.com',
                'password' => Hash::make(123456),
                'mobile_no' => '9987565478',
            ],
            [
                'name' => 'John Doe',
                'email' => 'johndoe@email.com',
                'password' => Hash::make(123456),
                'mobile_no' => '9874567890',
            ],
            [
                'name' => 'Arjunkumar',
                'email' => 'kumararjun@email.com',
                'password' => Hash::make(123456),
                'mobile_no' => '7894567890',
            ],
            [
                'name' => 'Shane Wane',
                'email' => 'shanewane@email.com',
                'password' => Hash::make(123456),
                'mobile_no' => '8974565450',
            ],
            [
                'name' => 'Maria Mathew',
                'email' => 'mariamathew@email.com',
                'password' => Hash::make(123456),
                'mobile_no' => '8569874565',
            ],
        ];

        foreach($input as $data) {
            User::create($data);
        }
    }
}
