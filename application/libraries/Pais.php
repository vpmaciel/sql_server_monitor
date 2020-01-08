<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pais
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'BRASIL',
            2 => 'EXTERIOR'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}