<?php
defined('BASEPATH') || exit('No direct script access allowed');

class ObjetivoProfissionalModel extends CI_Model
{

    public function InserirRegistro($dados = NULL)
    {
        if ($dados) {
            return $this->db->insert(Constante::OBJETIVO_PROFISSIONAL, $dados);
        }
        return false;
    }

    public function AtualizarRegistro($dados = NULL, $id = NULL, $usuario = NULL)
    {
        if ($dados) {
            if ($id && $usuario) {
                $this->db->where(Constante::ID, $id);
                $this->db->where(Constante::USUARIO, $usuario);
                return $this->db->update(Constante::OBJETIVO_PROFISSIONAL, $dados);
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

        $this->db->order_by(Constante::CARGO, 'asc');
        $cadastros = $this->db->get(Constante::OBJETIVO_PROFISSIONAL);

        $lista = array();

        foreach ($cadastros->result() as $cadastro) {
            $dados = array();
            $dados[Constante::ID] = $cadastro->id;
            $dados[Constante::CARGO] = $cadastros->row()->cargo;
            $dados[Constante::PRETENSAO_SALARIAL] = $cadastros->row()->pretensao_salarial;
            $dados[Constante::NIVEL_HIERARQUICO] = $cadastros->row()->nivel_hierarquico;
            $dados[Constante::AREA_INTERESSE] = $cadastros->row()->area_interesse;
            $dados[Constante::CONTRATO] = $cadastros->row()->contrato;
            array_push($lista, $dados);
        }
        return $lista;
    }

    public function ExcluirRegistro($id = NULL, $usuario = NULL)
    {
        if ($id && $usuario) {
            $this->db->where(Constante::ID, $id);
            $this->db->where(Constante::USUARIO, $usuario);
            return $this->db->delete(Constante::OBJETIVO_PROFISSIONAL);
        }
    }
}