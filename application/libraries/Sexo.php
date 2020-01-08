<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Sexo
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'MASCULINO',
            2 => 'FEMININO'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}