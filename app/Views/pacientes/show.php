<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Detalhes do Paciente</h1>
    <a href="<?= site_url('pacientes') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h2 class="h5 mb-0"><?= esc($paciente->nome) ?></h2>
        <span class="badge <?= $paciente->getStatusBadgeClass() ?>"><?= $paciente->getStatusLabel() ?></span>
    </div>
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-4">CPF</dt>
            <dd class="col-sm-8"><?= esc(format_cpf($paciente->cpf)) ?></dd>

            <dt class="col-sm-4">Data de Nascimento</dt>
            <dd class="col-sm-8"><?= esc(format_data_br($paciente->data_nascimento)) ?></dd>

            <dt class="col-sm-4">Telefone</dt>
            <dd class="col-sm-8"><?= esc(format_telefone($paciente->telefone)) ?: '—' ?></dd>

            <dt class="col-sm-4">E-mail</dt>
            <dd class="col-sm-8"><?= esc($paciente->email) ?: '—' ?></dd>

            <dt class="col-sm-4">Plano de Saúde</dt>
            <dd class="col-sm-8"><?= esc($paciente->plano_saude) ?: '—' ?></dd>

            <dt class="col-sm-4">Número da Carteirinha</dt>
            <dd class="col-sm-8"><?= esc($paciente->numero_carteirinha) ?: '—' ?></dd>

            <dt class="col-sm-4">Cadastrado em</dt>
            <dd class="col-sm-8"><?= esc(format_data_br($paciente->created_at)) ?></dd>
        </dl>
    </div>
    <div class="card-footer bg-white d-flex gap-2">
        <a href="<?= site_url('pacientes/' . $paciente->id . '/edit') ?>" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <i class="bi bi-trash"></i> Excluir
        </button>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir o paciente <strong><?= esc($paciente->nome) ?></strong>? Esta ação não pode ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="post" action="<?= site_url('pacientes/' . $paciente->id . '/delete') ?>">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
