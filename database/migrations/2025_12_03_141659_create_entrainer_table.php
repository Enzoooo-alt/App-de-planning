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
        Schema::create('ENTRAINER', function (Blueprint $table) {
            $table->integer('idEntraineur');
            $table->integer('idEntrainement');
            $table->integer('idJour');
            $table->primary(['idEntraineur', 'idEntrainement', 'idJour']);
            $table->foreign('idEntraineur')->references('idEntraineur')->on('ENTRAINEUR');
            $table->foreign('idEntrainement')->references('idEntrainement')->on('ENTRAINEMENT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ENTRAINER');
    }
};
