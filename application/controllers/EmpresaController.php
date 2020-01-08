<?php
defined('BASEPATH') || exit('No direct script access allowed');

class EmpresaController extends CI_Controller
{

    public function VerRegistro()
    {
        $this->load->view('EmpresaView');
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'email',
                Constante::LABEL => 'E-mail',
                Constante::RULES => 'required|valid_email|mb_strtolower|trim|is_unique[empresa.email]'
            ),
            array(
                Constante::FIELD => 'empresa',
                Constante::LABEL => 'Empresa',
                Constante::RULES => 'required|mb_strtoupper|trim|min_length[1]'
            ),
            array(
                Constante::FIELD => 'senha',
                Constante::LABEL => 'Senha',
                Constante::RULES => 'required|mb_strtoupper|trim|min_length[1]|max_length[10]'
            ),
            array(
                Constante::FIELD => 'confirmarSenha',
                Constante::LABEL => 'Confirmar senha',
                Constante::RULES => 'required|mb_strtoupper|trim|min_length[1]|max_length[10]|matches[senha]'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view('empresa', $regras);
            return;
        }
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d-m-Y H:i:s');
        $dados = array(
            "empresa" => $this->input->post('empresa'),
            "email" => $this->input->post('email'),
            "senha" => $this->input->post('senha'),
            "dataHoraUltimoAcesso" => $data
        );
        if ($this->EmpresaModel->InserirRegistro($dados)) {
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');
            if ($this->LoginEmpresaModel->CriarSessao($email, $senha)) {
                $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_GRAVADOS_SUCESSO;
                $dados[Constante::VOLTAR] = - 1;
                $this->load->view(Constante::SUCESSO_VIEW, $dados);
            }
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_ERRO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function EditarRegistro($id = null)
    {
        if (isset($_SESSION['empresa'])) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
        }
        $dados = $this->getEmpresa($id, $this->pessoa);
        if (count($dados) > 0) {
            $this->load->view('EmpresaView', $dados);
        } else if (count($dados) == 0) {
            $this->load->view('EmpresaView');
        } else {
            $dados[Constante::MENSAGEM] = "Registro não encontrado.";
            $dados[Constante::VOLTAR] = - 2;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function getEmpresa($pessoa = null)
    {
        if (! $id) {
            return null;
        }
        $this->load->model('EmpresaModel');
        $cadastros = $this->EmpresaModel->ObterRegistro($pessoa);
        if ($cadastros->num_rows() > 0) {
            $dados['email'] = $cadastros->row()->email;
            $dados['empresa'] = $cadastros->row()->empresa;
            $dados['senha'] = $cadastros->row()->senha;
            $dados['confirmarSenha'] = $cadastros->row()->senha;
            return $dados;
        }
        return null;
    }

    public function ExcluirRegistro($email = null)
    {
        if ($this->EmpresaModel->ExcluirRegistro($email)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        }
    }
}