<?php

namespace App\Controllers;

use App\Models\PacienteModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Pacientes extends BaseController
{
    protected PacienteModel $pacienteModel;

    public function __construct()
    {
        $this->pacienteModel = new PacienteModel();
        helper('format');
    }

    public function index()
    {
        $busca = $this->request->getGet('busca');

        $query = $busca ? $this->pacienteModel->search($busca) : $this->pacienteModel;

        $pacientes = $query->orderBy('nome', 'asc')->paginate(10, 'pacientes');

        return view('pacientes/index', [
            'pacientes' => $pacientes,
            'pager'     => $this->pacienteModel->pager,
            'busca'     => $busca,
        ]);
    }

    public function show($id = null)
    {
        $paciente = $this->pacienteModel->find($id);

        if ($paciente === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('pacientes/show', ['paciente' => $paciente]);
    }

    public function new()
    {
        return view('pacientes/create', ['paciente' => null]);
    }

    public function create()
    {
        $data = $this->normalizeInput($this->request->getPost());

        if (! $this->pacienteModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->pacienteModel->errors());
        }

        return redirect()->to('/pacientes')->with('success', 'Paciente cadastrado com sucesso.');
    }

    public function edit($id = null)
    {
        $paciente = $this->pacienteModel->find($id);

        if ($paciente === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('pacientes/edit', ['paciente' => $paciente]);
    }

    public function update($id = null)
    {
        $paciente = $this->pacienteModel->find($id);

        if ($paciente === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data = $this->normalizeInput($this->request->getPost());
        // is_unique[pacientes.cpf,id,{id}] só ignora o próprio registro se 'id'
        // estiver presente no array validado; update() não injeta isso sozinho.
        $data['id'] = $id;

        if (! $this->pacienteModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->pacienteModel->errors());
        }

        return redirect()->to('/pacientes')->with('success', 'Paciente atualizado com sucesso.');
    }

    public function delete($id = null)
    {
        $paciente = $this->pacienteModel->find($id);

        if ($paciente === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->pacienteModel->delete($id);

        return redirect()->to('/pacientes')->with('success', 'Paciente excluído com sucesso.');
    }

    private function normalizeInput(array $data): array
    {
        $data['cpf'] = preg_replace('/\D/', '', (string) ($data['cpf'] ?? ''));
        $data['telefone'] = preg_replace('/\D/', '', (string) ($data['telefone'] ?? ''));

        return $data;
    }
}
