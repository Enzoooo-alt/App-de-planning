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
        Schema::table('adherent', function (Blueprint $table) {
            $table->dropColumn('niveau');
        });
        
        Schema::table('adherent', function (Blueprint $table) {
            $table->enum('niveau', ['debutant', 'intermediaire', 'avance', 'competition'])->nullable()->after('adresse');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adherent', function (Blueprint $table) {
            $table->dropColumn('niveau');
        });
        
        Schema::table('adherent', function (Blueprint $table) {
            $table->enum('niveau', ['debutant', 'intermediaire', 'avance', 'expert'])->default('debutant')->after('adresse');
        });
    }
};
