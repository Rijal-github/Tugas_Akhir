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
        $operator = Role::where('name','operator tpa')->first();
        $driver = Role::where('name','driver')->first();
        // $driver = Role::where('name','driver')->first();
        // $driver = Role::where('name','driver')->first();
        $operator_spbu = Role::where('name','operator_spbu')->first();
        $kepala_dlh = Role::where('name','kepala dlh')->first();
        $kepala_uptd = Role::where('name','kepala uptd')->first();
        

        $admin = User::create([
            'name' => 'Muhamad Rijal',
            'email' => 'admin@example.com',
            'username' => 'superadmin123',
            'no_hp' => '123456789',
            'alamat_user' => 'Ds. Admin',
            'password' => bcrypt('password123'), // password di-hash
            'id_role' => $admin->id, // FK
        ]);

        $dlh = User::create([
            'name' => 'Admin dlh',
            'email' => 'dlh@example.com',
            'username' => 'admindlh123',
            'no_hp' => '12345678910',
            'alamat_user' => 'Ds. Dlh',
            'password' => bcrypt('password1234'), // password di-hash
            'id_role' => $dlh->id, // pastikan $user =user punya kolom 'role_id'
        ]);   

        $uptd = User::create([
            'name' => 'Admin uptd',
            'email' => 'uptd@example.com',
            'username' => 'adminuptd123',
            'no_hp' => '12345678911',
            'alamat_user' => 'Ds. Uptd',
            'password' => bcrypt('password1235'), // password di-hash
            'id_role' => $uptd->id, // pastikan $user =user punya kolom 'role_id'
        ]);   

        $operator = User::create([
            'name' => 'Operator TPA',
            'email' => 'operator@example.com',
            'username' => 'admintpa123',
            'no_hp' => '12345678912',
            'alamat_user' => 'Ds. Operator',
            'password' => bcrypt('password1236'), // password di-hash
            'id_role' => $operator->id, // pastikan user punya kolom 'role_id'
        ]);
        
        $driver = User::create([
            'name' => 'sutrisno',
            'email' => 'sutrisno@example.com',
            'username' => '@driver1',
            'no_hp' => '12345678912',
            'alamat_user' => 'Ds. Cidempet',
            'password' => bcrypt('sutrisno1236'), // password di-hash
            'id_role' => $driver->id, // pastikan user punya kolom 'role_id'
        ]);
        
        $driver = User::create([
            'name' => 'sudrajat',
            'email' => 'sudrajat@example.com',
            'username' => '@driver2',
            'no_hp' => '123456789123',
            'alamat_user' => 'Ds. Linggajati',
            'password' => bcrypt('sudrajat1236'), // password di-hash
            'id_role' => $driver->id, // pastikan user punya kolom 'role_id'
        ]);  

        $driver = User::create([
            'name' => 'daryono',
            'email' => 'daryono@example.com',
            'username' => '@driver3',
            'no_hp' => '123456789124',
            'alamat_user' => 'Ds. Legok',
            'password' => bcrypt('daryono1236'), // password di-hash
            'id_role' => $driver->id, // pastikan user punya kolom 'role_id'
        ]);  
        
        $operator_spbu = User::create([
            'name' => 'Asep',
            'email' => 'asep@example.com',
            'username' => 'asepjr',
            'no_hp' => '123456789124',
            'alamat_user' => 'Ds. Legok',
            'password' => bcrypt('asepajah'), // password di-hash
            'id_role' => $operator_spbu->id, // pastikan user punya kolom 'role_id'
        ]);  

        $kepala_dlh = User::create([
            'name' => 'karyanto',
            'email' => 'karyanto@example.com',
            'username' => '@kepaladlh',
            'no_hp' => '123456789120',
            'alamat_user' => 'Ds. Lohbener',
            'password' => bcrypt('karyanto1236'), // password di-hash
            'id_role' => $kepala_dlh->id, // pastikan user punya kolom 'role_id'
        ]);  

        $kepala_uptd = User::create([
            'name' => 'yudistira',
            'email' => 'yudi@example.com',
            'username' => '@kepalauptd',
            'no_hp' => '123456789121',
            'alamat_user' => 'Ds. Bulak',
            'password' => bcrypt('yudistira1236'), // password di-hash
            'id_role' => $kepala_uptd->id, // pastikan user punya kolom 'role_id'
        ]);
    }
}
