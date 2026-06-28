<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Paciente extends Entity
{
    protected $dates = ['data_nascimento', 'created_at', 'updated_at'];

    protected $casts = [
        'id' => 'integer',
    ];

    public function getStatusBadgeClass(): string
    {
        return $this->attributes['status'] === 'ativo' ? 'bg-success' : 'bg-secondary';
    }

    public function getStatusLabel(): string
    {
        return $this->attributes['status'] === 'ativo' ? 'Ativo' : 'Inativo';
    }
}
