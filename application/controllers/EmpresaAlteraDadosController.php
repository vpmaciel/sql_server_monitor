<?php
defined('BASEPATH') || exit('No direct script access allowed');

class EmpresaAlteraDadosController extends CI_Controller
{

    public function VerRegistro()
    {
        $cnpj = null;
        if ($this->session->userdata(Constante::EMPRESA) !== null) {
            $cnpj = $this->session->userdata(Constante::EMPRESA);
        }

        if (! $cnpj) {
            $dados[Constante::MENSAGEM] = "Você deve estar logado. Por favor, faça o Login primeiro.";
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        } else {
            $this->load->view('EmpresaAlteraDadosView');
        }
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'empresa',
                Constante::LABEL => 'Empresa',
                Constante::RULES => 'required|mb_strtoupper|trim'
            ),
            array(
                Constante::FIELD => 'email',
                Constante::LABEL => 'E-mail',
                Constante::RULES => 'required|valid_email|mb_strtolower|trim'
            ),
            array(
                Constante::FIELD => 'senha',
                Constante::LABEL => 'Senha',
                Constante::RULES => 'required|mb_strtoupper|trim|min_length[1]|max_length[32]|md5'
            ),
            array(
                Constante::FIELD => 'confirmarSenha',
                Constante::LABEL => 'Confirmar senha',
                Constante::RULES => 'required|mb_strtoupper|trim|min_length[1]|max_length[32]|matches[senha]|md5'
            )
        );
        $this->form_validation->set_rules($regras);

        if (! $this->form_validation->run()) {
            $this->load->view('EmpresaAlteraDadosView', $regras);
            return;
        }

        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d-m-Y H:i:s');
        $dados = array(
            "razao_social" => $this->input->post('razao_social'),
            "email" => $this->input->post('email'),
            "senha" => $this->input->post('senha'),
            "dataHoraUltimoAcesso" => $data
        );
        $id = $this->session->userdata(Constante::EMPRESA);

        if ($this->EmpresaModel->AtualizarRegistro($dados, $id)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_GRAVADOS_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view('sucesso', $dados);
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_ERRO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }
}