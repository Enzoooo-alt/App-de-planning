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
        Schema::create('plannings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('day'); // Lundi, Mardi, etc.
            $table->time('start_time');
            $table->time('end_time');
            $table->string('coach1');
            $table->string('coach2')->nullable();
            $table->text('description')->nullable();
            $table->integer('max_participants')->default(20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plannings');
    }
};
