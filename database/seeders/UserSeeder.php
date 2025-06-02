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
        

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'addres' => 'Ds. Admin',
            'password' => bcrypt('password123'), // password di-hash
            'id_role' => $admin->id_role, // FK
        ]);

        $dlh = User::create([
            'name' => 'Dlh Utama',
            'email' => 'dlh@example.com',
            'addres' => 'Ds. Dlh',
            'password' => bcrypt('password1234'), // password di-hash
            'id_role' => $dlh->id_role, // pastikan $user =user punya kolom 'role_id'
        ]);   

        $uptd = User::create([
            'name' => 'Uptd Utama',
            'email' => 'uptd@example.com',
            'addres' => 'Ds. Uptd',
            'password' => bcrypt('password1235'), // password di-hash
            'id_role' => $uptd->id_role, // pastikan $user =user punya kolom 'role_id'
        ]);   

        $operator = User::create([
            'name' => 'Operator Utama',
            'email' => 'operator@example.com',
            'addres' => 'Ds. Operator',
            'password' => bcrypt('password1236'), // password di-hash
            'id_role' => $operator->id_role, // pastikan user punya kolom 'role_id'
        ]);  
        
    }
}
