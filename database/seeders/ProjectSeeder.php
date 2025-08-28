<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'Proyecto Demo',
            'description' => 'Este es un proyecto de ejemplo',
            'details' => json_encode([
                'texto' => 'Detalle extendido',
                'imagenes' => ['/images/demo1.jpg']
            ]),
            'address' => '123 George St, Sydney NSW',
            'expected_date' => now()->addDays(7)
        ]);
    }
}
