<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Disciplina; // Importa o Model Disciplina

class DisciplinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disciplinas = [
            ['nome' => 'Matemática', 'sigla' => 'MAT'],
            ['nome' => 'Língua Portuguesa', 'sigla' => 'PORT'],
            ['nome' => 'História', 'sigla' => 'HIS'],
            ['nome' => 'Geografia', 'sigla' => 'GEO'],
            ['nome' => 'Ciências', 'sigla' => 'CIE'],
            ['nome' => 'Inglês', 'sigla' => 'ING'],
            ['nome' => 'Física', 'sigla' => 'FIS'],
            ['nome' => 'Química', 'sigla' => 'QUI'],
            ['nome' => 'Filosofia', 'sigla' => 'FIL'],
        ];

        foreach ($disciplinas as $disciplina) {
            Disciplina::firstOrCreate($disciplina);
        }
    }
}
