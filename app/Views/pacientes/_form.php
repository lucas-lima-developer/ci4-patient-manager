<?php
$errors = session()->getFlashdata('errors') ?? [];

function erroDoCampo(string $campo, array $errors): ?string
{
    return $errors[$campo] ?? null;
}
?>

<div class="row g-3">
    <div class="col-md-8">
        <label for="nome" class="form-label">Nome completo</label>
        <input type="text" class="form-control <?= erroDoCampo('nome', $errors) ? 'is-invalid' : '' ?>"
               id="nome" name="nome" maxlength="150" required
               value="<?= esc(old('nome', $paciente->nome ?? '')) ?>">
        <?php if ($erro = erroDoCampo('nome', $errors)) : ?>
            <div class="invalid-feedback"><?= esc($erro) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-4">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control <?= erroDoCampo('cpf', $errors) ? 'is-invalid' : '' ?>"
               id="cpf" name="cpf" maxlength="14" placeholder="Somente números" required
               value="<?= esc(old('cpf', isset($paciente) ? format_cpf($paciente->cpf) : '')) ?>">
        <?php if ($erro = erroDoCampo('cpf', $errors)) : ?>
            <div class="invalid-feedback"><?= esc($erro) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-4">
        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
        <input type="date" class="form-control <?= erroDoCampo('data_nascimento', $errors) ? 'is-invalid' : '' ?>"
               id="data_nascimento" name="data_nascimento" required
               value="<?= esc(old('data_nascimento', isset($paciente) && $paciente->data_nascimento ? $paciente->data_nascimento->format('Y-m-d') : '')) ?>">
        <?php if ($erro = erroDoCampo('data_nascimento', $errors)) : ?>
            <div class="invalid-feedback"><?= esc($erro) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-4">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control <?= erroDoCampo('telefone', $errors) ? 'is-invalid' : '' ?>"
               id="telefone" name="telefone" maxlength="20" placeholder="(11) 91234-5678"
               value="<?= esc(old('telefone', isset($paciente) ? format_telefone($paciente->telefone) : '')) ?>">
        <?php if ($erro = erroDoCampo('telefone', $errors)) : ?>
            <div class="invalid-feedback"><?= esc($erro) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-4">
        <label for="status" class="form-label">Status</label>
        <?php $statusAtual = old('status', $paciente->status ?? 'ativo'); ?>
        <select class="form-select <?= erroDoCampo('status', $errors) ? 'is-invalid' : '' ?>" id="status" name="status">
            <option value="ativo" <?= $statusAtual === 'ativo' ? 'selected' : '' ?>>Ativo</option>
            <option value="inativo" <?= $statusAtual === 'inativo' ? 'selected' : '' ?>>Inativo</option>
        </select>
        <?php if ($erro = erroDoCampo('status', $errors)) : ?>
            <div class="invalid-feedback"><?= esc($erro) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control <?= erroDoCampo('email', $errors) ? 'is-invalid' : '' ?>"
               id="email" name="email" maxlength="150"
               value="<?= esc(old('email', $paciente->email ?? '')) ?>">
        <?php if ($erro = erroDoCampo('email', $errors)) : ?>
            <div class="invalid-feedback"><?= esc($erro) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-3">
        <label for="plano_saude" class="form-label">Plano de Saúde</label>
        <input type="text" class="form-control <?= erroDoCampo('plano_saude', $errors) ? 'is-invalid' : '' ?>"
               id="plano_saude" name="plano_saude" maxlength="100"
               value="<?= esc(old('plano_saude', $paciente->plano_saude ?? '')) ?>">
        <?php if ($erro = erroDoCampo('plano_saude', $errors)) : ?>
            <div class="invalid-feedback"><?= esc($erro) ?></div>
        <?php endif; ?>
    </div>

    <div class="col-md-3">
        <label for="numero_carteirinha" class="form-label">Nº Carteirinha</label>
        <input type="text" class="form-control <?= erroDoCampo('numero_carteirinha', $errors) ? 'is-invalid' : '' ?>"
               id="numero_carteirinha" name="numero_carteirinha" maxlength="50"
               value="<?= esc(old('numero_carteirinha', $paciente->numero_carteirinha ?? '')) ?>">
        <?php if ($erro = erroDoCampo('numero_carteirinha', $errors)) : ?>
            <div class="invalid-feedback"><?= esc($erro) ?></div>
        <?php endif; ?>
    </div>
</div>
