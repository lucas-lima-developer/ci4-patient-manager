<?php

namespace App\Models;

use App\Entities\Paciente;
use CodeIgniter\Model;

class PacienteModel extends Model
{
    protected $table          = 'pacientes';
    protected $primaryKey     = 'id';
    protected $returnType     = Paciente::class;
    protected $useTimestamps  = true;
    protected $dateFormat     = 'datetime';

    protected $allowedFields = [
        'nome',
        'cpf',
        'data_nascimento',
        'telefone',
        'email',
        'plano_saude',
        'numero_carteirinha',
        'status',
    ];

    protected $validationRules = [
        // Necessário apenas para resolver o placeholder {id} usado em is_unique[...,id,{id}] no update.
        'id'                 => 'permit_empty|is_natural_no_zero',
        'nome'               => 'required|min_length[3]|max_length[150]',
        'cpf'                => 'required|exact_length[11]|valid_cpf|is_unique[pacientes.cpf,id,{id}]',
        'data_nascimento'    => 'required|valid_date[Y-m-d]',
        'telefone'           => 'permit_empty|max_length[20]',
        'email'              => 'permit_empty|valid_email|max_length[150]',
        'plano_saude'        => 'permit_empty|max_length[100]',
        'numero_carteirinha' => 'permit_empty|max_length[50]',
        'status'             => 'required|in_list[ativo,inativo]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required'   => 'Informe o nome do paciente.',
            'min_length' => 'O nome deve ter pelo menos 3 caracteres.',
        ],
        'cpf' => [
            'required'      => 'Informe o CPF do paciente.',
            'exact_length'  => 'O CPF deve conter 11 dígitos.',
            'valid_cpf'     => 'O CPF informado é inválido.',
            'is_unique'     => 'Este CPF já está cadastrado para outro paciente.',
        ],
        'data_nascimento' => [
            'required'   => 'Informe a data de nascimento.',
            'valid_date' => 'Informe uma data válida.',
        ],
        'email' => [
            'valid_email' => 'Informe um e-mail válido.',
        ],
        'status' => [
            'required' => 'Selecione o status do paciente.',
            'in_list'  => 'Status inválido.',
        ],
    ];

    public function search(string $termo): self
    {
        $digits = preg_replace('/\D/', '', $termo);

        $this->groupStart()
            ->like('nome', $termo)
            ->orLike('cpf', $digits !== '' ? $digits : $termo)
            ->groupEnd();

        return $this;
    }
}
