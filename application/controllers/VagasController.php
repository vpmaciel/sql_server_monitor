<?php
defined('BASEPATH') || exit('No direct script access allowed');

class VagasController extends CI_Controller
{

    public function VerRegistro()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view(Constante::VAGAS_VIEW);
    }

    public function VerRegistros()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view(Constante::VAGAS_LISTA_VIEW);
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'cargo',
                Constante::LABEL => 'CARGO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'pretensao_salarial',
                Constante::LABEL => 'PRETENSÃO SALARIAL',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'nivel_hierarquico',
                Constante::LABEL => 'NÍVEL HIERÁRQUICO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'area_interesse',
                Constante::LABEL => 'ÁREA DE INTERESSE',
                Constante::RULES => 'required|trim|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'contrato',
                Constante::LABEL => 'CONTRATO',
                Constante::RULES => 'required|trim|mb_strtoupper'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view(Constante::VAGAS_VIEW, $regras);
        } else {
            $id = $this->input->post('id');
            $this->pessoa = $this->session->userdata(Constante::USUARIO);
            $dados = array(
                "cargo" => $this->input->post('cargo'),
                "pretensao_salarial" => $this->input->post('pretensao_salarial'),
                "nivel_hierarquico" => $this->input->post('nivel_hierarquico'),
                "area_interesse" => $this->input->post('area_interesse'),
                "contrato" => $this->input->post('contrato')
            );
            if ($this->getObjetivoProfissional($id, $this->session->userdata(Constante::USUARIO)) == null) {
                $dadosNovos = array(
                    "pessoa" => $this->session->userdata(Constante::USUARIO)
                );
                $dados = $dados + $dadosNovos;
                $resultado = $this->ObjetivoProfissionalModel->InserirRegistro($dados);
            } else {
                $resultado = $this->ObjetivoProfissionalModel->AtualizarRegistro($dados, $id, $this->session->userdata(Constante::USUARIO));
            }
            if ($resultado) {
                $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_GRAVADOS_SUCESSO;
                $dados[Constante::VOLTAR] = - 2;
                $this->load->view('sucesso', $dados);
            } else {
                $dados[Constante::MENSAGEM] = Constante::MSG_ERRO;
                $dados[Constante::VOLTAR] = - 2;
                $this->load->view('errors/html/erro', $dados);
            }
        }
    }

    public function EditarRegistro($id = null)
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view('login_pessoa');
        }
        $dados = $this->getObjetivoProfissional($id, $this->session->userdata(Constante::USUARIO));
        if (count($dados) > 0) {
            $this->load->view('vagas', $dados);
        } else if (count($dados) == 0) {
            $this->load->view('vagas');
        } else {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_NAO_ENCONTRADO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function ExcluirRegistro($id = null, $pessoa = null)
    {
        if ($this->ObjetivoProfissionalModel->ExcluirRegistro($id, $pessoa)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view('sucesso', $dados);
        }
    }

    public function getObjetivoProfissional($id = null, $pessoa = null)
    {
        if (! $id) {
            return null;
        }
        $this->load->model('ObjetivoProfissionalModel');
        $cadastros = $this->ObjetivoProfissionalModel->get($id, $pessoa);
        if ($cadastros->num_rows() > 0) {
            $dados['id'] = $cadastros->row()->id;
            $dados['pessoa'] = $cadastros->row()->pessoa;
            $dados['cargo'] = $cadastros->row()->cargo;
            $dados['pretensao_salarial'] = $cadastros->row()->pretensao_salarial;
            $dados['nivel_hierarquico'] = $cadastros->row()->nivel_hierarquico;
            $dados['area_interesse'] = $cadastros->row()->area_interesse;
            $dados['contrato'] = $cadastros->row()->contrato;
            return $dados;
        }
        return null;
    }
}