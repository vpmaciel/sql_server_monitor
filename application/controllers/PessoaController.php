<?php
defined('BASEPATH') || exit('No direct script access allowed');

class PessoaController extends CI_Controller
{

    public function VerRegistro()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view('PessoaView');
    }

    public function GravarRegistro()
    {
        $this->load->library('form_validation');
        $regras = array(
            array(
                Constante::FIELD => 'nome',
                Constante::LABEL => 'NOME',
                Constante::RULES => 'required|mb_strtoupper|trim|min_length[1]|max_length[40]'
            ),
            array(
                Constante::FIELD => 'data_nascimento',
                Constante::LABEL => 'DATA DE NASCIMENTO',
                Constante::RULES => 'required|trim'
            ),
            array(
                Constante::FIELD => 'idade',
                Constante::LABEL => 'IDADE',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'sexo',
                Constante::LABEL => 'SEXO',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'escolaridade',
                Constante::LABEL => 'ESCOLARIDADE',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'estado_civil',
                Constante::LABEL => 'ESTADO CIVIL',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'nacionalidade',
                Constante::LABEL => 'NACIONALIDADE',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'fone_residencial_codigo_area',
                Constante::LABEL => 'TELEFONE RESIDENCIAL (DDD)',
                Constante::RULES => 'integer|min_length[1]|max_length[3]'
            ),
            array(
                Constante::FIELD => 'fone_residencial_numero',
                Constante::LABEL => 'TELEFONE RESIDENCIAL (NÚMERO)',
                Constante::RULES => 'integer|min_length[1]|max_length[9]'
            ),
            array(
                Constante::FIELD => 'celular_codigo_area',
                Constante::LABEL => 'CELULAR (DDD)',
                Constante::RULES => 'required|integer|min_length[1]|max_length[3]'
            ),
            array(
                Constante::FIELD => 'celular_numero',
                Constante::LABEL => 'CELULAR (NÚMERO)',
                Constante::RULES => 'required|integer|min_length[1]|max_length[9]'
            ),
            array(
                Constante::FIELD => 'possui_filhos',
                Constante::LABEL => 'POSSUI FILHOS',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'possui_deficiencia',
                Constante::LABEL => 'POSSUI DEFICIÊNCIA',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'pais',
                Constante::LABEL => 'PAÍS',
                Constante::RULES => 'required|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'estado',
                Constante::LABEL => 'ESTADO',
                Constante::RULES => 'required|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'cidade',
                Constante::LABEL => 'CIDADE',
                Constante::RULES => 'required|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'bairro',
                Constante::LABEL => 'BAIRRO',
                Constante::RULES => 'required|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'logradouro',
                Constante::LABEL => 'ENDEREÇO',
                Constante::RULES => 'required|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'complemento',
                Constante::LABEL => 'COMPLEMENTO',
                Constante::RULES => 'mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'cep',
                Constante::LABEL => 'CEP',
                Constante::RULES => 'required|mb_strtoupper'
            ),
            array(
                Constante::FIELD => 'cnh',
                Constante::LABEL => 'CNH',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'empregado_atualmente',
                Constante::LABEL => 'EMPREGADO ATUALMENTE',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'disponivel_viagens',
                Constante::LABEL => 'DISPONÍVEL PARA VIAGENS',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'trabalha_outras_cidades',
                Constante::LABEL => 'DISPONÍVEL PARA TRABALHAR EM OUTRAS CIDADES',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'trabalha_exterior',
                Constante::LABEL => 'DISPONÍVEL PARA TRABALHAR NO EXTERIOR',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'possui_carro',
                Constante::LABEL => 'POSSUI CARRO',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'possui_moto',
                Constante::LABEL => 'POSSUI MOTO',
                Constante::RULES => 'required|integer'
            ),
            array(
                Constante::FIELD => 'ultimo_salario',
                Constante::LABEL => 'ÚLTIMO SALÁRIO (R$)',
                Constante::RULES => 'required|integer'
            )
        );
        $this->form_validation->set_rules($regras);
        if (! $this->form_validation->run()) {
            $this->load->view('PessoaView', $regras);
            return;
        }
        $dados = array(
            'nome' => $this->input->post('nome'),
            'data_nascimento' => $this->input->post('data_nascimento'),
            'idade' => $this->input->post('idade'),
            'sexo' => $this->input->post('sexo'),
            'escolaridade' => $this->input->post('escolaridade'),
            'estado_civil' => $this->input->post('estado_civil'),
            'nacionalidade' => $this->input->post('nacionalidade'),
            'fone_residencial_codigo_area' => $this->input->post('fone_residencial_codigo_area'),
            'fone_residencial_numero' => $this->input->post('fone_residencial_numero'),
            'celular_codigo_area' => $this->input->post('celular_codigo_area'),
            'celular_numero' => $this->input->post('celular_numero'),
            'pais' => $this->input->post('pais'),
            'estado' => $this->input->post('estado'),
            'cidade' => $this->input->post('cidade'),
            'bairro' => $this->input->post('bairro'),
            'logradouro' => $this->input->post('logradouro'),
            'complemento' => $this->input->post('complemento'),
            'cep' => $this->input->post('cep'),
            'possui_filhos' => $this->input->post('possui_filhos'),
            'possui_deficiencia' => $this->input->post('possui_deficiencia'),            
            'cnh' => $this->input->post('cnh'),
            'empregado_atualmente' => $this->input->post('empregado_atualmente'),
            'disponivel_viagens' => $this->input->post('disponivel_viagens'),
            'trabalha_outras_cidades' => $this->input->post('trabalha_outras_cidades'),
            'ultimo_salario' => $this->input->post('ultimo_salario'),
            'possui_carro' => $this->input->post('possui_carro'),
            'possui_moto' => $this->input->post('possui_moto'),
            'trabalha_exterior' => $this->input->post('trabalha_exterior')
        );
        
        if ($this->PessoaModel->ObterRegistro($this->session->userdata(Constante::USUARIO))) {
            $resultado = $this->PessoaModel->AtualizarRegistro($dados, $this->session->userdata(Constante::USUARIO));
        } else {
            $dadosNovos = array(
                Constante::USUARIO => $this->session->userdata(Constante::USUARIO)
            );
            $dados = $dados + $dadosNovos;
            $resultado = $this->PessoaModel->InserirRegistro($dados);
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

    public function EditarRegistro()
    {
        if ($this->session->userdata(Constante::USUARIO) == NULL) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->model('PessoaModel');

        $lista = $this->PessoaModel->ObterRegistro($this->session->userdata(Constante::USUARIO));

        $dados = array_shift($lista);

        if (count($dados) > 0) {
            $this->load->view('PessoaView', $dados);
        } else if (count($dados) == 0) {
            $this->load->view('PessoaView');
        } else {
            $dados[Constante::MENSAGEM] = "Registro não encontrado.";
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
        }
    }

    public function ExcluirRegistro($id = null)
    {
        if ($this->PessoaModel->ExcluirRegistro($id)) {
            $dados[Constante::MENSAGEM] = Constante::MSG_DADOS_EXCLUIDO_SUCESSO;
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::SUCESSO_VIEW, $dados);
        }
    }
}