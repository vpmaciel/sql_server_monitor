<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Cnh
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'NÃO POSSUI',
            2 => 'A',
            3 => 'B',
            4 => 'C',
            5 => 'D',
            6 => 'E'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}