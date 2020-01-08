<?php
defined('BASEPATH') || exit('No direct script access allowed');

class UsuarioController extends CI_Controller
{

    public function VerRegistro()
    {
        $this->load->view('UsuarioView');
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'email',
                Constante::LABEL => 'E-MAIL',
                Constante::RULES => 'required|valid_email|mb_strtolower|is_unique[usuario.email]'
            ),
            array(
                Constante::FIELD => 'senha',
                Constante::LABEL => 'SENHA',
                Constante::RULES => 'required|mb_strtoupper|trim|min_length[1]|max_length[10]'
            ),
            array(
                Constante::FIELD => 'confirmarSenha',
                Constante::LABEL => 'CONFIRMAR SENHA',
                Constante::RULES => 'required|mb_strtoupper|trim|min_length[1]|max_length[10]|matches[senha]'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view('usuarioView', $regras);
            return;
        }
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d-m-Y H:i:s');
        $dados = array(
            "email" => $this->input->post('email'),
            "senha" => $this->input->post('senha'),
            "dataHoraUltimoAcesso" => $data
        );
        if ($this->getUsuario($this->session->userdata(Constante::USUARIO)) == null) {
            $resultado = $this->UsuarioModel->InserirRegistro($dados);
        } else {
            $resultado = $this->UsuarioModel->AtualizarRegistro($dados, $this->session->userdata(Constante::USUARIO));
        }
        if ($resultado) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_GRAVADOS_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_ERRO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function EditarRegistro($pessoa = null)
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $dados = $this->getUsuario($this->session->userdata(Constante::USUARIO));
        if (count($dados) > 0) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW, $dados);
        } else if (count($dados) == 0) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
        } else {
            $dados[Constante::MENSAGEM] = "Registro não encontrado.";
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function ExcluirRegistro($pessoa = null)
    {
        if ($this->UsuarioModel->ExcluirRegistro($pessoa)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        }
    }

    public function getUsuario($pessoa = null)
    {
        if (! $pessoa) {
            return null;
        }
        $this->load->model('UsuarioModel');
        $cadastros = $this->UsuarioModel->ObterRegistro($pessoa);
        if ($cadastros->num_rows() > 0) {
            $dados['id'] = $cadastros->row()->id;
            $dados['email'] = $cadastros->row()->email;
            $dados['senha'] = $cadastros->row()->senha;
            $dados['dataHoraCriacao'] = $cadastros->row()->dataHoraCriacao;
            $dados['dataHoraUltimoAcesso'] = $cadastros->row()->dataHoraUltimoAcesso;
            return $dados;
        }
        return null;
    }
}