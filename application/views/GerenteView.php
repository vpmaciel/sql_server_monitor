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
			<h1>Gerente</h1>
            <?= form_open('gerente_controller/GravarRegistro') ?>
            <table>
				<tr>
					<td>
						<div class="form-group">
							<label for="email">E-MAIL</label> <input type="text" name="email"
								id="email" class="form-control entrada minusculo" required
								style="width: 500px;" autofocus maxlength="50"
								value="<?= set_value('email') ?: (isset($email) ? $email : ''); ?>">
						</div>
						<blockquote class="separador_incolor"></blockquote> <input
						name="comando" type="submit" value="Confirmar"
						class="btn btn-default normal">
						<blockquote class="separador_incolor"></blockquote>
					</td>
				</tr>
				<tr>
					<td>
                        <?php
                        $cadastros = $this->PessoaModel->getTotal();
                        echo 'Total de Currículos: ' . $cadastros;
                        $cadastros = $this->PessoaModel->getTotalPlanoPago();
                        echo '<br>Planos Pagos: ' . $cadastros;
                        $cadastros = $this->PessoaModel->getTotalPlanoGratuito();
                        echo '<br>Planos Gratuitos: ' . $cadastros;
                        $cadastros = $this->EmpresaModel->getTotal();
                        echo '<br>Empresas: ' . $cadastros;
                        $cadastros = $this->PublicaVagaModel->getTotal();
                        echo '<br>Vagas: ' . $cadastros;
                        $cadastros = $this->candidato_vaga_model->getTotal();
                        echo '<br>Candidatos a Vagas: ' . $cadastros;
                        ?>                        
                    </td>
				</tr>
			</table>
            <?= form_close(); ?>
        </div>
        
	</div>
</body>
</html>