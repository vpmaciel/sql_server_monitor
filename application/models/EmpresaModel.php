<?php
defined('BASEPATH') || exit('No direct script access allowed');

class EmpresaModel extends CI_Model
{

    public function InserirRegistro($dados = null)
    {
        if ($dados) {
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('Y-m-d H:i:s');
            $dataHoraCriacao = array(
                "dataHoraCriacao" => $data
            );
            $dados = $dados + $dataHoraCriacao;
            return ($this->db->insert('empresa', $dados)) ? true : false;
        }
    }

    public function AtualizarRegistro($dados = null, $id = null)
    {
        if ($dados && $id) {
            $this->db->where('id', $id);
            return ($this->db->update('empresa', $dados)) ? true : false;
        }
    }

    public function ObterRegistro($id = null, $email = null)
    {
        if ($email) {
            $this->db->where('email', $email);
            $this->db->order_by('id', 'desc');
            return $this->db->get('empresa');
        }
        if ($id) {
            $this->db->where('id', $id);
            $this->db->order_by('id', 'asc');
            return $this->db->get('empresa');
        }
        return null;
    }

    public function obter_totalRegistro()
    {
        $query = $this->db->query('SELECT * FROM empresa');
        return $query->num_rows();
    }

    public function deletaRegistro($id = null)
    {
        if ($id) {
            return $this->db->where('id', $id)->delete('empresa');
        }
    }
}