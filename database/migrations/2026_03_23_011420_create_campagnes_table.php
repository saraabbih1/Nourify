<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
/**
 * Run the migrations.
 */
   public function up()
{
    Schema::create('campagnes', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('description');
        $table->double('objectif');
        $table->double('montant_collecte')->default(0);
        $table->string('statut')->default('active');

        $table->foreignId('beneficiaire_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campagnes');
    }
};
