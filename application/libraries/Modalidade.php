<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Modalidade
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'LICENCIATURA',
            2 => 'BACHARELADO',
            3 => 'MBA',
            4 => 'TECNOLÓGO',
            5 => 'TÉCNICO',
            6 => 'ENSINO MÉDIO',
            7 => 'ENSINO FUNDAMENTAL'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}