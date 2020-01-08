<?php
defined('BASEPATH') || exit('No direct script access allowed');

$nivel_conhecimento_array = NivelConhecimento::ObterValorArray();
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
			<h1>Habilidades</h1>
            <?= form_open('HabilidadeController/GravarRegistro') ?>
            <?php

            $template = array(
                'table_open' => '<table align="center" border="0" cellpadding="2" cellspacing="1">'
            );

            $this->table->set_template($template);

            $this->table->add_row(form_label('HABILIDADE', Constante::CONHECIMENTO));
            $this->table->add_row(form_error(Constante::CONHECIMENTO, '<div class="error">', '</div>'));

            if (! isset($conhecimento)) {
                $conhecimento = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::CONHECIMENTO,
                Constante::ID => Constante::CONHECIMENTO,
                Constante::VALUE => set_value(Constante::CONHECIMENTO, $conhecimento),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '20',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('NÍVEL DE CONHECIMENTO', Constante::NIVEL_CONHECIMENTO));
            $this->table->add_row(form_error(Constante::NIVEL_CONHECIMENTO, '<div class="error">', '</div>'));

            if (! isset($nivel_conhecimento)) {
                $nivel_conhecimento = '';
            }

            $entrada = array(
                Constante::NAME => Constante::NIVEL_CONHECIMENTO,
                Constante::ID => Constante::NIVEL_CONHECIMENTO,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $nivel_conhecimento = ($this->input->post(Constante::NIVEL_CONHECIMENTO)) ? $this->input->post(Constante::NIVEL_CONHECIMENTO) : $nivel_conhecimento;

            $this->table->add_row(form_dropdown($entrada, $nivel_conhecimento_array, $nivel_conhecimento));

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
