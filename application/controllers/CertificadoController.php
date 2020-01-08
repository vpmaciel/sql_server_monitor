<?php
defined('BASEPATH') || exit('No direct script access allowed');

class CertificadoController extends CI_Controller
{

    public function VerRegistro()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view(Constante::CERTIFICADO_VIEW);
    }

    public function VerRegistros()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view(Constante::CERTIFICADO_LISTA_VIEW);
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => Constante::INSTITUICAO,
                Constante::LABEL => 'INSTITUIÇÃO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => Constante::CURSO,
                Constante::LABEL => 'CURSO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => Constante::CARGA_HORARIA,
                Constante::LABEL => 'CARGA HORÁRIA (HORAS)',
                Constante::RULES => 'required|trim|numeric|min_length[1]|max_length[4]'
            ),
            array(
                Constante::FIELD => Constante::ANO_CONCLUSAO,
                Constante::LABEL => 'ANO DE CONCLUSÃO',
                Constante::RULES => 'required|trim|numeric|min_length[4]|max_length[4]'
            )
        );

        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view(Constante::CERTIFICADO_VIEW, $regras);
            return;
        }

        $id = $this->input->post(Constante::ID);

        $dados = array(
            Constante::INSTITUICAO => $this->input->post(Constante::INSTITUICAO),
            Constante::CURSO => $this->input->post(Constante::CURSO),
            Constante::CARGA_HORARIA => $this->input->post(Constante::CARGA_HORARIA),
            Constante::ANO_CONCLUSAO => $this->input->post(Constante::ANO_CONCLUSAO)
        );
        if ($id == '') {
            $dadosNovos = array(
                Constante::USUARIO => $this->session->userdata(Constante::USUARIO)
            );
            $dados = $dados + $dadosNovos;
            $resultado = $this->CertificadoModel->InserirRegistro($dados);
        } else {
            $resultado = $this->CertificadoModel->AtualizarRegistro($dados, $id, $this->session->userdata(Constante::USUARIO));
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

    public function EditarRegistro($id = NULL)
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
        }
        $lista = $this->CertificadoModel->ObterRegistro($id, $this->session->userdata(Constante::USUARIO), - 1, 0);
        $dados = array_shift($lista);

        if (count($dados) > 0) {
            $this->load->view(Constante::CERTIFICADO_VIEW, $dados);
        } else if (count($dados) == 0) {
            $this->load->view(Constante::CERTIFICADO_VIEW);
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_REGISTRO_NAO_ENCONTRADO;
            $dados[Constante::VOLTAR] = - 2;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function ExcluirRegistro($id = NULL, $usuario = NULL)
    {
        if ($this->CertificadoModel->ExcluirRegistro($id, $usuario)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 2;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        }
    }
}