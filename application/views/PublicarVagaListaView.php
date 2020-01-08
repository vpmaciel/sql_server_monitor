<?php
defined('BASEPATH') || exit('No direct script access allowed');

$estado_array = Estado::ObterValorArray();
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
			<h1>Publicar Vaga</h1>
			<div class="novo">
	        	<?= anchor('PublicaVagaController/VerRegistro', 'Novo Cadastro'); ?><br>
			</div>
			<br>
			<table>
				<tbody>
                    <?php
                    $empresa = null;

                    if ($this->session->userdata(Constante::EMPRESA) !== null) {
                        $empresa = $this->session->userdata(Constante::EMPRESA);
                    }

                    $cadastros = $this->PublicaVagaModel->ObterRegistro(null, $empresa);

                    while ($cadastro = array_shift($cadastros)) {
                        ?>
                        <tr>
						<td><span>**********</span><br> <br> <span>CARGO:</span> <?= $cadastro['cargo'] ?><br>
							<span>DATA DE PUBLICAÇÃO:</span> <?= $cadastro['data_publicacao'] ?><br>
							<span>ESTADO:</span> <?= $estado_array[$cadastro['estado']] ?><br>
							<span>CIDADE:</span> <?= $cadastro['cidade'] ?><br> <br>
                                <?= anchor("PublicaVagaController/EditarRegistro/$cadastro[id]", "Editar") ?> | <?= anchor("PublicaVagaController/ExcluirRegistro/$cadastro[id]/$cadastro[empresa]", "Excluir") ?> | <?= anchor('PublicaVagaController/VerRegistro', 'Novo Cadastro'); ?> <br>
							<br></td>
					</tr>
                    <?php } ?>
                </tbody>
			</table>
		</div>
		
	</div>
</body>
</html>