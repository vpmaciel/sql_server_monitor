<?php
defined('BASEPATH') || exit('No direct script access allowed');

class NivelHierarquico
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'ESTRATÉGICO OU INSTITUCIONAL',
            2 => 'TÁTICO OU INTERMEDIÁRIO',
            3 => 'GESTORES E SUPERVISORES',
            4 => 'OPERACIONAL'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}