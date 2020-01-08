<?php
defined('BASEPATH') || exit('No direct script access allowed');

class CertificadoModel extends CI_Model
{

    public function InserirRegistro($dados = null)
    {
        if ($dados) {
            return ($this->db->insert(Constante::CERTIFICADO, $dados));
        }
        return FALSE;
    }

    public function AtualizarRegistro($dados = null, $id = null, $usuario = null)
    {
        if ($dados) {
            if ($id && $usuario) {
                $this->db->where(Constante::ID, $id);
                $this->db->where(Constante::USUARIO, $usuario);
                return ($this->db->update(Constante::CERTIFICADO, $dados));
            }
        }
        return FALSE;
    }

    public function ObterRegistro($id = null, $usuario = null, $qtde = 0, $inicio = 0)
    {
        if ($usuario) {
            $this->db->where(Constante::USUARIO, $usuario);
        }
        if ($id) {
            $this->db->where(Constante::ID, $id);
        }

        if ($qtde > 0) {
            $this->db->limit($qtde, $inicio);
        }

        $this->db->order_by(Constante::ANO_CONCLUSAO, 'desc');
        $cadastros = $this->db->get(Constante::CERTIFICADO);

        $lista = array();

        foreach ($cadastros->result() as $cadastro) {
            $dados = array();
            $dados[Constante::ID] = $cadastro->id;
            $dados[Constante::USUARIO] = $cadastro->usuario;
            $dados[Constante::INSTITUICAO] = $cadastro->instituicao;
            $dados[Constante::CURSO] = $cadastro->curso;
            $dados[Constante::CARGA_HORARIA] = $cadastro->carga_horaria;
            $dados[Constante::ANO_CONCLUSAO] = $cadastro->ano_conclusao;
            array_push($lista, $dados);
        }
        return $lista;
    }

    public function ExcluirRegistro($id = null, $usuario = null)
    {
        if ($id && $usuario) {
            $this->db->where(Constante::ID, $id);
            $this->db->where(Constante::USUARIO, $usuario);
            return $this->db->delete(Constante::CERTIFICADO);
        }

        return FALSE;
    }
}