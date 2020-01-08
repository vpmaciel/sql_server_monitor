<?php
defined('BASEPATH') || exit('No direct script access allowed');

class GerenteController extends CI_Controller
{

    public function VerPagina()
    {
        $this->load->view('gerenteView');
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'plano',
                Constante::LABEL => 'Plano',
                Constante::RULES => 'required|mb_strtoupper|trim'
            ),
            array(
                Constante::FIELD => 'senha',
                Constante::LABEL => 'Senha',
                Constante::RULES => 'required'
            ),
            array(
                Constante::FIELD => 'email',
                Constante::LABEL => 'E-email',
                Constante::RULES => 'required|valid_email|mb_strtolower|trim'
            ),
            array(
                Constante::FIELD => 'validadePlano',
                Constante::LABEL => 'Validade do plano',
                Constante::RULES => 'required'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view('PessoaView', $regras);
            return;
        }
        $dados = array(
            "plano" => $this->input->post('plano'),
            "validadePlano" => $this->input->post('validadePlano')
        );
        $senha = $this->input->post('senha');
        $email = $this->input->post('email');
        $resultado = null;
        if ($senha == '13041981') {
            $resultado = $this->PessoaModel->updatePlano($dados, $email);
        }
        if ($resultado) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_GRAVADOS_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_ERRO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function EditarRegistro()
    {
        if ($this->session->userdata(Constante::USUARIO) !== null) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $dados = $this->getPessoa($this->pessoa);
        if (count($dados) > 0) {
            $this->load->view('PessoaView', $dados);
        } else if (count($dados) == 0) {
            $this->load->view('PessoaView');
        } else {
            $dados[Constante::MENSAGEM] = "Registro não encontrado.";
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function ExcluirRegistro($id = null)
    {
        if ($this->PessoaModel->ExcluirRegistro($id)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        }
    }

    public function getPessoa($pessoa = null)
    {
        if (! $pessoa) {
            return null;
        }
        $cadastros = $this->PessoaModel->ObterRegistro($pessoa);
        if ($cadastros->num_rows() > 0) {
            $dados = array();
            $dados['nome'] = $cadastros->row()->nome;
            $dados['email'] = $cadastros->row()->email;
            $dados['pessoa'] = $cadastros->row()->pessoa;
            $dados['data_nascimento'] = $cadastros->row()->data_nascimento;
            $dados['idade'] = $cadastros->row()->idade;
            $dados['sexo'] = $cadastros->row()->sexo;
            $dados['escolaridade'] = $cadastros->row()->escolaridade;
            $dados['estado_civil'] = $cadastros->row()->estado_civil;
            $dados['nacionalidade'] = $cadastros->row()->nacionalidade;
            $dados['fone_residencial_codigo_area'] = $cadastros->row()->fone_residencial_codigo_area;
            $dados['fone_residencial_numero'] = $cadastros->row()->fone_residencial_numero;
            $dados['celular_codigo_area'] = $cadastros->row()->celular_codigo_area;
            $dados['celular_numero'] = $cadastros->row()->celular_numero;
            $dados['possui_filhos'] = $cadastros->row()->possui_filhos;
            $dados['possui_deficiencia'] = $cadastros->row()->possui_deficiencia;
            $dados['cor'] = $cadastros->row()->cor;
            $dados['pais'] = $cadastros->row()->pais;
            $dados['estado'] = $cadastros->row()->estado;
            $dados['cidade'] = $cadastros->row()->cidade;
            $dados['bairro'] = $cadastros->row()->bairro;
            $dados['logradouro'] = $cadastros->row()->logradouro;
            $dados['complemento'] = $cadastros->row()->complemento;
            $dados['cep'] = $cadastros->row()->cep;
            $dados['cnh'] = $cadastros->row()->cnh;
            $dados['empregado_atualmente'] = $cadastros->row()->empregado_atualmente;
            $dados['disponivel_viagens'] = $cadastros->row()->disponivel_viagens;
            $dados['trabalha_outras_cidades'] = $cadastros->row()->trabalha_outras_cidades;
            $dados['trabalha_exterior'] = $cadastros->row()->trabalha_exterior;
            return $dados;
        }
    }
}