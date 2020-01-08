<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Situacao
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'CONCLUÍDO',
            2 => 'NÃO CONCLUÍDO',
            3 => 'EM ANDAMENTO'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}