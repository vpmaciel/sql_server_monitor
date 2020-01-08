<?php
defined('BASEPATH') || exit('No direct script access allowed');

class CandidatoVagaModel extends CI_Model
{

    public function InserirRegistro($dados = null)
    {
        if ($dados) {
            return ($this->db->insert('candidato_vaga', $dados)) ? true : false;
        }
        return false;
    }

    public function AtualizarRegistro($dados = null, $publicacaoVaga = null, $usuario = null)
    {
        if ($dados) {
            if ($publicacaoVaga && $usuario) {
                $this->db->where('publicacao_vaga', $publicacaoVaga);
                $this->db->where(Constante::USUARIO, $usuario);
                return ($this->db->update('candidato_vaga', $dados)) ? true : false;
            }
        }
        return false;
    }

    public function ObterRegistro($publicacaoVaga = null, $usuario = null, $empresa = null, $qtde = 0, $inicio = 0)
    {
        if ($usuario) {
            $this->db->where(Constante::USUARIO, $usuario);
        }

        if ($empresa) {
            $this->db->where('empresa', $empresa);
        }

        if ($publicacaoVaga) {
            $this->db->where('publicacao_vaga', $publicacaoVaga);
        }

        if ($qtde > 0) {
            $this->db->limit($qtde, $inicio);
        }
        $this->db->order_by('publicacao_vaga', 'asc');

        $cadastros = $this->db->get('candidato_vaga');

        $lista = array();

        foreach ($cadastros->result() as $cadastro) {
            $dados = array();
            $dados[Constante::PUBLICACAO_VAGA] = $cadastro->publicacao_vaga;
            $dados[Constante::USUARIO] = $cadastro->usuario;
            $dados[Constante::EMPRESA] = $cadastro->empresa;
            array_push($lista, $dados);
        }
        return $lista;
    }

    public function ObterTotalRegistro()
    {
        $query = $this->db->query('SELECT * FROM candidato_vaga');
        return $query->num_rows();
    }

    public function ExcluirRegistro($publicacaoVaga = null, $usuario = null)
    {
        if ($publicacaoVaga && $usuario) {
            $this->db->where('publicacao_vaga', $publicacaoVaga);
            $this->db->where(Constante::USUARIO, $usuario);
            return $this->db->delete('candidato_vaga');
        }
    }
}