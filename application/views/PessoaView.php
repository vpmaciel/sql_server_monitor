<?php
defined('BASEPATH') || exit('No direct script access allowed');

$cnh_array = Cnh::ObterValorArray();

$sexo_array = Sexo::ObterValorArray();

$deficiencia_array = Deficiencia::ObterValorArray();

$escolaridade_array = Escolaridade::ObterValorArray();

$contrato_array = Contrato::ObterValorArray();

$ultimo_salarioArray = PretensaoSalarial::ObterValorArray();

$nivel_hierarquico_array = NivelHierarquico::ObterValorArray();

$area_interesse_array = AreaInteresse::ObterValorArray();

$estado_array = Estado::ObterValorArray();

$estado_civil_array = EstadoCivil::ObterValorArray();

$nacionalidade_array = Nacionalidade::ObterValorArray();

$pais_array = Pais::ObterValorArray();

$resposta_array = Resposta::ObterValorArray();
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    $this->load->view(Constante::CABECALHO_VIEW);
    ?> 
</head>
<body>
	<div class="row">
        <?php $this->load->view(Constante::MENU_VIEW); ?>
    
		<div class="col-lg-12">
			<h1>Dados Pessoais</h1>
            <?= form_open('PessoaController/GravarRegistro') ?>                
            <?php

            $template = array(
                'table_open' => '<table align="center" border="0" cellpadding="2" cellspacing="1">'
            );

            $this->table->set_template($template);

            $this->table->add_row(form_label('NOME', Constante::NOME));
            $this->table->add_row(form_error(Constante::NOME, '<div class="error">', '</div>'));

            if (! isset($nome)) {
                $nome = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::NOME,
                Constante::ID => Constante::NOME,
                Constante::VALUE => set_value(Constante::NOME, $nome),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::AUTOFOCUS => Constante::AUTOFOCUS,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('DATA DE NASCIMENTO', Constante::DATA_NASCIMENTO));
            $this->table->add_row(form_error(Constante::DATA_NASCIMENTO, '<div class="error">', '</div>'));

            if (! isset($data_nascimento)) {
                $data_nascimento = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::DATA_NASCIMENTO,
                Constante::ID => Constante::DATA_NASCIMENTO,
                Constante::VALUE => set_value(Constante::DATA_NASCIMENTO, $data_nascimento),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '10',
                Constante::STYLE => Constante::STYLE_WIDTH,
                Constante::PLACEHOLDER => Constante::DATA_FORMAT
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('IDADE', Constante::IDADE));
            $this->table->add_row(form_error(Constante::IDADE, '<div class="error">', '</div>'));

            if (! isset($idade)) {
                $idade = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::NUMBER,
                Constante::NAME => Constante::IDADE,
                Constante::ID => Constante::IDADE,
                Constante::VALUE => set_value(Constante::IDADE, $idade),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH,
                'onblur' => "this.value = calcularIdade($('#data_nascimento').val());"
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('SEXO', Constante::SEXO));
            $this->table->add_row(form_error(Constante::SEXO, '<div class="error">', '</div>'));

            if (! isset($sexo)) {
                $sexo = '';
            }

            $entrada = array(
                Constante::NAME => Constante::SEXO,
                Constante::ID => Constante::SEXO,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $sexo = ($this->input->post(Constante::SEXO)) ? $this->input->post(Constante::SEXO) : $sexo;

            $this->table->add_row(form_dropdown($entrada, $sexo_array, $sexo));

            $this->table->add_row(form_label('ESCOLARIDADE', Constante::ESCOLARIDADE));
            $this->table->add_row(form_error(Constante::ESCOLARIDADE, '<div class="error">', '</div>'));

            if (! isset($escolaridade)) {
                $escolaridade = '';
            }

            $entrada = array(
                Constante::NAME => Constante::ESCOLARIDADE,
                Constante::ID => Constante::ESCOLARIDADE,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $escolaridade = ($this->input->post(Constante::ESCOLARIDADE)) ? $this->input->post(Constante::ESCOLARIDADE) : $escolaridade;

            $this->table->add_row(form_dropdown($entrada, $escolaridade_array, $escolaridade));

            $this->table->add_row(form_label('ESTADO CIVIL', Constante::ESTADO_CIVIL));
            $this->table->add_row(form_error(Constante::ESTADO_CIVIL, '<div class="error">', '</div>'));

            if (! isset($estado_civil)) {
                $estado_civil = '';
            }

            $entrada = array(
                Constante::NAME => Constante::ESTADO_CIVIL,
                Constante::ID => Constante::ESTADO_CIVIL,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $estado_civil = ($this->input->post(Constante::ESTADO_CIVIL)) ? $this->input->post(Constante::ESTADO_CIVIL) : $estado_civil;

            $this->table->add_row(form_dropdown($entrada, $estado_civil_array, $estado_civil));

            $this->table->add_row(form_label('NACIONALIDADE', Constante::NACIONALIDADE));
            $this->table->add_row(form_error(Constante::NACIONALIDADE, '<div class="error">', '</div>'));

            if (! isset($nacionalidade)) {
                $nacionalidade = '';
            }

            $entrada = array(
                Constante::NAME => Constante::NACIONALIDADE,
                Constante::ID => Constante::NACIONALIDADE,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $nacionalidade = ($this->input->post(Constante::NACIONALIDADE)) ? $this->input->post(Constante::NACIONALIDADE) : $nacionalidade;

            $this->table->add_row(form_dropdown($entrada, $nacionalidade_array, $nacionalidade));

            $this->table->add_row(form_label('TELEFONE RESIDENCIAL (DDD)', Constante::FONE_RESIDENCIAL_CODIGO_AREA));
            $this->table->add_row(form_error(Constante::FONE_RESIDENCIAL_CODIGO_AREA, '<div class="error">', '</div>'));

            if (! isset($fone_residencial_codigo_area)) {
                $fone_residencial_codigo_area = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::NUMBER,
                Constante::NAME => Constante::FONE_RESIDENCIAL_CODIGO_AREA,
                Constante::ID => Constante::FONE_RESIDENCIAL_CODIGO_AREA,
                Constante::VALUE => set_value(Constante::FONE_RESIDENCIAL_CODIGO_AREA, $fone_residencial_codigo_area),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MIN => '11',
                Constante::MAX => '99',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('TELEFONE RESIDENCIAL (NÚMERO)', Constante::FONE_RESIDENCIAL_NUMERO));
            $this->table->add_row(form_error(Constante::FONE_RESIDENCIAL_NUMERO, '<div class="error">', '</div>'));

            if (! isset($fone_residencial_numero)) {
                $fone_residencial_numero = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::NUMBER,
                Constante::NAME => Constante::FONE_RESIDENCIAL_NUMERO,
                Constante::ID => Constante::FONE_RESIDENCIAL_NUMERO,
                Constante::VALUE => set_value(Constante::FONE_RESIDENCIAL_NUMERO, $fone_residencial_numero),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('CELULAR (DDD)', Constante::CELULAR_CODIGO_AREA));
            $this->table->add_row(form_error(Constante::CELULAR_CODIGO_AREA, '<div class="error">', '</div>'));

            if (! isset($celular_codigo_area)) {
                $celular_codigo_area = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::NUMBER,
                Constante::NAME => Constante::CELULAR_CODIGO_AREA,
                Constante::ID => Constante::CELULAR_CODIGO_AREA,
                Constante::VALUE => set_value(Constante::CELULAR_CODIGO_AREA, $celular_codigo_area),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MIN => '11',
                Constante::MAX => '99',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('CELULAR (NÚMERO)', Constante::CELULAR_NUMERO));
            $this->table->add_row(form_error(Constante::CELULAR_NUMERO, '<div class="error">', '</div>'));

            if (! isset($celular_numero)) {
                $celular_numero = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::NUMBER,
                Constante::NAME => Constante::CELULAR_NUMERO,
                Constante::ID => Constante::CELULAR_NUMERO,
                Constante::VALUE => set_value(Constante::CELULAR_NUMERO, $celular_numero),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('POSSUI FILHOS', Constante::POSSUI_FILHOS));
            $this->table->add_row(form_error(Constante::POSSUI_FILHOS, '<div class="error">', '</div>'));

            if (! isset($possui_filhos)) {
                $possui_filhos = '';
            }

            $entrada = array(
                Constante::NAME => Constante::POSSUI_FILHOS,
                Constante::ID => Constante::POSSUI_FILHOS,
                Constante::VALUE => set_value(Constante::POSSUI_FILHOS, $possui_filhos),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $possui_filhos = ($this->input->post(Constante::POSSUI_FILHOS)) ? $this->input->post(Constante::POSSUI_FILHOS) : $possui_filhos;

            $this->table->add_row(form_dropdown($entrada, $resposta_array, $possui_filhos));

            $this->table->add_row(form_label('POSSUI DEFICIÊNCIA', Constante::POSSUI_DEFICIENCIA));
            $this->table->add_row(form_error(Constante::POSSUI_DEFICIENCIA, '<div class="error">', '</div>'));

            if (! isset($possui_deficiencia)) {
                $possui_deficiencia = '';
            }

            $entrada = array(
                Constante::NAME => Constante::POSSUI_DEFICIENCIA,
                Constante::ID => Constante::POSSUI_DEFICIENCIA,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $possui_deficiencia = ($this->input->post(Constante::POSSUI_DEFICIENCIA)) ? $this->input->post(Constante::POSSUI_DEFICIENCIA) : $possui_deficiencia;

            $this->table->add_row(form_dropdown($entrada, $deficiencia_array, $possui_deficiencia));

            $this->table->add_row(form_label('PAÍS', Constante::PAIS));
            $this->table->add_row(form_error(Constante::PAIS, '<div class="error">', '</div>'));

            if (! isset($pais)) {
                $pais = '';
            }

            $entrada = array(
                Constante::NAME => Constante::PAIS,
                Constante::ID => Constante::PAIS,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $pais = ($this->input->post(Constante::PAIS)) ? $this->input->post(Constante::PAIS) : $pais;

            $this->table->add_row(form_dropdown($entrada, $pais_array, $pais));

            $this->table->add_row(form_label('ESTADO', Constante::ESTADO));
            $this->table->add_row(form_error(Constante::ESTADO, '<div class="error">', '</div>'));

            if (! isset($estado)) {
                $estado = '';
            }

            $entrada = array(
                Constante::NAME => Constante::ESTADO,
                Constante::ID => Constante::ESTADO,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $estado = ($this->input->post(Constante::ESTADO)) ? $this->input->post(Constante::ESTADO) : $estado;

            $this->table->add_row(form_dropdown($entrada, $estado_array, $estado));

            $this->table->add_row(form_label('CIDADE', Constante::CIDADE));
            $this->table->add_row(form_error(Constante::CIDADE, '<div class="error">', '</div>'));

            if (! isset($cidade)) {
                $cidade = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::CIDADE,
                Constante::ID => Constante::CIDADE,
                Constante::VALUE => set_value(Constante::CIDADE, $cidade),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('BAIRRO', Constante::BAIRRO));
            $this->table->add_row(form_error(Constante::BAIRRO, '<div class="error">', '</div>'));

            if (! isset($bairro)) {
                $bairro = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::BAIRRO,
                Constante::ID => Constante::BAIRRO,
                Constante::VALUE => set_value(Constante::BAIRRO, $bairro),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('LOGRADOURO', Constante::LOGRADOURO));
            $this->table->add_row(form_error(Constante::LOGRADOURO, '<div class="error">', '</div>'));

            if (! isset($logradouro)) {
                $logradouro = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::LOGRADOURO,
                Constante::ID => Constante::LOGRADOURO,
                Constante::VALUE => set_value(Constante::LOGRADOURO, $logradouro),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('COMPLEMENTO', Constante::COMPLEMENTO));
            $this->table->add_row(form_error(Constante::COMPLEMENTO, '<div class="error">', '</div>'));

            if (! isset($complemento)) {
                $complemento = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::COMPLEMENTO,
                Constante::ID => Constante::COMPLEMENTO,
                Constante::VALUE => set_value(Constante::COMPLEMENTO, $complemento),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('CEP', Constante::CEP));
            $this->table->add_row(form_error(Constante::CEP, '<div class="error">', '</div>'));

            if (! isset($cep)) {
                $cep = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::CEP,
                Constante::ID => Constante::CEP,
                Constante::VALUE => set_value(Constante::CEP, $cep),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::AUTOFOCUS => Constante::AUTOFOCUS,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('CNH', Constante::CNH));
            $this->table->add_row(form_error(Constante::CNH, '<div class="error">', '</div>'));

            if (! isset($cnh)) {
                $cnh = '';
            }

            $entrada = array(
                Constante::NAME => Constante::CNH,
                Constante::ID => Constante::CNH,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $cnh = ($this->input->post(Constante::CNH)) ? $this->input->post(Constante::CNH) : $cnh;

            $this->table->add_row(form_dropdown($entrada, $cnh_array, $cnh));

            $this->table->add_row(form_label('ÚLTIMO SALÁRIO MENSAL (R$)', Constante::ULTIMO_SALARIO));
            $this->table->add_row(form_error(Constante::ULTIMO_SALARIO, '<div class="error">', '</div>'));

            if (! isset($ultimo_salario)) {
                $ultimo_salario = '';
            }

            $entrada = array(
                Constante::NAME => Constante::ULTIMO_SALARIO,
                Constante::ID => Constante::ULTIMO_SALARIO,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $ultimo_salario = ($this->input->post(Constante::ULTIMO_SALARIO)) ? $this->input->post(Constante::ULTIMO_SALARIO) : $ultimo_salario;

            $this->table->add_row(form_dropdown($entrada, $ultimo_salarioArray, $ultimo_salario));

            $this->table->add_row(form_label('EMPREGADO ATUALMENTE', Constante::EMPREGADO_ATUALMENTE));
            $this->table->add_row(form_error(Constante::EMPREGADO_ATUALMENTE, '<div class="error">', '</div>'));

            if (! isset($empregado_atualmente)) {
                $empregado_atualmente = '';
            }

            $entrada = array(
                Constante::NAME => Constante::EMPREGADO_ATUALMENTE,
                Constante::ID => Constante::EMPREGADO_ATUALMENTE,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $empregado_atualmente = ($this->input->post(Constante::EMPREGADO_ATUALMENTE)) ? $this->input->post(Constante::EMPREGADO_ATUALMENTE) : $empregado_atualmente;

            $this->table->add_row(form_dropdown($entrada, $resposta_array, $empregado_atualmente));

            $this->table->add_row(form_label('DISPONÍVEL PARA VIAGENS', Constante::DISPONIVEL_VIAGENS));
            $this->table->add_row(form_error(Constante::DISPONIVEL_VIAGENS, '<div class="error">', '</div>'));

            if (! isset($disponivel_viagens)) {
                $disponivel_viagens = '';
            }

            $entrada = array(
                Constante::NAME => Constante::DISPONIVEL_VIAGENS,
                Constante::ID => Constante::DISPONIVEL_VIAGENS,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $disponivel_viagens = ($this->input->post(Constante::DISPONIVEL_VIAGENS)) ? $this->input->post(Constante::DISPONIVEL_VIAGENS) : $disponivel_viagens;

            $this->table->add_row(form_dropdown($entrada, $resposta_array, $disponivel_viagens));

            $this->table->add_row(form_label('DISPONÍVEL PARA TRABALHAR EM OUTRAS CIDADES', Constante::TRABALHA_OUTRAS_CIDADES));
            $this->table->add_row(form_error(Constante::TRABALHA_OUTRAS_CIDADES, '<div class="error">', '</div>'));

            if (! isset($trabalha_outras_cidades)) {
                $trabalha_outras_cidades = '';
            }

            $entrada = array(
                Constante::NAME => Constante::TRABALHA_OUTRAS_CIDADES,
                Constante::ID => Constante::TRABALHA_OUTRAS_CIDADES,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $trabalha_outras_cidades = ($this->input->post(Constante::ESTADO_CIVIL)) ? $this->input->post(Constante::ESTADO_CIVIL) : $trabalha_outras_cidades;

            $this->table->add_row(form_dropdown($entrada, $resposta_array, $trabalha_outras_cidades));

            $this->table->add_row(form_label('DISPONÍVEL PARA TRABALHAR NO EXTERIOR', Constante::TRABALHA_EXTERIOR));
            $this->table->add_row(form_error(Constante::TRABALHA_EXTERIOR, '<div class="error">', '</div>'));

            if (! isset($trabalha_exterior)) {
                $trabalha_exterior = '';
            }

            $entrada = array(
                Constante::NAME => Constante::TRABALHA_EXTERIOR,
                Constante::ID => Constante::TRABALHA_EXTERIOR,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $trabalha_exterior = ($this->input->post(Constante::TRABALHA_EXTERIOR)) ? $this->input->post(Constante::TRABALHA_EXTERIOR) : $trabalha_exterior;

            $this->table->add_row(form_dropdown($entrada, $resposta_array, $trabalha_exterior));

            $this->table->add_row(form_label('POSSUI CARRO', Constante::POSSUI_CARRO));
            $this->table->add_row(form_error(Constante::POSSUI_CARRO, '<div class="error">', '</div>'));

            if (! isset($possui_carro)) {
                $possui_carro = '';
            }

            $entrada = array(
                Constante::NAME => Constante::POSSUI_CARRO,
                Constante::ID => Constante::POSSUI_CARRO,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $possui_carro = ($this->input->post(Constante::POSSUI_CARRO)) ? $this->input->post(Constante::POSSUI_CARRO) : $possui_carro;

            $this->table->add_row(form_dropdown($entrada, $resposta_array, $possui_carro));

            $this->table->add_row(form_label('POSSUI MOTO', Constante::POSSUI_MOTO));
            $this->table->add_row(form_error(Constante::POSSUI_MOTO, '<div class="error">', '</div>'));

            if (! isset($possui_moto)) {
                $possui_moto = '';
            }

            $entrada = array(
                Constante::NAME => Constante::POSSUI_MOTO,
                Constante::ID => Constante::POSSUI_MOTO,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $possui_moto = ($this->input->post(Constante::POSSUI_MOTO)) ? $this->input->post(Constante::POSSUI_MOTO) : $possui_moto;

            $this->table->add_row(form_dropdown($entrada, $resposta_array, $possui_moto));

            $entrada = array(
                Constante::TYPE => Constante::SUBMIT,
                Constante::VALUE => 'Salvar',
                Constante::CLASSE => Constante::CLASSE_BTN_VALUE
            );

            $this->table->add_row(form_label('', ''));
            $this->table->add_row(form_input($entrada));

            echo $this->table->generate();

            if (! isset($id)) {
                $id = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::HIDDEN,
                Constante::NAME => Constante::ID,
                Constante::ID => Constante::ID,
                Constante::VALUE => set_value(Constante::ID, $id)
            );

            echo form_input($entrada);
            ?>
            <?= form_close(); ?>
        </div>
		
	</div>
</body>
</html>