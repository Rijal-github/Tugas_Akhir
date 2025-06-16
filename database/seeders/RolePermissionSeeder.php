<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $dlh = Role::firstOrCreate(['name' => 'dlh']);
        $uptd = Role::firstOrCreate(['name' => 'uptd']);
        $operator = Role::firstOrCreate(['name' => 'operator_tpa']);

        // $permissions = [
        //     'dashboard',
        //     'data_tps',
        //     'data_tpa',
        //     'data_uptd',
        //     'pendataan_sampah',
        //     'jadwal_pengangkutan',
        //     'data_iot',
        //     'pelaporan',
        //     'setting_user',
        // ];

        $this->createPermissions($admin, [
            'dashboard',
            'data_tps',
            'data_tpa',
            'data_uptd',
            'pendataan_sampah',
            'jadwal_pengangkutan',
            'data_iot',
            'pelaporan',
            'setting_user',
        ]);

        $this->createPermissions($dlh, [
            'dashboard',
            'data_tps',
            'data_tpa',
            'data_uptd',
            'jadwal_pengangkutan',
            'pelaporan',
        ]);

        $this->createPermissions($uptd, [
            'dashboard',
            'data_uptd',
            'jadwal_pengangkutan',
            'pelaporan',
        ]);

        $this->createPermissions($operator, [
            'dashboard',
            'data_tpa',
            'data_tps',
            'pendataan_sampah',
            'data_iot',
            'jadwal_pengangkutan',
            'pelaporan',
        ]);

    }

    private function createPermissions($role, array $permissions)
    {
        foreach ($permissions as $perm) {
            Permission::create([
                'name' => $perm,
                'id_role' => $role->id_role, // Pastikan kolom ini ada di tabel permissions
            ]);
        }
    }
        
        // Assign permissions ke role
        // $admin->permissions()->attach(Permission::pluck('id'));
        // $dlh->permissions()->attach(Permission::whereIn('name', ['dashboard', 'data_tps', 'data_tpa', 'data_uptd', 'jadwal_pengangkutan', 'pelaporan'])->pluck('id'));
        // $uptd->permissions()->attach(Permission::whereIn('name', ['dashboard', 'data_uptd', 'jadwal_pengangkutan', 'pelaporan'])->pluck('id'));
        // $operator->permissions()->attach(Permission::whereIn('name', ['dashboard', 'data_tpa', 'data_tps', 'pendataan_sampah', 'data_iot', 'jadwal_pengangkutan', 'pelaporan'])->pluck('id'));
}
