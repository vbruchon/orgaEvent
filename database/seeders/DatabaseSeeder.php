<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(StructureSeeder::class);
        $this->call(NumberOfParticipantsSeeder::class);
        $this->call(EventSeeder::class);
    }
}
