<?php
defined('BASEPATH') || exit('No direct script access allowed');

class HabilidadeController extends CI_Controller
{

    public function VerRegistro()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view(Constante::HABILIDADE_VIEW);
    }

    public function VerRegistros()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view('HabilidadeListaView');
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'conhecimento',
                Constante::LABEL => 'CONHECIMENTO',
                Constante::RULES => 'required|trim|mb_strtoupper|min_length[1]|max_length[20]'
            ),
            array(
                Constante::FIELD => 'nivel_conhecimento',
                Constante::LABEL => 'NÍVEL DE CONHECIMENTO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view(Constante::HABILIDADE_VIEW, $regras);
            return;
        }

        $dados = array(
            Constante::CONHECIMENTO => $this->input->post(Constante::CONHECIMENTO),
            Constante::NIVEL_CONHECIMENTO => $this->input->post(Constante::NIVEL_CONHECIMENTO)
        );

        $id = $this->input->post(Constante::ID);

        if ($id == '') {
            $dadosNovos = array(
                Constante::USUARIO => $this->session->userdata(Constante::USUARIO)
            );
            $dados = $dados + $dadosNovos;
            $resultado = $this->HabilidadeModel->InserirRegistro($dados);
        } else {
            $resultado = $this->HabilidadeModel->AtualizarRegistro($dados, $id, $this->session->userdata(Constante::USUARIO));
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

        $lista = $this->HabilidadeModel->ObterRegistro($id, $this->session->userdata(Constante::USUARIO), - 1, 0);
        $dados = array_shift($lista);

        if (count($dados) > 0) {
            $this->load->view(Constante::HABILIDADE_VIEW, $dados);
        } else if (count($dados) == 0) {
            $this->load->view(Constante::HABILIDADE_VIEW);
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_NAO_ENCONTRADO;
            $dados[Constante::VOLTAR] = - 2;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function ExcluirRegistro($id = null, $usuario = null)
    {
        if ($this->HabilidadeModel->ExcluirRegistro($id, $usuario)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        }
    }
}