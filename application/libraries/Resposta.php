<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Resposta
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'SIM',
            2 => 'NÃO'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}