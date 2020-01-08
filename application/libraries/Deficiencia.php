<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Deficiencia
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'NÃO',
            2 => 'MOTORA',
            3 => 'FÍSICA',
            4 => 'MENTAL',
            5 => 'AUDITIVA',
            6 => 'VISUAL',
            7 => 'FALA',
            8 => 'MÚLTIPLA'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}