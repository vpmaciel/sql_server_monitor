<?php
defined('BASEPATH') || exit('No direct script access allowed');

class PublicaVagaModel extends CI_Model
{

    public function InserirRegistro($dados = NULL)
    {
        if ($dados) {
            return $this->db->insert('publica_vaga', $dados);
        }
        return false;
    }

    public function AtualizarRegistro($dados = NULL, $id = NULL, $empresa = NULL)
    {
        if ($dados) {
            if ($id && $empresa) {
                $this->db->where('id', $id);
                $this->db->where('empresa', $empresa);
                return $this->db->update('publica_vaga', $dados);
            }
        }
        return false;
    }

    public function ObterRegistro($id = NULL, $empresa = NULL, $qtde = 0, $inicio = 0)
    {
        if ($empresa) {
            $this->db->where('empresa', $empresa);
        }
        if ($id) {
            $this->db->where('id', $id);
        }
        $this->db->order_by('cargo', 'asc');
        $cadastros = $this->db->get('publica_vaga');
        
        $lista = array();
        
        foreach ($cadastros->result() as $cadastro) {
            $dados = array();
            $dados[Constante::ID] = $cadastro->id;
            $dados[Constante::DATA_PUBLICACAO] = $cadastro->data_publicacao;
            $dados[Constante::CARGO] = $cadastro->cargo;
            $dados[Constante::EMPRESA] = $cadastro->empresa;
            $dados[Constante::RAZAO_SOCIAL] = $cadastro->razao_social;
            $dados[Constante::DATA_PUBLICACAO] = $cadastro->data_publicacao;
            $dados[Constante::VAGAS] = $cadastro->vagas;
            $dados[Constante::CONTRATO] = $cadastro->contrato;
            $dados[Constante::SALARIO] = $cadastro->salario;
            $dados[Constante::NIVEL_HIERARQUICO] = $cadastro->nivel_hierarquico;
            $dados[Constante::AREA_INTERESSE] = $cadastro->area_interesse;
            $dados[Constante::FUNCOES] = $cadastro->funcoes;
            $dados[Constante::BENEFICIOS] = $cadastro->beneficios;
            $dados[Constante::ESTADO] = $cadastro->estado;
            $dados[Constante::CIDADE] = $cadastro->cidade;
            
            array_push($lista, $dados);
        }
        return $lista;
    }

    public function obter_totalRegistro()
    {
        $query = $this->db->query('SELECT * FROM publica_vaga');
        return $query->num_rows();
    }

    public function PesquisarRegistro($dados)
    {
        if ($dados[Constante::CARGO]) {
            $this->db->where(Constante::CARGO, $dados[Constante::CARGO]);
        }
        if ($dados[Constante::CONTRATO]) {
            $this->db->where(Constante::CONTRATO, $dados[Constante::CONTRATO]);
        }
        if ($dados[Constante::SALARIO]) {
            $this->db->where(Constante::SALARIO, $dados[Constante::SALARIO]);
        }
        if ($dados[Constante::NIVEL_HIERARQUICO]) {
            $this->db->where(Constante::NIVEL_HIERARQUICO, $dados[Constante::NIVEL_HIERARQUICO]);
        }
        if ($dados[Constante::AREA_INTERESSE]) {
            $this->db->where(Constante::AREA_INTERESSE, $dados[Constante::AREA_INTERESSE]);
        }
        if ($dados[Constante::ESTADO]) {
            $this->db->where(Constante::ESTADO, $dados[Constante::ESTADO]);
        }
        if ($dados[Constante::CIDADE]) {
            $this->db->where(Constante::CIDADE, $dados[Constante::CIDADE]);
        }
        $this->db->order_by(Constante::CARGO, 'asc');
        $cadastros = $this->db->get('publica_vaga');
        
        $lista = array();
        
        foreach ($cadastros->result() as $cadastro) {
            $dados = array();
            $dados[Constante::ID] = $cadastro->id;
            $dados[Constante::DATA_PUBLICACAO] = $cadastro->data_publicacao;
            $dados[Constante::CARGO] = $cadastro->cargo;
            $dados[Constante::EMPRESA] = $cadastro->empresa;
            $dados[Constante::RAZAO_SOCIAL] = $cadastro->razao_social;
            $dados[Constante::DATA_PUBLICACAO] = $cadastro->data_publicacao;
            $dados[Constante::VAGAS] = $cadastro->vagas;
            $dados[Constante::CONTRATO] = $cadastro->contrato;
            $dados[Constante::SALARIO] = $cadastro->salario;
            $dados[Constante::NIVEL_HIERARQUICO] = $cadastro->nivel_hierarquico;
            $dados[Constante::AREA_INTERESSE] = $cadastro->area_interesse;
            $dados[Constante::FUNCOES] = $cadastro->funcoes;
            $dados[Constante::BENEFICIOS] = $cadastro->beneficios;
            $dados[Constante::ESTADO] = $cadastro->estado;
            $dados[Constante::CIDADE] = $cadastro->cidade;
            
            array_push($lista, $dados);
        }
        return $lista;
    }

    public function ExcluirRegistro($id = NULL, $empresa = NULL)
    {
        if ($id && $empresa) {
            $this->db->where('id', $id);
            $this->db->where('empresa', $empresa);
            return $this->db->delete('publica_vaga');
        }
        if ($id) {
            $this->db->where('publicacaoVaga', $id);
            return $this->db->delete('candidato_vaga');
        }
    }
}