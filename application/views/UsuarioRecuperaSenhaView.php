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
			<h1>Recuperar Senha</h1>
            <?= form_open('UsuarioRecuperaSenhaController/RecuperarSenha') ?>
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

            $entrada = array(
                Constante::TYPE => Constante::SUBMIT,
                Constante::VALUE => 'Enviar senha',
                Constante::CLASSE => Constante::CLASSE_BTN_VALUE
            );

            $this->table->add_row(form_label('', ''));

            $this->table->add_row(form_input($entrada));

            echo $this->table->generate();

            ?>
    		<?= form_close(); ?>
		</div>
		
	</div>
</body>
</html>