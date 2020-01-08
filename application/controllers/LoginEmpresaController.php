<?php
defined('BASEPATH') || exit('No direct script access allowed');

class LoginEmpresaController extends CI_Controller
{

    public function VerRegistro()
    {
        $this->load->view(Constante::LOGIN_EMPRESA_VIEW);
    }

    public function CriarSessao()
    {
        $this->session->unset_userdata(Constante::USUARIO);
        $this->session->unset_userdata(Constante::EMPRESA);

        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'email',
                Constante::LABEL => 'E-MAIL',
                Constante::RULES => 'required|valid_email|mb_strtolower|trim'
            ),
            array(
                Constante::FIELD => 'senha',
                Constante::LABEL => 'SENHA',
                Constante::RULES => 'required|trim|md5'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view(Constante::LOGIN_EMPRESA_VIEW, $regras);
            return;
        }
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');

        $empresa = $this->LoginEmpresaModel->criarSessao($email, $senha);

        if ($empresa) {
            $this->session->set_userdata(Constante::EMPRESA, $empresa);
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('d-m-Y H:i:s');
            $dados = array(
                'dataHoraUltimoAcesso' => $data
            );
            if ($this->session->userdata(Constante::EMPRESA) !== null) {
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