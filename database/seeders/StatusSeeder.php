<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            ['name' => 'En réfléxion'],
            ['name' => 'En cours de montage'],
            ['name' => 'Planifié']
        ];
        foreach($status as $s){
            Status::create($s);
        }
    }
}
