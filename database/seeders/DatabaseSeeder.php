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
        $this->call(PartnerSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(StatusSeeder::class);
    }
}
