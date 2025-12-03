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
        Schema::create('COMMENTAIRE', function (Blueprint $table) {
            $table->integer('idCommentaire')->primary();
            $table->string('texte', 255)->nullable();
            $table->dateTime('dateCommentaire')->nullable();
            $table->integer('idEntraineur');
            $table->integer('idSeance');
            $table->foreign('idEntraineur')->references('idEntraineur')->on('ENTRAINEUR');
            $table->foreign('idSeance')->references('idSeance')->on('SEANCE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('COMMENTAIRE');
    }
};
