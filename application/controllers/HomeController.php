<?php
defined('BASEPATH') || exit('No direct script access allowed');

class HomeController extends CI_Controller
{

    public function VerPagina()
    {
        $this->load->view('HomeView');
        
        echo "<br>Total: ". $this->UsuarioModel->ObterRegistro();
    }
}