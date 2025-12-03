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
        Schema::create('AUDIT_LOG', function (Blueprint $table) {
            $table->integer('idLog')->primary();
            $table->string('action', 255)->nullable();
            $table->string('ip', 50)->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('idEntraineur');
            $table->foreign('idEntraineur')->references('idEntraineur')->on('ENTRAINEUR');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('AUDIT_LOG');
    }
};
