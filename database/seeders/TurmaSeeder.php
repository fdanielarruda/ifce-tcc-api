<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turma;

class TurmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $turmas = [
            ['titulo' => '1A', 'ano' => 1],
            ['titulo' => '2A', 'ano' => 2],
            ['titulo' => '3A', 'ano' => 3],
        ];

        foreach ($turmas as $turma) {
            Turma::firstOrCreate($turma);
        }
    }
}
