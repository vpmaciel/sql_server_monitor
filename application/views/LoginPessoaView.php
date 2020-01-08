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
			<h1>Login Pessoa</h1>
            <?= form_open('LoginPessoaController/CriarSessao') ?>
            <?php

            $template = array(
                'table_open' => '<table align="center" border="0" cellpadding="2" cellspacing="1">'
            );

            $this->table->set_template($template);

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
                Constante::AUTOFOCUS => Constante::AUTOFOCUS,
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

            $entrada = array(
                Constante::TYPE => Constante::SUBMIT,
                Constante::VALUE => 'Login',
                Constante::CLASSE => Constante::CLASSE_BTN_VALUE
            );

            $this->table->add_row(form_label('', ''));

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('', ''));

            $valor = anchor('UsuarioController/VerRegistro', 'Criar conta grátis');

            $this->table->add_row(form_label($valor, ''));

            $valor = anchor('UsuarioRecuperaSenhaController/VerRegistro', 'Recuperar minha senha');

            $this->table->add_row(form_label($valor, ''));

            $valor = anchor('UsuarioAlteraDadosController/VerRegistro', 'Alterar E-mail | Senha');

            $this->table->add_row(form_label($valor, ''));

            $valor = anchor('EmpresaAlteraDadosController/VerRegistro', 'Excluir conta');

            $this->table->add_row(form_label($valor, ''));

            echo $this->table->generate();
            ?>
    		<?= form_close(); ?>
		</div>
		
	</div>
</body>
</html>