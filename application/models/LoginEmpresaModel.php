<?php
defined('BASEPATH') || exit('No direct script access allowed');

class LoginEmpresaModel extends CI_Model
{

    public function CriarSessao($email = null, $senha = null)
    {
        if ($email && $senha) {
            $this->db->where('email', $email);
            $this->db->where('senha', $senha);
            $cadastros = $this->db->get('empresa');
            if ($cadastros->num_rows() > 0) {
                return $cadastros->row()->id;
            } else {
                return false;
            }
        }
    }
}