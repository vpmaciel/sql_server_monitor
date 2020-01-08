<?php
defined('BASEPATH') || exit('No direct script access allowed');

$nivel_hierarquico_array = NivelHierarquico::ObterValorArray();
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
			<h1>Experiência Profissional</h1>
            <?= form_open('ExperienciaProfissionalController/GravarRegistro') ?>
            <?php

            $template = array(
                'table_open' => '<table align="center" border="0" cellpadding="2" cellspacing="1">'
            );

            $this->table->set_template($template);

            $this->table->add_row(form_label('EMPRESA', Constante::EMPRESA));
            $this->table->add_row(form_error(Constante::EMPRESA, '<div class="error">', '</div>'));

            if (! isset($empresa)) {
                $empresa = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::EMPRESA,
                Constante::ID => Constante::EMPRESA,
                Constante::VALUE => set_value(Constante::INSTITUICAO, $empresa),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::AUTOFOCUS => Constante::AUTOFOCUS,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('CARGO', Constante::CARGO));
            $this->table->add_row(form_error(Constante::CARGO, '<div class="error">', '</div>'));

            if (! isset($cargo)) {
                $cargo = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::CARGO,
                Constante::ID => Constante::CARGO,
                Constante::VALUE => set_value(Constante::INSTITUICAO, $cargo),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('DATA DE ADMISSÃO', Constante::DATA_ADMISSAO));
            $this->table->add_row(form_error(Constante::DATA_ADMISSAO, '<div class="error">', '</div>'));

            if (! isset($data_admissao)) {
                $data_admissao = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::DATA_ADMISSAO,
                Constante::ID => Constante::DATA_ADMISSAO,
                Constante::VALUE => set_value(Constante::DATA_ADMISSAO, $data_admissao),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                'onkeypress' => "formatar('##/##/####', this);",
                'onkeyup' => "somenteData(this);",
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('DATA DE SAÍDA', Constante::DATA_SAIDA));
            $this->table->add_row(form_error(Constante::DATA_SAIDA, '<div class="error">', '</div>'));

            if (! isset($data_saida)) {
                $data_saida = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::DATA_SAIDA,
                Constante::ID => Constante::DATA_SAIDA,
                Constante::VALUE => set_value(Constante::DATA_SAIDA, $data_saida),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                'onkeypress' => "formatar('##/##/####', this);",
                'onkeyup' => "somenteData(this);",
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('NÍVEL HIERÁRQUICO', Constante::NIVEL_HIERARQUICO));
            $this->table->add_row(form_error(Constante::NIVEL_HIERARQUICO, '<div class="error">', '</div>'));

            if (! isset($nivel_hierarquico)) {
                $nivel_hierarquico = '';
            }

            $entrada = array(
                Constante::NAME => Constante::NIVEL_HIERARQUICO,
                Constante::ID => Constante::NIVEL_HIERARQUICO,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $nivel_hierarquico = ($this->input->post(Constante::NIVEL_HIERARQUICO)) ? $this->input->post(Constante::NIVEL_HIERARQUICO) : $nivel_hierarquico;

            $this->table->add_row(form_dropdown($entrada, $nivel_hierarquico_array, $nivel_hierarquico));

            $this->table->add_row(form_label('FUNÇÕES', Constante::FUNCOES));
            $this->table->add_row(form_error(Constante::FUNCOES, '<div class="error">', '</div>'));

            if (! isset($funcoes)) {
                $funcoes = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXTAREA,
                Constante::NAME => Constante::FUNCOES,
                Constante::ID => Constante::FUNCOES,
                Constante::VALUE => set_value(Constante::FUNCOES, $funcoes),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '50',
                Constante::COLS => "50",
                Constante::ROWS => "15",
                Constante::MAXLENGTH => "500",
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_textarea($entrada));

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