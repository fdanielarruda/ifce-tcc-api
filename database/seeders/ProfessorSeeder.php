<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Professor;
use Faker\Factory as Faker;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt_BR');

        for ($i = 0; $i < 15; $i++) {
            $nomeCompleto = $faker->firstName() . ' ' . $faker->lastName();

            Professor::create([
                'nome' => $nomeCompleto,
                'email' => strtolower(str_replace(' ', '.', $nomeCompleto)) . '@escolaexemplo.com.br',
            ]);
        }
    }
}
