<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('roles')) {
            return;
        }

        foreach (['donateur', 'beneficiaire', 'admin'] as $roleName) {
            DB::table('roles')->updateOrInsert(
                ['name' => $roleName],
                [
                    'name' => $roleName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        DB::table('roles')
            ->where('name', 'moderateur')
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('roles')) {
            return;
        }

        DB::table('roles')
            ->whereIn('name', ['donateur', 'beneficiaire', 'admin'])
            ->delete();
    }
};
