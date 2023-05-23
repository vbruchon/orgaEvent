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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('partners', 400)->nullable();
            $table->text('description', 150);
            $table->string('number_of_participants', 100);
            $table->string('location', 200)->nullable();

            $table->date('date_start');
            $table->date('date_end')->nullable();
            $table->time('hours')->nullable();
            $table->text('organizer_needs')->nullable();

            $table->foreignId('structure_id');
            $table->foreignId('status_id');
            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
