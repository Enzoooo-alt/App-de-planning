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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adherent_id')->constrained('adherent')->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->enum('type', ['cotisation_annuelle', 'stage', 'competition', 'equipement', 'autre'])->default('cotisation_annuelle');
            $table->enum('methode', ['especes', 'cheque', 'virement', 'cb', 'autre'])->default('especes');
            $table->enum('statut', ['en_attente', 'valide', 'refuse', 'rembourse'])->default('en_attente');
            $table->date('date_paiement');
            $table->string('saison', 20)->nullable()->comment('Ex: 2024-2025');
            $table->string('recu_numero', 50)->nullable()->unique();
            $table->text('note')->nullable();
            $table->timestamps();
            
            // Index pour recherches rapides
            $table->index(['adherent_id', 'saison']);
            $table->index(['statut', 'date_paiement']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
