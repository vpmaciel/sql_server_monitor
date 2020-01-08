<?php
defined('BASEPATH') || exit('No direct script access allowed');

class FaleConoscoController extends CI_Controller
{

    public function VerPagina()
    {
        $this->load->view('FaleConoscoView');
    }
}