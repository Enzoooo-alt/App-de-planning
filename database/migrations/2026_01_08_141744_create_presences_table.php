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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seance_id')->constrained('seance')->onDelete('cascade');
            $table->foreignId('adherent_id')->constrained('adherent')->onDelete('cascade');
            $table->enum('statut', ['present', 'absent', 'excuse'])->default('absent');
            $table->text('note')->nullable()->comment('Note sur l\'absence ou autre remarque');
            $table->timestamps();
            
            // Empêcher les doublons (un adhérent ne peut être marqué qu'une fois par séance)
            $table->unique(['seance_id', 'adherent_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
