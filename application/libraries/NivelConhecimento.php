<?php
defined('BASEPATH') || exit('No direct script access allowed');

class NivelConhecimento
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'BÁSICO',
            2 => 'INTERMEDIÁRIO',
            3 => 'AVANÇADO'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}