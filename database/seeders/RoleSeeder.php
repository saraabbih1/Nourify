<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    foreach (['donateur', 'beneficiaire', 'admin', 'moderateur'] as $roleName) {
        Role::firstOrCreate(['name' => $roleName]);
    }
}
}
