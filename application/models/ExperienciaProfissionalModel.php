<?php
defined('BASEPATH') || exit('No direct script access allowed');

class ExperienciaProfissionalModel extends CI_Model
{

    public function InserirRegistro($dados = NULL)
    {
        if ($dados) {
            return $this->db->insert(Constante::EXPERIENCIA_PROFISSIONAL, $dados);
        }
        return false;
    }

    public function AtualizarRegistro($dados = NULL, $id = NULL, $usuario = NULL)
    {
        if ($dados) {
            if ($id && $usuario) {
                $this->db->where(Constante::ID, $id);
                $this->db->where(Constante::USUARIO, $usuario);
                return $this->db->update(Constante::EXPERIENCIA_PROFISSIONAL, $dados);
            }
        }
        return false;
    }

    public function ObterRegistro($id = NULL, $usuario = NULL, $qtde = 0, $inicio = 0)
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

        $this->db->order_by(Constante::ID, 'asc');

        $cadastros = $this->db->get(Constante::EXPERIENCIA_PROFISSIONAL);

        $lista = array();

        foreach ($cadastros->result() as $cadastro) {
            $dados = array();
            $dados[Constante::ID] = $cadastro->id;
            $dados[Constante::EMPRESA] = $cadastro->empresa;
            $dados[Constante::CARGO] = $cadastro->cargo;
            $dados[Constante::DATA_ADMISSAO] = $cadastro->data_admissao;
            $dados[Constante::DATA_SAIDA] = $cadastro->data_saida;
            $dados[Constante::NIVEL_HIERARQUICO] = $cadastro->nivel_hierarquico;
            $dados[Constante::FUNCOES] = $cadastro->funcoes;
            array_push($lista, $dados);
        }
        return $lista;
    }

    public function ExcluirRegistro($id = NULL, $usuario = NULL)
    {
        if ($id && $usuario) {
            $this->db->where(Constante::ID, $id);
            $this->db->where(Constante::USUARIO, $usuario);
            return $this->db->delete(Constante::EXPERIENCIA_PROFISSIONAL);
        }
    }
}