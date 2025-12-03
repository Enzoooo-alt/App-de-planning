<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ENTRAINEUR', function (Blueprint $table) {
            $table->integer('idEntraineur')->primary();
            $table->string('nom', 512)->nullable();
            $table->string('prenom', 512)->nullable();
            $table->string('role', 512)->nullable();
            $table->string('login', 512)->nullable();
            $table->string('mot_de_passe', 512)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ENTRAINEUR');
    }
};
