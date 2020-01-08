<?php 
defined('BASEPATH') || exit('No direct script access allowed');

class Anuncio
{
    private static $valor_array;
    
    function __construct()
    {
        
        self::$valor_array = array(
            1 => 'https://ello.co/enter',
            2 => 'https://myopportunity.com/en/signin',
            3 => 'https://vestibular.unoparead.com.br/inscricao/',
            4 => 'https://diasporabr.com.br/users/sign_in',
            5 => 'https://tips4java.wordpress.com/2013/03/03/smart-scrolling/',
            6 => 'https://www.freelancermap.com/registration',
            7 => 'https://web.whatsapp.com/',
            8 => 'http://www.cvengenharia.com.br/',
            9 => 'https://www.vagas.com.br/',
            10 => 'https://trampos.co/',
            11 => 'https://www.globo.com/',
            12 => 'https://www.r7.com/',
            13 => 'https://www.sbt.com.br/home/',
            14 => 'http://www.ufop.br/',
            15 => 'http://www.ufop.br/',
            16 => 'https://www.altillo.com/pt/universidades/brasil/estado/minasgerais.asp',
            17 => 'https://www.unip.br/Ead/Ensino/Cursos_Graduacao_Pos_Graduacao',
            18 => 'https://simulado.infoenem.com.br/',
            19 => 'https://fael.edu.br/cursos/graduacao',
            20 => 'https://www.faculdadeunica.com.br/',
            21 => 'http://www.igti.com.br/cursos/mba-em-projeto-de-aplicacoes-java/',
            22 => 'https://www.esab.edu.br/pos-graduacao-ead/mba-profissional/',
            23 => 'https://www.portalpos.com.br/',
            24 => 'https://claretiano.edu.br/',
            25 => 'https://www.uninter.com',
            26 => 'https://www.uninter.com/graduacao-ead/curso-relacoes-internacionais/',
            27 => 'http://www.cursosonlinesp.com.br/',
            28 => 'https://www.faculdadeunica.com.br/ead/graduacao/',
            29 => 'http://univirtus.uninter.com/ava/web/',
            30 => 'https://universidade.solides.com.br/course/people-analytics/#',
        );
    }

    public static function ObterValorArray()
    {
        return self::$valor_array;
    }
    
    public static function retornarArquivo() {
        return rand(1, 30);
    }
}