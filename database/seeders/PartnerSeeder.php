<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Campus Numérique',
            ],
            [
                'name' => 'Digital League'
            ],
            [
                'name' => 'VRA'
            ],
            [
                'name' => 'Département 26'
            ],
            [
                'name' => 'CPME'
            ],
            [
                'name' => 'Club Amplitude'
            ],
            [
                'name' => 'Portes de Drome Ardèche'
            ],
            [
                'name' => 'Lafuma'
            ],
            [
                'name' => 'Initiative France AURA'
            ],
            [
                'name' => "Soirée de l'engagement tout début décembre"
            ],
            [
                'name' => 'Evènement ESS'
            ],
            [
                'name' => 'FT Alpes'
            ],
            [
                'name' => 'CCI La Pépinière'
            ],
            [
                'name' => 'AURA Entreprise'
            ],
            [
                'name' => 'UCLY'
            ],
            [
                'name' => 'DREAL AuRA'
            ],
            [
                'name' => 'Le Cerema'
            ],
            [
                'name' => 'Institut Michel Serres'
            ],
            [
                'name' => 'French Tech Alpes Valence-Romans'
            ],
            [
                'name' => 'Romans cuir'
            ],
            [
                'name' => 'Lycée du Dauphiné'
            ],
            [
                'name' => 'UGA'
            ],
            [
                'name' => 'CEV'
            ],
            [
                'name' => 'Moulin Digital'
            ],
            [
                'name' => 'MEDEF'
            ],
            [
                'name' => 'LPO'
            ],
            [
                'name' => 'REDA'
            ],
            [
                'name' => 'ERB Le Club Rovaltain'
            ],
            [
                'name' => 'Esisar'
            ],
            [
                'name' => 'Crédit Mutuel'
            ]
        ];
        foreach ($partners as $partnerData) {
            Partner::create($partnerData);
        };
    }
}