<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view(Constante::CABECALHO_VIEW); ?> 
</head>
<body>
	<div class="row">
        <?php $this->load->view(Constante::MENU_VIEW); ?>
    
	<div class="col-lg-12">
			<h1>Certificado</h1>
	        <?= form_open('CertificadoController/GravarRegistro') ?>              
    					 
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

            $this->table->add_row(form_label('CARGA HORÁRIA (HORAS)', Constante::CARGA_HORARIA));
            $this->table->add_row(form_error(Constante::CARGA_HORARIA, '<div class="error">', '</div>'));

            if (! isset($carga_horaria)) {
                $carga_horaria = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::NUMBER,
                Constante::NAME => Constante::CARGA_HORARIA,
                Constante::ID => Constante::CARGA_HORARIA,
                Constante::VALUE => set_value(Constante::CARGA_HORARIA, $carga_horaria),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::MAXLENGTH => '4',
                Constante::STYLE => Constante::STYLE_WIDTH,
                Constante::PLACEHOLDER => '0000'
            );

            $this->table->add_row(form_input($entrada));

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

            $this->table->add_row(form_input($entrada));

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