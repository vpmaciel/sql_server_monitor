<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Escolaridade
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'PÓS DOUTORADO',
            2 => 'DOUTORADO',
            3 => 'MESTRADO',
            4 => 'ESPECIALIZAÇÃO',
            5 => 'SUPERIOR COMPLETO',
            6 => 'SUPERIOR INCOMPLETO',
            7 => 'SEGUNDO GRAU COMPLETO',
            8 => 'SEGUNDO GRAU INCOMPLETO',
            9 => 'PRIMEIRO GRAU COMPLETO',
            10 => 'PRIMEIRO GRAU INCOMPLETO'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}