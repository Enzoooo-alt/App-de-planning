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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('fichier'); // Chemin du fichier stocké
            $table->enum('categorie', ['reglement', 'technique', 'administratif', 'autre'])->default('autre');
            $table->enum('visible_par', ['tous', 'adherents_only', 'entraineurs_only', 'admin_only'])->default('adherents_only');
            $table->foreignId('upload_par')->constrained('users')->comment('Utilisateur qui a uploadé');
            $table->integer('telechargements')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
