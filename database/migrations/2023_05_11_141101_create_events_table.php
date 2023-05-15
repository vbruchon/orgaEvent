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
            $table->id()->nullable(false);
            $table->string('name', 150)->nullable(false);
            $table->text('description', 150)->nullable(false);
            $table->string('status', 50)->nullable(true);
            $table->string('number_of_participants', 100)->nullable(false);
            $table->date('date_start')->nullable(true);
            $table->date('date_end')->nullable(true);
            $table->date('expected_date_start')->nullable(true);
            $table->date('expected_date_end')->nullable(true);
            $table->time('hours_start')->nullable(false);
            $table->time('hours_end')->nullable(true);
            $table->text('organizer_needs')->nullable(true);
            $table->foreignId('structures_id')->nullable(false);
            $table->foreignId('partners_id')->nullable(true);
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
