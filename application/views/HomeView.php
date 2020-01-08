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
			<h1>Sql Server Monitor</h1>
			<div align="center">
			<p align="justify">O Sql Server Monitor é um sistema para Internet de monitoramento de Banco
			 de Dados MS Sql Server on-line.</p>    
    		</div>
		</div>		
	</div>
</body>
</html>