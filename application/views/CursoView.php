<?php
defined('BASEPATH') || exit('No direct script access allowed');

$situacao_array = Situacao::ObterValorArray();

$modalidade_array = Modalidade::ObterValorArray();

$nivel_array = Escolaridade::ObterValorArray();
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
			<h1>Curso</h1>
            <?= form_open('CursoController/GravarRegistro') ?>
            <?php

            $template = array(
                'table_open' => '<table align="center" border="0" cellpadding="2" cellspacing="1">'
            );

            $this->table->set_template($template);

            $this->table->add_row(form_label('INSTITUIÇÃO', Constante::INSTITUICAO));
            $this->table->add_row(form_error(Constante::INSTITUICAO, '<div class="error">', '</div>'));

            if (! isset($instituicao)) {
                $instituicao = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::INSTITUICAO,
                Constante::ID => Constante::INSTITUICAO,
                Constante::VALUE => set_value(Constante::INSTITUICAO, $instituicao),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::AUTOFOCUS => Constante::AUTOFOCUS,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('CURSO', Constante::CURSO));
            $this->table->add_row(form_error(Constante::CURSO, '<div class="error">', '</div>'));

            if (! isset($curso)) {
                $curso = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::CURSO,
                Constante::ID => Constante::CURSO,
                Constante::VALUE => set_value(Constante::CURSO, $curso),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('ANO DE INÍCIO', Constante::ANO_INICIO));
            $this->table->add_row(form_error(Constante::ANO_INICIO, '<div class="error">', '</div>'));

            if (! isset($ano_inicio)) {
                $ano_inicio = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::NUMBER,
                Constante::NAME => Constante::ANO_INICIO,
                Constante::ID => Constante::ANO_INICIO,
                Constante::VALUE => set_value(Constante::ANO_INICIO, $ano_inicio),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '4',
                Constante::STYLE => Constante::STYLE_WIDTH,
                Constante::PLACEHOLDER => '0000'
            );

            $js = 'onblur="validarAno(this);"';

            $this->table->add_row(form_input($entrada, $js));

            $this->table->add_row(form_label('ANO DE CONCLUSÃO', Constante::ANO_CONCLUSAO));
            $this->table->add_row(form_error(Constante::ANO_CONCLUSAO, '<div class="error">', '</div>'));

            if (! isset($ano_conclusao)) {
                $ano_conclusao = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::NUMBER,
                Constante::NAME => Constante::ANO_CONCLUSAO,
                Constante::ID => Constante::ANO_CONCLUSAO,
                Constante::VALUE => set_value(Constante::ANO_CONCLUSAO, $ano_conclusao),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '4',
                Constante::STYLE => Constante::STYLE_WIDTH,
                Constante::PLACEHOLDER => '0000'
            );

            $js = 'onblur="validarAno(this);"';

            $this->table->add_row(form_input($entrada, $js));

            $this->table->add_row(form_label('SITUAÇÃO', Constante::SITUACAO));
            $this->table->add_row(form_error(Constante::SITUACAO, '<div class="error">', '</div>'));

            if (! isset($situacao)) {
                $situacao = '';
            }

            $entrada = array(
                Constante::NAME => Constante::SITUACAO,
                Constante::ID => Constante::SITUACAO,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $situacao = ($this->input->post(Constante::SITUACAO)) ? $this->input->post(Constante::SITUACAO) : $situacao;

            $this->table->add_row(form_dropdown($entrada, $situacao_array, $situacao));

            $this->table->add_row(form_label('MODALIDADE', Constante::MODALIDADE));
            $this->table->add_row(form_error(Constante::MODALIDADE, '<div class="error">', '</div>'));

            if (! isset($modalidade)) {
                $modalidade = '';
            }

            $entrada = array(
                Constante::NAME => Constante::MODALIDADE,
                Constante::ID => Constante::MODALIDADE,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $modalidade = ($this->input->post(Constante::MODALIDADE)) ? $this->input->post(Constante::MODALIDADE) : $modalidade;

            $this->table->add_row(form_dropdown($entrada, $modalidade_array, $modalidade));

            $this->table->add_row(form_label('NÍVEL', Constante::NIVEL));
            $this->table->add_row(form_error(Constante::NIVEL, '<div class="error">', '</div>'));

            if (! isset($nivel)) {
                $nivel = '';
            }

            $entrada = array(
                Constante::NAME => Constante::NIVEL,
                Constante::ID => Constante::NIVEL,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $nivel = ($this->input->post(Constante::NIVEL)) ? $this->input->post(Constante::NIVEL) : $nivel;

            $this->table->add_row(form_dropdown($entrada, $nivel_array, $nivel));

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
