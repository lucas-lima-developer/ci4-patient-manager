<?php

use CodeIgniter\I18n\Time;

if (! function_exists('format_cpf')) {
    function format_cpf(?string $cpf): string
    {
        $digits = preg_replace('/\D/', '', (string) $cpf);

        if (strlen($digits) !== 11) {
            return (string) $cpf;
        }

        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $digits);
    }
}

if (! function_exists('format_telefone')) {
    function format_telefone(?string $telefone): string
    {
        $digits = preg_replace('/\D/', '', (string) $telefone);

        if (strlen($digits) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $digits);
        }

        if (strlen($digits) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $digits);
        }

        return (string) $telefone;
    }
}

if (! function_exists('format_data_br')) {
    function format_data_br($date): string
    {
        if ($date instanceof Time) {
            return $date->format('d/m/Y');
        }

        if (empty($date)) {
            return '';
        }

        $timestamp = strtotime((string) $date);

        return $timestamp ? date('d/m/Y', $timestamp) : (string) $date;
    }
}
