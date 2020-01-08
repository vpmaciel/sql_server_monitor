<?php
defined('BASEPATH') || exit('No direct script access allowed');

class PretensaoSalarial
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'A COMBINAR',
            2 => 'ATÉ R$ 1.000,00',
            3 => 'DE R$ 1.000,00 ATÉ R$ 2.000,00',
            4 => 'DE R$ 2.000,00 ATÉ R$ 3.000,00',
            5 => 'DE R$ 3.000,00 ATÉ R$ 4.000,00',
            6 => 'DE R$ 4.000,00 ATÉ R$ 5.000,00',
            7 => 'DE R$ 5.000,00 ATÉ R$ 6.000,00',
            8 => 'DE R$ 6.000,00 ATÉ R$ 7.000,00',
            9 => 'DE R$ 7.000,00 ATÉ R$ 8.000,00',
            10 => 'DE R$ 8.000,00 ATÉ R$ 9.000,00',
            11 => 'DE R$ 9.000,00 ATÉ R$ 10.000,00',
            12 => 'DE R$ 10.000,00 ATÉ R$ 15.000,00',
            13 => 'DE R$ 15.000,00 ATÉ R$ 20.000,00',
            14 => 'DE R$ 20.000,00 ATÉ R$ 25.000,00',
            15 => 'DE R$ 25.000,00 ATÉ R$ 50.000,00',
            16 => 'ACIMA DE R$ 50.000,00'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}