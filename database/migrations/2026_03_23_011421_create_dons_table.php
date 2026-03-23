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
    Schema::create('dons', function (Blueprint $table) {
        $table->id();
        $table->double('montant');
        $table->string('type');
        $table->string('statut')->default('proposé'); 

        $table->foreignId('donateur_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->foreignId('campagne_id')
              ->constrained()
              ->onDelete('cascade');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dons');
    }
};
