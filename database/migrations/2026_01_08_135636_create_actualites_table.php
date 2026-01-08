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
        Schema::create('actualites', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('contenu');
            $table->string('image')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Auteur
            $table->enum('categorie', ['competition', 'evenement', 'info', 'resultat'])->default('info');
            $table->enum('statut', ['brouillon', 'publie'])->default('brouillon');
            $table->boolean('epingle')->default(false); // Pour mettre en avant
            $table->timestamp('publie_le')->nullable();
            $table->timestamps();
            
            $table->index(['statut', 'publie_le']);
            $table->index('epingle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualites');
    }
};
