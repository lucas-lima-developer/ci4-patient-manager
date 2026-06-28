<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Pacientes</h1>
    <a href="<?= site_url('pacientes/new') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Novo Paciente
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="get" action="<?= site_url('pacientes') ?>" class="row g-2">
            <div class="col-sm-8 col-md-6">
                <input type="text" name="busca" class="form-control" placeholder="Buscar por nome ou CPF..." value="<?= esc($busca ?? '') ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-search"></i> Buscar
                </button>
                <?php if (! empty($busca)) : ?>
                    <a href="<?= site_url('pacientes') ?>" class="btn btn-outline-secondary">Limpar</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Nascimento</th>
                        <th>Telefone</th>
                        <th>Plano de Saúde</th>
                        <th>Status</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pacientes)) : ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Nenhum paciente encontrado.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($pacientes as $paciente) : ?>
                            <tr>
                                <td><?= esc($paciente->nome) ?></td>
                                <td><?= esc(format_cpf($paciente->cpf)) ?></td>
                                <td><?= esc(format_data_br($paciente->data_nascimento)) ?></td>
                                <td><?= esc(format_telefone($paciente->telefone)) ?></td>
                                <td><?= esc($paciente->plano_saude) ?></td>
                                <td><span class="badge <?= $paciente->getStatusBadgeClass() ?>"><?= $paciente->getStatusLabel() ?></span></td>
                                <td class="text-end">
                                    <a href="<?= site_url('pacientes/' . $paciente->id) ?>" class="btn btn-sm btn-outline-secondary" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?= site_url('pacientes/' . $paciente->id . '/edit') ?>" class="btn btn-sm btn-outline-primary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Excluir" data-bs-toggle="modal" data-bs-target="#deleteModal-<?= $paciente->id ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteModal-<?= $paciente->id ?>" tabindex="-1" aria-hidden="true">
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
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (isset($pager)) : ?>
        <div class="card-footer bg-white">
            <?= $pager->links('pacientes', 'pager_bootstrap') ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
