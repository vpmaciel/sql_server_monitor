<?php
defined('BASEPATH') || exit('No direct script access allowed');

class HabilidadeModel extends CI_Model
{

    public function InserirRegistro($dados = null)
    {
        if ($dados) {
            return ($this->db->insert('habilidade', $dados)) ? true : false;
        }
        return false;
    }

    public function AtualizarRegistro($dados = null, $id = null, $usuario = null)
    {
        if ($dados) {
            if ($id && $usuario) {
                $this->db->where('id', $id);
                $this->db->where(Constante::USUARIO, $usuario);
                return ($this->db->update('habilidade', $dados)) ? true : false;
            }
        }
        return false;
    }

    public function ObterRegistro($id = null, $usuario = null, $qtde = 0, $inicio = 0)
    {
        if ($usuario) {
            $this->db->where(Constante::USUARIO, $usuario);
        }
        if ($id) {
            $this->db->where('id', $id);
        }
        if ($qtde > 0) {
            $this->db->limit($qtde, $inicio);
        }

        $this->db->order_by(Constante::CONHECIMENTO, 'asc');

        $cadastros = $this->db->get('habilidade');

        $lista = array();

        foreach ($cadastros->result() as $cadastro) {
            $dados = array();
            $dados[Constante::ID] = $cadastro->id;
            $dados[Constante::USUARIO] = $cadastro->usuario;
            $dados[Constante::CONHECIMENTO] = $cadastro->conhecimento;
            $dados[Constante::NIVEL_CONHECIMENTO] = $cadastro->nivel_conhecimento;
            array_push($lista, $dados);
        }
        return $lista;
    }

    public function ExcluirRegistro($id = null, $usuario = null)
    {
        if ($id && $usuario) {
            $this->db->where('id', $id);
            $this->db->where(Constante::USUARIO, $usuario);
            return $this->db->delete('habilidade');
        }
    }
}