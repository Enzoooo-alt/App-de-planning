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
        Schema::create('ECHANGER', function (Blueprint $table) {
            $table->integer('identraineurDemandant');
            $table->integer('identraineurRemplaçant');
            $table->integer('idSeance');
            $table->string('statut', 50)->nullable();
            $table->string('commentaire', 255)->nullable();
            $table->dateTime('dateEchange')->nullable();
            $table->primary(['identraineurDemandant', 'identraineurRemplaçant', 'idSeance']);
            $table->foreign('identraineurDemandant')->references('idEntraineur')->on('ENTRAINEUR');
            $table->foreign('identraineurRemplaçant')->references('idEntraineur')->on('ENTRAINEUR');
            $table->foreign('idSeance')->references('idSeance')->on('SEANCE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ECHANGER');
    }
};
