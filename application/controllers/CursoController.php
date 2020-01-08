<?php
defined('BASEPATH') || exit('No direct script access allowed');

class CursoController extends CI_Controller
{

    public function VerRegistro()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view(Constante::CURSO_VIEW);
    }

    public function VerRegistros()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view(Constante::CURSO_LISTA_VIEW);
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => Constante::INSTITUICAO,
                Constante::LABEL => 'INSTITUIÇAO',
                Constante::RULES => 'required|trim|mb_strtoupper|min_length[1]|max_length[50]'
            ),
            array(
                Constante::FIELD => Constante::CURSO,
                Constante::LABEL => 'CURSO',
                Constante::RULES => 'required|trim|mb_strtoupper|min_length[1]|max_length[50]'
            ),
            array(
                Constante::FIELD => Constante::ANO_INICIO,
                Constante::LABEL => 'ANO DE INÍCIO',
                Constante::RULES => 'required|trim|numeric'
            ),
            array(
                Constante::FIELD => Constante::ANO_CONCLUSAO,
                Constante::LABEL => 'ANO DE CONCLUSÃO',
                Constante::RULES => 'required|trim|numeric'
            ),
            array(
                Constante::FIELD => Constante::SITUACAO,
                Constante::LABEL => 'SITUAÇÃO',
                Constante::RULES => 'required|mb_strtoupper'
            ),
            array(
                Constante::FIELD => Constante::MODALIDADE,
                Constante::LABEL => 'MODALIDADE',
                Constante::RULES => 'required|mb_strtoupper'
            ),
            array(
                Constante::FIELD => Constante::NIVEL,
                Constante::LABEL => 'NÍVEL',
                Constante::RULES => 'required|mb_strtoupper'
            )
        );

        $this->form_validation->set_rules($regras);

        if (! $this->form_validation->run()) {
            $this->load->view(Constante::CURSO_VIEW, $regras);
            return;
        }

        $dados = array(
            Constante::INSTITUICAO => $this->input->post(Constante::INSTITUICAO),
            Constante::CURSO => $this->input->post(Constante::CURSO),
            Constante::ANO_INICIO => $this->input->post(Constante::ANO_INICIO),
            Constante::ANO_CONCLUSAO => $this->input->post(Constante::ANO_CONCLUSAO),
            Constante::SITUACAO => $this->input->post(Constante::SITUACAO),
            Constante::MODALIDADE => $this->input->post(Constante::MODALIDADE),
            Constante::NIVEL => $this->input->post(Constante::NIVEL)
        );

        $id = $this->input->post(Constante::ID);

        if ($id == '') {
            $dadosNovos = array(
                Constante::USUARIO => $this->session->userdata(Constante::USUARIO)
            );
            $dados = $dados + $dadosNovos;
            $resultado = $this->CursoModel->InserirRegistro($dados);
        } else {
            $resultado = $this->CursoModel->AtualizarRegistro($dados, $id, $this->session->userdata(Constante::USUARIO));
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

        $lista = $this->CursoModel->ObterRegistro($id, $this->session->userdata(Constante::USUARIO), - 1, 0);
        $dados = array_shift($lista);

        if (count($dados) > 0) {
            $this->load->view(Constante::CURSO_VIEW, $dados);
        } else if (count($dados) == 0) {
            $this->load->view(Constante::CURSO_VIEW);
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_NAO_ENCONTRADO;
            $dados[Constante::VOLTAR] = - 2;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function ExcluirRegistro($id = null, $usuario = null)
    {
        if ($this->CursoModel->ExcluirRegistro($id, $usuario)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        }
    }
}