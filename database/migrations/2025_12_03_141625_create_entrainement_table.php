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
        Schema::create('ENTRAINEMENT', function (Blueprint $table) {
            $table->integer('idEntrainement')->primary();
            $table->string('titre', 255)->nullable();
            $table->dateTime('dateCreation')->nullable();
            $table->integer('idEntraineur');
            $table->foreign('idEntraineur')->references('idEntraineur')->on('ENTRAINEUR');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ENTRAINEMENT');
    }
};
