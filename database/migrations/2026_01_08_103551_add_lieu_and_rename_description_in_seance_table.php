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
        Schema::table('seance', function (Blueprint $table) {
            $table->string('lieu')->default('Piscine Lyon Palme')->after('date_seance');
            $table->renameColumn('description', 'commentaires');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seance', function (Blueprint $table) {
            $table->dropColumn('lieu');
            $table->renameColumn('commentaires', 'description');
        });
    }
};
