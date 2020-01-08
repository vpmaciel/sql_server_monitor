<?php
defined('BASEPATH') || exit('No direct script access allowed');

class UsuarioRecuperaSenhaController extends CI_Controller
{

    public function VerRegistro()
    {
        $this->load->view('UsuarioRecuperaSenhaView');
    }

    public function RecuperarSenha()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'email',
                Constante::LABEL => 'E-mail',
                Constante::RULES => 'required|valid_email|mb_strtolower|trim'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view('recuperar_senhaView', $regras);
            return;
        }
        $email = $this->input->post('email');
        if ($email) {
            $this->load->model('UsuarioModel');
            $cadastros = $this->UsuarioModel->ObterRegistro(NULL, $email);
            if ($cadastros->num_rows() > 0) {
                $dados = array();
                $dados['senha'] = $cadastros->row()->senha;
                $dados['email'] = $cadastros->row()->email;
                $mensagem = 'Uma senha foi enviada para ' . $dados['email'];
                $dados[Constante::MENSAGEM] = $mensagem;
                $dados[Constante::VOLTAR] = - 1;
                $this->EnviarEmail($dados);
                $this->load->view('sucesso', $dados);
            } else {
                $dados[Constante::MENSAGEM] = "Registro não encontrado.";
                $dados[Constante::VOLTAR] = - 1;
                $this->load->view(Constante::ERRO_VIEW, $dados);
            }
        }
    }

    public function EnviarEmail($parametros)
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'cebusca.suporte@gmail.com',
            'smtp_pass' => 'vpm12345',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('cebusca.suporte@gmail.com', 'CeBusca');
        $email_body = 'Sua senha é:' . $parametros['senha'];
        $list = array(
            $parametros['email']
        );
        $this->email->to($list);
        $this->email->subject('CeBusca Recuperação de Senha');
        $this->email->message($email_body);
        $this->email->set_mailtype("html");
        $this->email->send();
    }
}