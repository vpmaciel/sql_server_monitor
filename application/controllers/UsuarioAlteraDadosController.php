<?php
defined('BASEPATH') || exit('No direct script access allowed');

class UsuarioAlteraDadosController extends CI_Controller
{

    public function VerRegistro()
    {
        $pessoa = null;
        if ($this->session->userdata(Constante::USUARIO) !== null) {
            $pessoa = $this->session->userdata(Constante::USUARIO);
        }
        if (! $pessoa) {
            $dados[Constante::MENSAGEM] = "Você deve estar logado. Por favor, faça o Login primeiro.";
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        } else {
            $this->load->view('UsuarioAlteraDadosView');
        }
    }

    public function AtualizarRegistro()
    {
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
                Constante::RULES => 'required|strtoupper|trim|min_length[1]|max_length[10]|md5'
            ),
            array(
                Constante::FIELD => 'confirmarSenha',
                Constante::LABEL => 'CONFIRMAR SENHA',
                Constante::RULES => 'required|strtoupper|trim|min_length[1]|max_length[10]|matches[senha]|md5'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view('UsuarioAlteraDadosView', $regras);
            return;
        }
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');
        $dados = array(
            "email" => $this->input->post('email'),
            "senha" => $this->input->post('senha'),
            "dataHoraUltimoAcesso" => $data
        );
        $usuario = null;
        if ($this->session->userdata(Constante::USUARIO) !== null) {
            $usuario = $this->session->userdata(Constante::USUARIO);
        }
        if ($this->PessoaModel->ObterRegistro($usuario, null)) {
            if ($this->UsuarioModel->AtualizarRegistro($dados, $usuario)) {
                $this->session->unset_userdata(Constante::USUARIO);
                session_destroy();
                $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_GRAVADOS_SUCESSO;
                $dados[Constante::VOLTAR] = - 1;
                $this->load->view(Constante::SUCESSO_VIEW, $dados);
            } else {
                $dados[Constante::MENSAGEM] = Constante::MSG_ERRO;
                $dados[Constante::VOLTAR] = - 1;
                $this->load->view(Constante::ERRO_VIEW, $dados);
            }
        }
    }
}
