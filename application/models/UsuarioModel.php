<?php
defined('BASEPATH') || exit('No direct script access allowed');

class UsuarioModel extends CI_Model
{

    public function InserirRegistro($dados = null)
    {
        if ($dados) {
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('d-m-Y H:i:s');
            $dataHoraCriacao = array(
                "dataHoraCriacao" => $data
            );
            $dados = $dados + $dataHoraCriacao;
            return ($this->db->insert(Constante::USUARIO, $dados)) ? true : false;
        }
    }

    public function AtualizarRegistro($dados = null, $pessoa = null)
    {
        if ($dados && $pessoa) {
            $this->db->where('id', $pessoa);
            return ($this->db->update(Constante::USUARIO, $dados)) ? true : false;
        }
    }

    public function ObterRegistro($id = null, $email = null)
    {
        $cadastros = array();
        
        if ($email) {
            $this->db->where('email', $email);
            $this->db->order_by('id', 'desc');
            $cadastros = $this->db->get(Constante::USUARIO);
        }
        if ($id) {
            $this->db->where('id', $id);
            $this->db->order_by('id', 'asc');
            $cadastros = $this->db->get(Constante::USUARIO);
        }
        $lista = array();
        
        foreach ($cadastros->result() as $cadastro) {
            $dados = array();
            $dados[Constante::ID] = $cadastro->id;
            $dados[Constante::E_MAIL] = $cadastro->email;
            $dados[Constante::SENHA] = $cadastro->senha;
            $dados[Constante::DATA_CRIACAO] = $cadastro->data_criacao;
            $dados[Constante::DATA_ULTIMO_ACESSO] = $cadastro->data_ultimo_acesso;
            
            array_push($lista, $dados);
        }
        return $lista;
    }

    public function ExcluirRegistro($pessoa = null)
    {
        if ($pessoa) {
            return $this->db->where('id', $pessoa)->delete(Constante::USUARIO);
        }
    }
}