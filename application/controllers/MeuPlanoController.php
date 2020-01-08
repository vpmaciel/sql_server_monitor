<?php
defined('BASEPATH') || exit('No direct script access allowed');

class MeuPlanoController extends CI_Controller
{

    public function VerRegistro()
    {
        $pessoa = null;
        if ($this->session->userdata(Constante::USUARIO) !== null) {
            $pessoa = $this->session->userdata(Constante::USUARIO);
        }
        if (! $pessoa) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view('MeuPlanoView');
    }
}