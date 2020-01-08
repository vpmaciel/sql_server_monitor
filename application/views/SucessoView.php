<?php
defined('BASEPATH') || exit('No direct script access allowed');

$arquivo = rand(1, 2);
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
		<h1>Mensagem</h1>
		<div align="center">
			<div class="alert alert-light text-center mensagem" role="alert">
                <?= $mensagem; ?>
            </div>
		</div>
		<div align="center">
			<a href="javascript:window.history.go(<?= $voltar; ?>);">Voltar</a>
		</div>
		<div align="center">
			<?php $this->load->view(Constante::ANUNCIO_VIEW); ?>
		</div>
	</div>
	</div>
</body>
</html>