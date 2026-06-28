<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PacienteSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('pt_BR');

        $planos = ['Unimed', 'Amil', 'Bradesco Saúde', 'SulAmérica', 'Hapvida', 'Particular'];

        for ($i = 0; $i < 20; $i++) {
            $this->db->table('pacientes')->insert([
                'nome'               => $faker->name(),
                'cpf'                => preg_replace('/\D/', '', $faker->cpf(false)),
                'data_nascimento'    => $faker->date('Y-m-d', '2005-01-01'),
                'telefone'           => preg_replace('/\D/', '', $faker->cellphoneNumber()),
                'email'              => $faker->safeEmail(),
                'plano_saude'        => $faker->randomElement($planos),
                'numero_carteirinha' => $faker->numerify('##########'),
                'status'             => $faker->boolean(80) ? 'ativo' : 'inativo',
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
