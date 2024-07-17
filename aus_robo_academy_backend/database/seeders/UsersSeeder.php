<?php

namespace Database\Seeders;
use Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'super.admin@ausroboacademy.com',
            'password' => Hash::make('testing123'),
            'phone_no' => '+11234567890',
            'gender' => 'male',
            'country' => '01',
            'state' => '01',
            'city' => '01',
            'address' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi recusandae nobis commodi esse corrupti.',
        ]);

        \App\Models\User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@ausroboacademy.com',
            'password' => Hash::make('testing123'),
            'phone_no' => '+11234567890',
            'gender' => 'female',
            'country' => '01',
            'state' => '01',
            'city' => '01',
            'address' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi recusandae nobis commodi esse corrupti.',
            'expiration_date' => '2024-01-15',
            'organisation_name' => 'Sydney Olympic School',
            'organisation_id' => '42AVF548228FS8',
        ]);

        \App\Models\User::create([
            'name' => 'Parent User',
            'email' => 'parent@ausroboacademy.com',
            'password' => Hash::make('testing123'),
            'phone_no' => '+11234567890',
            'gender' => 'male',
            'country' => '01',
            'state' => '01',
            'city' => '01',
            'address' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi recusandae nobis commodi esse corrupti.',
        ]);
    }
}
