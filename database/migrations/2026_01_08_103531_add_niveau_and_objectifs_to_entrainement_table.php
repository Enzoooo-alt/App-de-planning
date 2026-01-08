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
        Schema::table('entrainement', function (Blueprint $table) {
            $table->enum('niveau', ['debutant', 'intermediaire', 'avance', 'competition'])->nullable()->after('description');
            $table->text('objectifs')->nullable()->after('niveau');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entrainement', function (Blueprint $table) {
            $table->dropColumn(['niveau', 'objectifs']);
        });
    }
};
