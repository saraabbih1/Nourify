<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('roles')->insert([
        ['name' => 'donateur'],
        ['name' => 'beneficiaire'],
        ['name' => 'admin'],
        ['name' => 'moderateur'],
    ]);
}
}
