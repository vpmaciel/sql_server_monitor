<?php
defined('BASEPATH') || exit('No direct script access allowed');

class CandidatoVagaController extends CI_Controller
{

    public function VerRegistro()
    {
        if ($this->session->userdata(Constante::EMPRESA) == null) {
            $this->load->view(Constante::LOGIN_EMPRESA_VIEW);
            return;
        }
        $this->load->view(Constante::CADASTRO_VAGA_LISTA_VIEW);
    }

    public function VerRegistros()
    {
        $this->verRegistro();
    }

    public function GravarRegistro($publicacaoVaga = null, $empresa = null)
    {
        $usuario = $this->session->userdata(Constante::USUARIO);

        $dados = array(
            "publicacao_vaga" => $publicacaoVaga,
            "usuario" => $this->session->userdata(Constante::USUARIO),
            "empresa" => $empresa
        );

        $lista = $this->CandidatoVagaModel->ObterRegistro($publicacaoVaga, $usuario);

        if (count($lista) != 0) {
            $dados[Constante::MENSAGEM] = "Você já está concorrendo a está vaga.";
            $dados[Constante::VOLTAR] = - 2;
            $this->load->view(Constante::ERRO_VIEW, $dados);
            return;
        }

        $resultado = $this->CandidatoVagaModel->InserirRegistro($dados);

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

    public function ExcluirRegistro($publicacaoVaga = null, $usuario = null)
    {
        if ($this->CandidatoVagaModel->ExcluirRegistro($publicacaoVaga, $usuario)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_ERRO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }
}