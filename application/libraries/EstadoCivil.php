<?php
defined('BASEPATH') || exit('No direct script access allowed');

class EstadoCivil
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'SOLTEIRO',
            2 => 'CASADO',
            3 => 'SEPARADO',
            4 => 'DIVORCIADO',
            5 => 'VIÚVO'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}