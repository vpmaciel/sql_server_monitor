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
			<h1>Fale Conosco</h1>
			<div align="center">
				CeBusca<br> Soluções inteligentes<br> Somos desenvolvedores de
				ideias, projetos e sistemas<br> &copy; Copyright 2017<br> Contato:
				Vicente Paulo Maciel<br> Telefone: (31) 9-8596-2524<br> E-mail:
				suporte@cebusca.com.br<br>
			</div>
		</div>
	</div>
</body>
</html>