<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePacientesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'cpf' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
            ],
            'data_nascimento' => [
                'type' => 'DATE',
            ],
            'telefone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'plano_saude' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'numero_carteirinha' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'default'    => 'ativo',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('cpf');
        $this->forge->addKey('nome');
        $this->forge->createTable('pacientes');
    }

    public function down()
    {
        $this->forge->dropTable('pacientes');
    }
}
