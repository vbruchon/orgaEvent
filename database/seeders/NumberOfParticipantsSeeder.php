<?php

namespace Database\Seeders;

use App\Models\NumberOfParticipants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NumberOfParticipantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numberOfParticipants = [
            ['name' => 'De 0 à 50 personnes'],
            ['name' => 'De 50 à 100 personnes'],
            ['name' => 'De 100 à 150 personnes'],
            ['name' => 'De 150 à 200 personnes'],
            ['name' => 'Plus de 200 personnes'],
        ];
        foreach($numberOfParticipants as $participants){
            NumberOfParticipants::create($participants);
        }
    }
}
