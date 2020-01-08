<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Estado
{

    private static $valor_array;

    function __construct()
    {
        self::$valor_array = array(
            1 => 'ACRE',
            2 => 'ALAGOAS',
            3 => 'AMAPÁ',
            4 => 'AMAZONAS',
            5 => 'BAHIA',
            6 => 'CEARÁ',
            7 => 'DISTRITO FEDERAL',
            8 => 'ESPÍRITO SANTO',
            9 => 'GOIÁS',
            10 => 'MARANHÃO',
            11 => 'MATO GROSSO',
            12 => 'MATO GROSSO DO SUL',
            13 => 'MINAS GERAIS',
            14 => 'PARÁ',
            15 => 'PARAÍBA',
            16 => 'PARANÁ',
            17 => 'PERNAMBUCO',
            18 => 'PIAUÍ',
            19 => 'RIO DE JANEIRO',
            20 => 'RIO GRANDE DO NORTE',
            21 => 'RIO GRANDE DO SUL',
            22 => 'RONDÔNIA',
            23 => 'RORAIMA',
            24 => 'SANTA CATARINA',
            25 => 'SÃO PAULO',
            26 => 'SERGIPE',
            27 => 'TOCANTINS',
            28 => 'OUTRO'
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
}