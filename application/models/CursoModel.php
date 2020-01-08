<?php
defined('BASEPATH') || exit('No direct script access allowed');

class CursoModel extends CI_Model
{

    public function InserirRegistro($dados = NULL)
    {
        if (! $dados) {
            return ($this->db->insert(Constante::CURSO, $dados));
        }
        return FALSE;
    }

    public function AtualizarRegistro($dados = NULL, $id = NULL, $usuario = NULL)
    {
        if ($dados) {
            if ($id && $usuario) {
                $this->db->where(Constante::ID, $id);
                $this->db->where(Constante::USUARIO, $usuario);
                return ($this->db->update(Constante::CURSO, $dados));
            }
        }
        return FALSE;
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

        $this->db->order_by(CONSTANTE::ANO_CONCLUSAO, 'desc');
        $cadastros = $this->db->get(Constante::CURSO);

        $lista = array();

        foreach ($cadastros->result() as $cadastro) {
            $dados = array();
            $dados[Constante::ID] = $cadastro->id;
            $dados[Constante::USUARIO] = $cadastro->usuario;
            $dados[Constante::INSTITUICAO] = $cadastro->instituicao;
            $dados[Constante::CURSO] = $cadastro->curso;
            $dados[Constante::ANO_INICIO] = $cadastro->ano_inicio;
            $dados[Constante::ANO_CONCLUSAO] = $cadastro->ano_conclusao;
            $dados[Constante::SITUACAO] = $cadastro->situacao;
            $dados[Constante::MODALIDADE] = $cadastro->modalidade;
            $dados[Constante::NIVEL] = $cadastro->nivel;

            array_push($lista, $dados);
        }
        return $lista;
    }

    public function ExcluirRegistro($id = NULL, $usuario = NULL)
    {
        if ($id && $usuario) {
            $this->db->where(Contante::ID, $id);
            $this->db->where(Constante::USUARIO, $usuario);
            return $this->db->delete(Constante::CURSO);
        }

        return FALSE;
    }
}