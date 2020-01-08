<?php
defined('BASEPATH') || exit('No direct script access allowed');

class ObjetivoProfissionalController extends CI_Controller
{

    public function VerRegistro()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view(Constante::OBJETIVO_PROFISSIONAL_VIEW);
    }

    public function VerRegistros()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view('ObjetivoProfissionalListaView');
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'cargo',
                Constante::LABEL => 'CARGO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'pretensao_salarial',
                Constante::LABEL => 'PRETENSÃO SALARIAL',
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
                Constante::FIELD => 'contrato',
                Constante::LABEL => 'CONTRATO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            )
        );
        $this->form_validation->set_rules($regras);

        if (! $this->form_validation->run()) {
            $this->load->view(Constante::OBJETIVO_PROFISSIONAL_VIEW, $regras);
            return;
        }

        $dados = array(
            Constante::CARGO => $this->input->post(Constante::CARGO),
            Constante::PRETENSAO_SALARIAL => $this->input->post(Constante::PRETENSAO_SALARIAL),
            Constante::NIVEL_HIERARQUICO => $this->input->post(Constante::NIVEL_HIERARQUICO),
            Constante::AREA_INTERESSE => $this->input->post(Constante::AREA_INTERESSE),
            Constante::CONTRATO => $this->input->post(Constante::CONTRATO)
        );

        $id = $this->input->post(Constante::ID);

        if ($id == '') {
            $dadosNovos = array(
                Constante::USUARIO => $this->session->userdata(Constante::USUARIO)
            );
            $dados = $dados + $dadosNovos;
            $resultado = $this->ObjetivoProfissionalModel->InserirRegistro($dados);
        } else {
            $resultado = $this->ObjetivoProfissionalModel->AtualizarRegistro($dados, $id, $this->session->userdata(Constante::USUARIO));
        }
        if ($resultado) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_GRAVADOS_SUCESSO;
            $dados[Constante::VOLTAR] = - 2;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_ERRO;
            $dados[Constante::VOLTAR] = - 2;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function EditarRegistro($id = null)
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
        }

        $lista = $this->ObjetivoProfissionalModel->ObterRegistro($id, $this->session->userdata(Constante::USUARIO), - 1, 0);
        $dados = array_shift($lista);

        if (count($dados) > 0) {
            $this->load->view(Constante::OBJETIVO_PROFISSIONAL_VIEW, $dados);
        } else if (count($dados) == 0) {
            $this->load->view(Constante::OBJETIVO_PROFISSIONAL_VIEW);
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_NAO_ENCONTRADO;
            $dados[Constante::VOLTAR] = - 2;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function ExcluirRegistro($id = null, $usuario = null)
    {
        if ($this->ObjetivoProfissionalModel->ExcluirRegistro($id, $usuario)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        }
    }
}