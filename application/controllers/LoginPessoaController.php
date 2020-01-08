<?php
defined('BASEPATH') || exit('No direct script access allowed');

class LoginPessoaController extends CI_Controller
{

    public function VerRegistro()
    {
        $this->load->view(Constante::LOGIN_PESSOA_VIEW);
    }

    public function DestruirSessao()
    {
        $destruiSessao = FALSE;
        if ($this->session->userdata(Constante::USUARIO) !== null) {
            $this->session->unset_userdata(Constante::USUARIO);
            $destruiSessao = TRUE;
        }
        if ($this->session->userdata(Constante::EMPRESA) !== null) {
            $this->session->unset_userdata(Constante::EMPRESA);
            $destruiSessao = TRUE;
        }

        if (! $destruiSessao) {
            $dados[Constante::MENSAGEM] = 'Você não está logado !';
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
            return;
        }

        $this->session->sess_destroy();

        $dados[Constante::MENSAGEM] = 'Logoff efetuado com sucesso !';
        $dados[Constante::VOLTAR] = - 1;
        $this->load->view(Constante::SUCESSO_VIEW, $dados);
    }

    public function CriarSessao()
    {
        $this->session->unset_userdata(Constante::USUARIO);
        $this->session->unset_userdata(Constante::EMPRESA);

        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'email',
                Constante::LABEL => 'E-mail',
                Constante::RULES => 'required|valid_email|mb_strtolower|trim'
            ),
            array(
                Constante::FIELD => 'senha',
                Constante::LABEL => 'Senha',
                Constante::RULES => 'required|trim|md5'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW, $regras);
            return;
        }
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');

        $idUsuario = $this->LoginPessoaModel->criarSessao($email, $senha);

        if ($this->LoginPessoaModel->CriarSessao($email, $senha)) {
            $this->session->set_userdata(Constante::USUARIO, $idUsuario);

            date_default_timezone_set('America/Sao_Paulo');
            $data = date('d-m-Y');
            $dados = array(
                "data_ultimo_acesso" => $data
            );

            if ($this->UsuarioModel->AtualizarRegistro($dados, $this->session->userdata(Constante::USUARIO))) {
                $dados[Constante::MENSAGEM] = "Login efetuado com sucesso!";
                $dados[Constante::VOLTAR] = - 1;
                $this->load->view(Constante::SUCESSO_VIEW, $dados);
            } else {
                $dados[Constante::MENSAGEM] = Constante::MSG_ERRO;
                $dados[Constante::VOLTAR] = - 1;
                $this->load->view(Constante::ERRO_VIEW, $dados);
            }
        } else {
            $dados[Constante::MENSAGEM] = "Registro não encontrado !";
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }
}