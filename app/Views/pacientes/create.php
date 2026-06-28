<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Novo Paciente</h1>
    <a href="<?= site_url('pacientes') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Voltar
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="post" action="<?= site_url('pacientes') ?>">
            <?= csrf_field() ?>
            <?= $this->include('pacientes/_form') ?>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i> Cadastrar Paciente
                </button>
                <a href="<?= site_url('pacientes') ?>" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
