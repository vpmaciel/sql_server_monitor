<?php
defined('BASEPATH') || exit('No direct script access allowed');

class ExperienciaProfissionalController extends CI_Controller
{

    public function VerRegistro()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view(Constante::EXPERIENCIA_PROFISSIONAL_VIEW);
    }

    public function VerRegistros()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view('ExperienciaProfissionalListaView');
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => Constante::EMPRESA,
                Constante::LABEL => 'EMPRESA',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => Constante::CARGO,
                Constante::LABEL => 'CARGO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => Constante::DATA_ADMISSAO,
                Constante::LABEL => 'DATA DE ADMISSÃO',
                Constante::RULES => 'required|trim'
            ),
            array(
                Constante::FIELD => Constante::DATA_SAIDA,
                Constante::LABEL => 'DATA DE SAÍDA',
                Constante::RULES => 'trim'
            ),
            array(
                Constante::FIELD => Constante::NIVEL_HIERARQUICO,
                Constante::LABEL => 'NÍVEL HIERÁRQUICO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => Constante::FUNCOES,
                Constante::LABEL => 'FUNÇÕES',
                Constante::RULES => 'required|trim|mb_strtoupper'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view(Constante::EXPERIENCIA_PROFISSIONAL_VIEW, $regras);
            return;
        }

        $dados = array(
            Constante::EMPRESA => $this->input->post(Constante::EMPRESA),
            Constante::CARGO => $this->input->post(Constante::CARGO),
            Constante::DATA_ADMISSAO => $this->input->post(Constante::DATA_ADMISSAO),
            Constante::DATA_SAIDA => $this->input->post(Constante::DATA_SAIDA),
            Constante::NIVEL_HIERARQUICO => $this->input->post(Constante::NIVEL_HIERARQUICO),
            Constante::FUNCOES => $this->input->post(Constante::FUNCOES)
        );

        $id = $this->input->post(Constante::ID);

        if ($id == '') {
            $dadosNovos = array(
                Constante::USUARIO => $this->session->userdata(Constante::USUARIO)
            );
            $dados = $dados + $dadosNovos;

            $resultado = $this->ExperienciaProfissionalModel->InserirRegistro($dados);
        } else {
            $resultado = $this->ExperienciaProfissionalModel->AtualizarRegistro($dados, $id, $this->session->userdata(Constante::USUARIO));
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
        $lista = $this->ExperienciaProfissionalModel->ObterRegistro($id, $this->session->userdata(Constante::USUARIO));
        $dados = array_shift($lista);

        if (count($dados) > 0) {
            $this->load->view(Constante::EXPERIENCIA_PROFISSIONAL_VIEW, $dados);
        } else if (count($dados) == 0) {
            $this->load->view(Constante::EXPERIENCIA_PROFISSIONAL_VIEW);
        } else {
            $dados[Constante::MENSAGEM] = "Registro não encontrado.";
            $dados[Constante::VOLTAR] = - 2;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function ExcluirRegistro($id = null, $usuario = null)
    {
        if ($this->ExperienciaProfissionalModel->ExcluirRegistro($id, $usuario)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        }
    }
}