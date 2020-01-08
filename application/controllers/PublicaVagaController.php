<?php
defined('BASEPATH') || exit('No direct script access allowed');

class PublicaVagaController extends CI_Controller
{

    public function VerRegistro()
    {
        if ($this->session->userdata(Constante::EMPRESA) == null) {
            $this->load->view(Constante::LOGIN_EMPRESA_VIEW);
            return;
        }
        $this->load->view('PublicarVagaView');
    }

    public function VerRegistros()
    {
        if ($this->session->userdata(Constante::EMPRESA) == null) {
            $this->load->view(Constante::LOGIN_EMPRESA_VIEW);
            return;
        }
        $this->load->view('PublicarVagaListaView');
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'empresa',
                Constante::LABEL => 'EMPRESA',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'cargo',
                Constante::LABEL => 'CARGO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'funcoes',
                Constante::LABEL => 'FUNÇÕES',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'beneficios',
                Constante::LABEL => 'BENEFÍCIOS',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'data_publicacao',
                Constante::LABEL => 'DATA DE PUBLICAÇÃO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'vagas',
                Constante::LABEL => 'VAGAS',
                Constante::RULES => 'required'
            ),
            array(
                Constante::FIELD => 'contrato',
                Constante::LABEL => 'CONTRATO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'salario',
                Constante::LABEL => 'SALÁRIO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'nivel_hierarquico',
                Constante::LABEL => 'NÍVEL HIERÁRQUICO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'area_interesse',
                Constante::LABEL => 'ÁREA DE INTERESSE',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'estado',
                Constante::LABEL => 'ESTADO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'cidade',
                Constante::LABEL => 'CIDADE',
                Constante::RULES => 'required|trim|mb_strtoupper'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view('PublicarVagaView', $regras);
            return;
        }
        $dados = array(
            "empresa" => $this->input->post('empresa'),
            "cargo" => $this->input->post('cargo'),
            "funcoes" => $this->input->post('funcoes'),
            "beneficios" => $this->input->post('beneficios'),
            "data_publicacao" => $this->input->post('data_publicacao'),
            "vagas" => $this->input->post('vagas'),
            "contrato" => $this->input->post('contrato'),
            "salario" => $this->input->post('salario'),
            "nivel_hierarquico" => $this->input->post('nivel_hierarquico'),
            "area_interesse" => $this->input->post('area_interesse'),
            "estado" => $this->input->post('estado'),
            "cidade" => $this->input->post('cidade')
        );
        $id = $this->input->post('id');
        if ($this->getPublicaVaga($id) == null) {

            $dadosNovos = array(
                "empresa" => $_SESSION['empresa']
            );
            $dados = $dados + $dadosNovos;
            $resultado = $this->PublicaVagaModel->InserirRegistro($dados);
        } else {
            $resultado = $this->PublicaVagaModel->AtualizarRegistro($dados, $id, $_SESSION['empresa']);
        }
        if ($resultado) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_GRAVADOS_SUCESSO;
            $dados[Constante::VOLTAR] = - 2;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_ERRO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function PesquisarRegistro()
    {
        $dados['cargo'] = $this->input->post('cargo');
        $dados['contrato'] = $this->input->post('contrato');
        $dados['salario'] = $this->input->post('salario');
        $dados['nivel_hierarquico'] = $this->input->post('nivel_hierarquico');
        $dados['area_interesse'] = $this->input->post('area_interesse');
        $dados['estado'] = $this->input->post('estado');
        $dados['cidade'] = $this->input->post('cidade');
        $resultado = $this->PublicaVagaModel->PesquisarRegistro($dados);
        $valores['lista'] = $resultado;
        if ($resultado) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_GRAVADOS_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view('VagasPesquisaView', $valores);
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_NAO_ENCONTRADO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function EditarRegistro($id = null)
    {
        $empresa = null;
        if ($this->session->userdata(Constante::USUARIO) !== null) {
            $empresa = $this->session->userdata(Constante::USUARIO);
        }
        if ($this->session->userdata(Constante::EMPRESA) == null) {
            $this->load->view(Constante::LOGIN_EMPRESA_VIEW);
        }
        $dados = $this->getPublicaVaga($id, $this->session->userdata(Constante::EMPRESA));
        if (count($dados) > 0) {
            $this->load->view('PublicarVagaView', $dados);
        } else if (count($dados) == 0) {
            $this->load->view('PublicarVagaView');
        } else {
            $dados[Constante::MENSAGEM] = "Registro não encontrado.";
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function ExcluirRegistro($id = null, $cnpj = null)
    {
        if ($this->PublicaVagaModel->ExcluirRegistro($id, null)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        }
    }

    public function getPublicaVaga($id = null, $empresa = null)
    {
        if (! $id) {
            return null;
        }
        $cadastros = $this->PublicaVagaModel->ObterRegistro($id);
        if ($cadastros->num_rows() > 0) {
            $dados['id'] = $cadastros->row()->id;
            $dados['empresa'] = $cadastros->row()->empresa;
            $dados['cargo'] = $cadastros->row()->cargo;
            $dados['funcoes'] = $cadastros->row()->funcoes;
            $dados['beneficios'] = $cadastros->row()->beneficios;
            $dados['data_publicacao'] = $cadastros->row()->data_publicacao;
            $dados['vagas'] = $cadastros->row()->vagas;
            $dados['contrato'] = $cadastros->row()->contrato;
            $dados['salario'] = $cadastros->row()->salario;
            $dados['nivel_hierarquico'] = $cadastros->row()->nivel_hierarquico;
            $dados['area_interesse'] = $cadastros->row()->area_interesse;
            $dados['estado'] = $cadastros->row()->estado;
            $dados['cidade'] = $cadastros->row()->cidade;
            return $dados;
        }
        return null;
    }
}