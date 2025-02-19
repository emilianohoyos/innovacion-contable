<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstname = 'ADMIN';
        $lastname = 'TEST';
        $correo = 'admin@gmail.com';
        $user = User::create([
            'name' => $firstname . ' ' . $lastname,
            'email' => $correo,
            'username' => 'admin',
            'rol' => 'admin',
            'password' => Hash::make(12345678),
        ]);

        Employee::create([
            'document_type_id' => 1,
            'identification' => '1216715427',
            'firstname' => $firstname,
            'lastname' => $lastname,
            'job_title' => 'Administrador',
            'role' => 'ADMIN',
            'cellphone' => '3123456789',
            'emergency_contact_name' => null,
            'emergency_contact_phone' => null,
            'emergency_contact_address' => null,
            'profession' => null,
            'profession_description' => null,
            'observation' => null,
            'user_id' => $user->id,
            'email' => $correo,
            'active' => true,
        ]);
    }
}
