<?php

namespace App\Validation;

class CpfRules
{
    public function valid_cpf(?string $cpf, ?string &$error = null): bool
    {
        $digits = preg_replace('/\D/', '', (string) $cpf);

        if (strlen($digits) !== 11 || preg_match('/^(\d)\1{10}$/', $digits)) {
            $error = 'O CPF informado é inválido.';

            return false;
        }

        for ($pos = 9; $pos <= 10; $pos++) {
            $sum = 0;

            for ($i = 0; $i < $pos; $i++) {
                $sum += (int) $digits[$i] * (($pos + 1) - $i);
            }

            $remainder = $sum % 11;
            $checkDigit = $remainder < 2 ? 0 : 11 - $remainder;

            if ((int) $digits[$pos] !== $checkDigit) {
                $error = 'O CPF informado é inválido.';

                return false;
            }
        }

        return true;
    }
}
