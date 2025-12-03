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
        Schema::create('SEANCE', function (Blueprint $table) {
            $table->integer('idSeance')->primary();
            $table->date('dateSeance')->nullable();
            $table->time('heureDebut')->nullable();
            $table->time('heureFin')->nullable();
            $table->integer('idEntrainement');
            $table->foreign('idEntrainement')->references('idEntrainement')->on('ENTRAINEMENT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SEANCE');
    }
};
