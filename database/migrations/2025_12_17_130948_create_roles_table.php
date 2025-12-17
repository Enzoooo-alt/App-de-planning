<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nom_role', 50)->unique();
            $table->timestamps();
        });

        // Insertion des rôles par défaut
        DB::table('roles')->insert([
            ['nom_role' => 'membre'],
            ['nom_role' => 'entraineur'],
            ['nom_role' => 'responsable_planning'],
            ['nom_role' => 'president']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
