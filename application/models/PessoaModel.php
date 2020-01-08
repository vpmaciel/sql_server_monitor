<?php
defined('BASEPATH') || exit('No direct script access allowed');

class PessoaModel extends CI_Model
{

    public function InserirRegistro($dados = null)
    {
        if ($dados) {
            return ($this->db->insert('pessoa', $dados)) ? true : false;
        }
    }

    public function AtualizarRegistro($dados = null, $usuario = null)
    {
        if ($dados && $usuario) {
            $this->db->where(Constante::USUARIO, $usuario);
            return ($this->db->update('pessoa', $dados)) ? true : false;
        }
    }

    public function ObterRegistro($usuario = null)
    {
        if ($usuario) {
            $this->db->where(Constante::USUARIO, $usuario);
        }
        $this->db->order_by(Constante::USUARIO, 'asc');
        $cadastros = $this->db->get('pessoa');

        $lista = array();

        foreach ($cadastros->result() as $cadastro) {
            $dados = array();
            $dados[Constante::USUARIO] = $cadastro->usuario;
            $dados['nome'] = $cadastro->nome;
            $dados['ultimo_salario'] = $cadastro->ultimo_salario;
            $dados['data_nascimento'] = $cadastro->data_nascimento;
            $dados['idade'] = $cadastro->idade;
            $dados['sexo'] = $cadastro->sexo;
            $dados['escolaridade'] = $cadastro->escolaridade;
            $dados['estado_civil'] = $cadastro->estado_civil;
            $dados['nacionalidade'] = $cadastro->nacionalidade;
            $dados['fone_residencial_codigo_area'] = $cadastro->fone_residencial_codigo_area;
            $dados['fone_residencial_numero'] = $cadastro->fone_residencial_numero;
            $dados['celular_codigo_area'] = $cadastro->celular_codigo_area;
            $dados['celular_numero'] = $cadastro->celular_numero;
            $dados['possui_filhos'] = $cadastro->possui_filhos;
            $dados['possui_deficiencia'] = $cadastro->possui_deficiencia;
            $dados['pais'] = $cadastro->pais;
            $dados['estado'] = $cadastro->estado;
            $dados['cidade'] = $cadastro->cidade;
            $dados['bairro'] = $cadastro->bairro;
            $dados['logradouro'] = $cadastro->logradouro;
            $dados['complemento'] = $cadastro->complemento;
            $dados['cep'] = $cadastro->cep;
            $dados['cnh'] = $cadastro->cnh;
            $dados['empregado_atualmente'] = $cadastro->empregado_atualmente;
            $dados['disponivel_viagens'] = $cadastro->disponivel_viagens;
            $dados['trabalha_outras_cidades'] = $cadastro->trabalha_outras_cidades;
            $dados['possui_carro'] = $cadastro->possui_carro;
            $dados['possui_moto'] = $cadastro->possui_moto;
            $dados['trabalha_exterior'] = $cadastro->trabalha_exterior;
            array_push($lista, $dados);
        }
        return $lista;
    }

    public function get_totalRegistro()
    {
        $query = $this->db->query('SELECT * FROM pessoa');
        return $query->num_rows();
    }

    public function ExcluirRegistro($usuario = null)
    {
        if ($usuario) {
            return $this->db->where(Constante::USUARIO, $usuario)->delete('pessoa');
        }
    }
}