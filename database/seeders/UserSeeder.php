<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Ambil role dari database
        $admin = Role::where('name', 'admin')->first();
        $dlh = Role::where('name', 'dlh')->first();
        $uptd = Role::where('name','uptd')->first();
        $operator = Role::where('name','operator_tpa')->first();
        $driver = Role::where('name','driver')->first();
        $driver = Role::where('name','driver')->first();
        $driver = Role::where('name','driver')->first();
        $kepala_dlh = Role::where('name','kepala dlh')->first();
        $kepala_uptd = Role::where('name','kepala uptd')->first();
        

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'no_hp' => '123456789',
            'addres' => 'Ds. Admin',
            'password' => bcrypt('password123'), // password di-hash
            'id_role' => $admin->id_role, // FK
        ]);

        $dlh = User::create([
            'name' => 'Admin dlh',
            'email' => 'dlh@example.com',
            'no_hp' => '12345678910',
            'addres' => 'Ds. Dlh',
            'password' => bcrypt('password1234'), // password di-hash
            'id_role' => $dlh->id_role, // pastikan $user =user punya kolom 'role_id'
        ]);   

        $uptd = User::create([
            'name' => 'Admin uptd',
            'email' => 'uptd@example.com',
            'no_hp' => '12345678911',
            'addres' => 'Ds. Uptd',
            'password' => bcrypt('password1235'), // password di-hash
            'id_role' => $uptd->id_role, // pastikan $user =user punya kolom 'role_id'
        ]);   

        $operator = User::create([
            'name' => 'Operator TPA',
            'email' => 'operator@example.com',
            'no_hp' => '12345678912',
            'addres' => 'Ds. Operator',
            'password' => bcrypt('password1236'), // password di-hash
            'id_role' => $operator->id_role, // pastikan user punya kolom 'role_id'
        ]);
        
        $driver = User::create([
            'name' => 'sutrisno',
            'email' => 'sutrisno@example.com',
            'no_hp' => '12345678912',
            'addres' => 'Ds. Cidempet',
            'password' => bcrypt('sutrisno1236'), // password di-hash
            'id_role' => $driver->id_role, // pastikan user punya kolom 'role_id'
        ]);
        
        $driver = User::create([
            'name' => 'sudrajat',
            'email' => 'sudrajat@example.com',
            'no_hp' => '123456789123',
            'addres' => 'Ds. Linggajati',
            'password' => bcrypt('sudrajat1236'), // password di-hash
            'id_role' => $driver->id_role, // pastikan user punya kolom 'role_id'
        ]);  

        $driver = User::create([
            'name' => 'daryono',
            'email' => 'daryono@example.com',
            'no_hp' => '123456789124',
            'addres' => 'Ds. Legok',
            'password' => bcrypt('daryono1236'), // password di-hash
            'id_role' => $driver->id_role, // pastikan user punya kolom 'role_id'
        ]);  

        $kepala_dlh = User::create([
            'name' => 'karyanto',
            'email' => 'karyanto@example.com',
            'no_hp' => '123456789120',
            'addres' => 'Ds. Lohbener',
            'password' => bcrypt('karyanto1236'), // password di-hash
            'id_role' => $kepala_dlh->id_role, // pastikan user punya kolom 'role_id'
        ]);  

        $kepala_uptd = User::create([
            'name' => 'yudistira',
            'email' => 'yudi@example.com',
            'no_hp' => '123456789121',
            'addres' => 'Ds. Bulak',
            'password' => bcrypt('yudistira1236'), // password di-hash
            'id_role' => $kepala_uptd->id_role, // pastikan user punya kolom 'role_id'
        ]);  
        
    }
}
