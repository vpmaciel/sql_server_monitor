<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Nacionalidade
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'BRASILEIRO(A) NATO (A)',
            2 => 'BRASILEIRO(A) NATURALIZADO (A)',
            3 => 'ESTRANGEIRO'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}