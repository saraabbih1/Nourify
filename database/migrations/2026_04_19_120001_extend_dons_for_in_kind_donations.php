<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dons', function (Blueprint $table) {
            if (!Schema::hasColumn('dons', 'quantite')) {
                $table->decimal('quantite', 10, 2)->nullable()->after('montant');
            }
            if (!Schema::hasColumn('dons', 'unite')) {
                $table->string('unite', 50)->nullable()->after('quantite');
            }
            if (!Schema::hasColumn('dons', 'description')) {
                $table->text('description')->nullable()->after('unite');
            }
        });

        DB::statement('ALTER TABLE dons MODIFY montant DOUBLE NULL');
    }

    public function down(): void
    {
        DB::statement('UPDATE dons SET montant = 0 WHERE montant IS NULL');
        DB::statement('ALTER TABLE dons MODIFY montant DOUBLE NOT NULL');

        Schema::table('dons', function (Blueprint $table) {
            if (Schema::hasColumn('dons', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('dons', 'unite')) {
                $table->dropColumn('unite');
            }
            if (Schema::hasColumn('dons', 'quantite')) {
                $table->dropColumn('quantite');
            }
        });
    }
};
