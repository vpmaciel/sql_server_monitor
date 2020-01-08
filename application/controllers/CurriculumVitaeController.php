<?php
defined('BASEPATH') || exit('No direct script access allowed');

class CurriculumVitaeController extends CI_Controller
{
    public function VerRegistro()
    {
        if ($this->session->userdata(Constante::USUARIO) !== null) {
            $this->load->view(Constante::LOGIN_PESSOA_VIEW);
            return;
        }
        $this->load->view('relatorio_grafico_no_pdf');
    }

    public function VerPagina($usuario = null)
    {
        
        $permitir = FALSE;     
        
        $id_usuario = $this->session->userdata(Constante::USUARIO);
        if (isset($id_usuario) && ($id_usuario == $usuario)) {
            $permitir = TRUE;            
        }
        
        $id_empresa = $this->session->userdata(Constante::EMPRESA);
        $lista = $this->CandidatoVagaModel->ObterRegistro(null, $usuario, $id_empresa, 0, 0);
        
        if (isset($id_empresa) && (count($lista) > 0)) {
            $permitir = TRUE;
            
        }
        
        if($permitir == FALSE){
            $dados[Constante::MENSAGEM] = "Registro não encontrado !";
            $dados[Constante::VOLTAR] = - 1;
            $this->load->view(Constante::ERRO_VIEW, $dados);
            return;
        }
        
        $escolaridade_array = Escolaridade::ObterValorArray();
        $estado_civil_array = EstadoCivil::ObterValorArray();
        $nacionalidade_array = Nacionalidade::ObterValorArray();
        $resposta_array = Resposta::ObterValorArray();
        $sexo_array = Sexo::ObterValorArray();
        $pais_array = Pais::ObterValorArray();
        $estado_array = Estado::ObterValorArray();
        $cnh_array = Cnh::ObterValorArray();
        $ultimo_salarioArray = PretensaoSalarial::ObterValorArray();
        $contrato_array = Contrato::ObterValorArray();
        $pretensao_salarial_array = PretensaoSalarial::ObterValorArray();
        $nivel_hierarquico_array = NivelHierarquico::ObterValorArray();
        $area_interesse_array = AreaInteresse::ObterValorArray();
        $situacao_array = Situacao::ObterValorArray();
        $modalidade_array = Modalidade::ObterValorArray();
        $nivel_array = Escolaridade::ObterValorArray();
        $nivel_conhecimento_array = NivelConhecimento::ObterValorArray();
        $nivel_hierarquico_array = NivelHierarquico::ObterValorArray();
        $deficiencia_array = Deficiencia::ObterValorArray();
        
        define('FPDF_FONTPATH', APPPATH . '../assets/fpdf/font/');
        require (APPPATH . '../assets/fpdf/fpdf.php');
        $pdf = new FPDF("P", "pt", "A4");
        $pdf->AddPage();
        $lista = $this->PessoaModel->ObterRegistro($usuario);
        
        while ($cadastro = array_shift($lista)) {
            $nome = $cadastro[Constante::NOME];
            $pdf->SetFont('arial', 'B', 14);
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', $cadastro[Constante::NOME]), 0, 1, 'C');
            $pdf->SetFont('arial', 'B', 8);
            $pdf->Ln(10);
            $mensagem = $escolaridade_array[$cadastro[Constante::ESCOLARIDADE]] . ", " . $estado_civil_array[$cadastro[Constante::ESTADO_CIVIL]] . ", " . $cadastro[Constante::IDADE] ." ANOS";
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', $mensagem), 0, 1, 'C');
        }
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Ln(20);
        $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "DADOS PESSOAIS"), 0, 1, 'L'); 
        
        $lista = $this->PessoaModel->ObterRegistro($usuario);
        while ($cadastro = array_shift($lista)) {
            $pdf->Ln(15);
            $pdf->SetFont('arial', '', 12);
            $mensagem = $nacionalidade_array[$cadastro[Constante::NACIONALIDADE]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "NACIONALIDADE: $mensagem"), 0, 1, 'L');
            $pdf->Ln(10);
            $lista_usuario = $this->UsuarioModel->ObterRegistro($usuario, NULL);
            
            
            while ($cadastro_usuario = array_shift($lista_usuario)) {
                $email = $cadastro_usuario[Constante::E_MAIL];
                $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "E-MAIL: $email"), 0, 1, 'L');
            }
            $pdf->Ln(10);
            $data_nascimento = $cadastro[Constante::DATA_NASCIMENTO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "DATA DE NASCIMENTO: $data_nascimento"), 0, 1, 'L');
            $pdf->Ln(10);
            $sexo = $sexo_array[$cadastro[Constante::SEXO]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "SEXO: $sexo"), 0, 1, 'L');
            $pdf->Ln(10);
            $email = $cadastro[Constante::CELULAR_CODIGO_AREA];
            $mensagem = "CELULAR: " . $cadastro[Constante::CELULAR_CODIGO_AREA] ."-". $cadastro[Constante::CELULAR_NUMERO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "$mensagem"), 0, 1, 'L');
            $pdf->Ln(10);
            $possui_filhos = $resposta_array[$cadastro[Constante::POSSUI_FILHOS]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "POSSUI FILHOS: $possui_filhos"), 0, 1, 'L');
            $pdf->Ln(10);
            $possui_deficiencia = $deficiencia_array[$cadastro[Constante::POSSUI_DEFICIENCIA]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "POSSUI DEFICIÊNCIA: $possui_deficiencia"), 0, 1, 'L');
            $pdf->Ln(10);
            $pais = $pais_array[$cadastro[Constante::PAIS]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "PAÍS: $pais"), 0, 1, 'L');
            $pdf->Ln(10);
            $estado = $estado_array[$cadastro[Constante::ESTADO]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "ESTADO: $estado"), 0, 1, 'L');
            $pdf->Ln(10);
            $cidade = $cadastro[Constante::CIDADE];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CIDADE: $cidade"), 0, 1, 'L');
            $pdf->Ln(10);
            $bairro = $cadastro[Constante::BAIRRO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "BAIRRO: $bairro"), 0, 1, 'L');
            $pdf->Ln(10);
            $logradouro = $cadastro[Constante::LOGRADOURO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "ENDEREÇO: $logradouro"), 0, 1, 'L');
            $pdf->Ln(10);
            $complemento = $cadastro[Constante::COMPLEMENTO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "COMPLEMENTO: $complemento"), 0, 1, 'L');
            $pdf->Ln(10);
            $cep = $cadastro[Constante::CEP];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CEP: $cep"), 0, 1, 'L');
            $pdf->Ln(10);
            $cnh = $cnh_array[$cadastro[Constante::CNH]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CNH: $cnh"), 0, 1, 'L');
            $pdf->Ln(10);
            $ultimo_salario = $ultimo_salarioArray[$cadastro[Constante::ULTIMO_SALARIO]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "ÚLTIMO SALÁRIO (R$): $ultimo_salario"), 0, 1, 'L');
            $pdf->Ln(10);
            $empregado_atualmente = $resposta_array[$cadastro[Constante::EMPREGADO_ATUALMENTE]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "EMPREGADO ATUALMENTE: $empregado_atualmente"), 0, 1, 'L');
            $pdf->Ln(10);
            $disponivel_viagens = $resposta_array[$cadastro[Constante::DISPONIVEL_VIAGENS]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "DISPONÍVEL PARA VIAGENS: $disponivel_viagens"), 0, 1, 'L');
            $pdf->Ln(10);
            $trabalha_outras_cidades = $resposta_array[$cadastro[Constante::TRABALHA_OUTRAS_CIDADES]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "DISPONÍVEL PARA TRABALHAR EM OUTRAS CIDADES: $trabalha_outras_cidades"), 0, 1, 'L');
            $pdf->Ln(10);
            $trabalha_exterior = $resposta_array[$cadastro[Constante::TRABALHA_EXTERIOR]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "DISPONÍVEL PARA TRABALHAR NO EXTERIOR: $trabalha_exterior"), 0, 1, 'L');
        }
        
        $lista = $this->ObjetivoProfissionalModel->ObterRegistro(null, $usuario);;
            
        if (count($lista) > 0) {
            $pdf->Ln(20);
            $pdf->SetFont('arial', 'B', 12);
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "OBJETIVO PROFISSIONAL"), 0, 1, 'L');
        }
        while ($cadastro = array_shift($lista)) {
            $pdf->Ln(15);
            $pdf->SetFont('arial', '', 12);
            $cargo = $cadastro[Constante::CARGO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CARGO: $cargo"), 0, 1, 'L');
            $pdf->Ln(10);            
            $contrato = $contrato_array[$cadastro[Constante::CONTRATO]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CONTRATO: $contrato"), 0, 1, 'L');
            $pdf->Ln(10);
            $pretensao_salarial = $pretensao_salarial_array[$cadastro[Constante::PRETENSAO_SALARIAL]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "PRETENSÃO SALARIAL: $pretensao_salarial"), 0, 1, 'L');
            $pdf->Ln(10);
            $nivel_hierarquico = $nivel_hierarquico_array[$cadastro[Constante::NIVEL_HIERARQUICO]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "NÍVEL HIERÁRQUICO: $nivel_hierarquico"), 0, 1, 'L');
            $pdf->Ln(10);
            $area_interesse = $area_interesse_array[$cadastro[Constante::AREA_INTERESSE]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "ÁREA DE INTERESSE: $area_interesse"), 0, 1, 'L');
        }
        
        $lista = $this->CursoModel->ObterRegistro(null, $usuario);
        if (count($lista) > 0) {
            $pdf->Ln(20);
            $pdf->SetFont('arial', 'B', 12);
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CURSOS"), 0, 1, 'L');
        }
        $pdf->SetFont('arial', '', 12);
        while ($cadastro = array_shift($lista)) {
            $pdf->Ln(15);            
            $instituicao = $cadastro[Constante::INSTITUICAO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "INSTITUIÇÃO: $instituicao"), 0, 1, 'L');
            $pdf->Ln(10);            
            $curso = $cadastro[Constante::CURSO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CURSO: $curso"), 0, 1, 'L');
            $pdf->Ln(10);
            $ano_inicio = $cadastro[Constante::ANO_INICIO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "ANO DE INÍCIO: $ano_inicio"), 0, 1, 'L');
            $pdf->Ln(10);
            $ano_conclusao = $cadastro[Constante::ANO_CONCLUSAO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "ANO DE CONCLUSÃO: $ano_conclusao"), 0, 1, 'L');
            $pdf->Ln(10);
            $situacao = $situacao_array[$cadastro[Constante::SITUACAO]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "SITUAÇÃO: $situacao"), 0, 1, 'L');
            $pdf->Ln(10);
            $modalidade = $modalidade_array[$cadastro[Constante::MODALIDADE]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "MODALIDADE: $modalidade"), 0, 1, 'L');
            $pdf->Ln(10);
            $nivel = $nivel_array[$cadastro[Constante::NIVEL]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "NÍVEL: $nivel"), 0, 1, 'L');
        }
        
        $lista = $this->IdiomaModel->ObterRegistro(null, $usuario);
        if (count($lista) > 0) {
            $pdf->Ln(20);
            $pdf->SetFont('arial', 'B', 12);
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "IDIOMAS"), 0, 1, 'L');
        }
        $pdf->SetFont('arial', '', 12);
        while ($cadastro = array_shift($lista)) {
            $pdf->Ln(15);
            $idioma = $cadastro[Constante::IDIOMA];            
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "LÍNGUA: $idioma"), 0, 1, 'L');
            $pdf->Ln(10);            
            $nivel_conhecimento = $nivel_conhecimento_array[$cadastro[Constante::NIVEL_CONHECIMENTO]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "NÍVEL DE CONHECIMENTO: $nivel_conhecimento"), 0, 1, 'L');
        }
        
        $lista = $this->ExperienciaProfissionalModel->ObterRegistro(null, $usuario);
        if (count($lista) > 0) {
            $pdf->Ln(20);
            $pdf->SetFont('arial', 'B', 12);
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "EXPERIÊNCIA PROFISSIONAL"), 0, 1, 'L');
        }
        $pdf->SetFont('arial', '', 12);
        while ($cadastro = array_shift($lista)) {
            $pdf->Ln(15);            
            $empresa = $cadastro[Constante::EMPRESA];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "EMPRESA: $empresa"), 0, 1, 'L');
            $pdf->Ln(10);            
            $cargo = $cadastro[Constante::CARGO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CARGO: $cargo"), 0, 1, 'L');
            $pdf->Ln(10);
            $data_admissao = $cadastro[Constante::DATA_ADMISSAO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "DATA DE ADMISSÃO: $data_admissao"), 0, 1, 'L');
            $pdf->Ln(10);
            $data_saida = $cadastro[Constante::DATA_SAIDA];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "DATA DE SAIDA: $data_saida"), 0, 1, 'L');
            $pdf->Ln(10);
            $nivel_hierarquico = $nivel_hierarquico_array[$cadastro[Constante::NIVEL_HIERARQUICO]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "NÍVEL HIERÁRQUICO: $nivel_hierarquico"), 0, 1, 'L');
            $pdf->Ln(5);
            $funcoes = $cadastro[Constante::FUNCOES];
            $pdf->MultiCell(0, 15, iconv('utf-8', 'iso-8859-1', "FUNÇÕES: $funcoes"), 0, 'J', false);
        }
        
        $lista = $this->HabilidadeModel->ObterRegistro(null, $usuario);
        if (count($lista) > 0) {
            $pdf->Ln(20);
            $pdf->SetFont('arial', 'B', 12);
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "HABILIDADES"), 0, 1, 'L');
        }
        $pdf->SetFont('arial', '', 12);
        while ($cadastro = array_shift($lista)) {
            $pdf->Ln(15);            
            $conhecimento = $cadastro[Constante::CONHECIMENTO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CONHECIMENTO: $conhecimento"), 0, 1, 'L');
            $pdf->Ln(10);            
            $nivel_conhecimento = $nivel_conhecimento_array[$cadastro[Constante::NIVEL_CONHECIMENTO]];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "NÍVEL DE CONHECIMENTO: $nivel_conhecimento"), 0, 1, 'L');
        }
        $lista = $this->CertificadoModel->ObterRegistro(null, $usuario);
        if (count($lista) > 0) {
            $pdf->Ln(20);
            $pdf->SetFont('arial', 'B', 12);
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CERTIFICADOS"), 0, 1, 'L');
        }
        $pdf->SetFont('arial', '', 12);
        while ($cadastro = array_shift($lista)) {
            $pdf->Ln(15);            
            $instituicao = $cadastro[Constante::INSTITUICAO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "INSTITUIÇÃO: $instituicao"), 0, 1, 'L');
            $pdf->Ln(10);            
            $curso = $cadastro[Constante::CURSO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CURSO: $curso"), 0, 1, 'L');
            $pdf->Ln(10);
            $carga_horaria = $cadastro[Constante::CARGA_HORARIA];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "CARGA HORÁRIA (HORAS): $carga_horaria"), 0, 1, 'L');
            $pdf->Ln(10);
            $ano_conclusao = $cadastro[Constante::ANO_CONCLUSAO];
            $pdf->Cell(0, 5, iconv('utf-8', 'iso-8859-1', "ANO DE CONCLUSÃO: $ano_conclusao"), 0, 1, 'L');
        }
        
        if (isset($nome)) {
            $pdf->Output($nome . '-' . $usuario, "I");
        }
    }
}
