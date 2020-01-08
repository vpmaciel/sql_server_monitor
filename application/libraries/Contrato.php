<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Contrato
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'EFETIVO (CLT)',
            2 => 'ESTÁGIO',
            3 => 'TEMPORÁRIO',
            4 => 'AUTÔNOMO',
            5 => 'PRESTADOR DE SERVIÇOS (PJ)',
            6 => 'TRAINEE',
            7 => 'COOPERADO',
            8 => 'OUTROS'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}