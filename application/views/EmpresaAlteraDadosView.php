<?php
defined('BASEPATH') || exit('No direct script access allowed');
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
		<h1>Alterar Dados da Empresa</h1>
        <?= form_open('EmpresaAlteraDadosController/GravarRegistro') ?>
        <?php

        $template = array(
            'table_open' => '<table align="center" border="0" cellpadding="2" cellspacing="1">'
        );

        $this->table->set_template($template);

        $this->table->add_row(form_label('RAZÃO SOCIAL', Constante::RAZAO_SOCIAL));
        $this->table->add_row(form_error(Constante::RAZAO_SOCIAL, '<div class="error">', '</div>'));

        if (! isset($empresa)) {
            $empresa = '';
        }

        $entrada = array(
            Constante::TYPE => Constante::TEXT,
            Constante::NAME => Constante::RAZAO_SOCIAL,
            Constante::ID => Constante::RAZAO_SOCIAL,
            Constante::VALUE => set_value(Constante::RAZAO_SOCIAL, $empresa),
            Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
            Constante::AUTOFOCUS => Constante::AUTOFOCUS,
            Constante::REQUIRED => 'true',
            Constante::MAXLENGTH => '50',
            Constante::STYLE => Constante::STYLE_WIDTH
        );

        $this->table->add_row(form_input($entrada));

        $this->table->add_row(form_label('E-MAIL', Constante::E_MAIL));
        $this->table->add_row(form_error(Constante::E_MAIL, '<div class="error">', '</div>'));

        if (! isset($email)) {
            $email = '';
        }

        $entrada = array(
            Constante::TYPE => Constante::TEXT,
            Constante::NAME => Constante::E_MAIL,
            Constante::ID => Constante::E_MAIL,
            Constante::VALUE => set_value(Constante::E_MAIL, $email),
            Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE . ' minusculo',
            Constante::REQUIRED => 'true',
            Constante::MAXLENGTH => '50',
            Constante::STYLE => Constante::STYLE_WIDTH
        );

        $this->table->add_row(form_input($entrada));

        $this->table->add_row(form_label('SENHA', Constante::SENHA));
        $this->table->add_row(form_error(Constante::SENHA, '<div class="error">', '</div>'));

        if (! isset($senha)) {
            $senha = '';
        }

        $entrada = array(
            Constante::TYPE => Constante::PASSWORD,
            Constante::NAME => Constante::SENHA,
            Constante::ID => Constante::SENHA,
            Constante::VALUE => set_value(Constante::SENHA, $senha),
            Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
            Constante::REQUIRED => 'true',
            Constante::MAXLENGTH => '10',
            Constante::STYLE => Constante::STYLE_WIDTH
        );

        $this->table->add_row(form_input($entrada));

        $this->table->add_row(form_label('CONFIRMAR SENHA', Constante::CONFIRMAR_SENHA));
        $this->table->add_row(form_error(Constante::CONFIRMAR_SENHA, '<div class="error">', '</div>'));

        if (! isset($confirmarSenha)) {
            $confirmarSenha = '';
        }

        $entrada = array(
            Constante::TYPE => Constante::PASSWORD,
            Constante::NAME => Constante::CONFIRMAR_SENHA,
            Constante::ID => Constante::CONFIRMAR_SENHA,
            Constante::VALUE => set_value(Constante::CONFIRMAR_SENHA, $confirmarSenha),
            Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
            Constante::REQUIRED => 'true',
            Constante::MAXLENGTH => '10',
            Constante::STYLE => Constante::STYLE_WIDTH
        );

        $js = 'onblur="validarSenha(formulario);"';

        $this->table->add_row(form_input($entrada, $js));

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