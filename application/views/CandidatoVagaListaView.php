<?php
defined('BASEPATH') || exit('No direct script access allowed');

$deficiencia_array = Deficiencia::ObterValorArray();

$estado_array = Estado::ObterValorArray();

$pretensao_salarial_array = PretensaoSalarial::ObterValorArray();

?>
<!DOCTYPE html>
<html>
<head>
    	<?php $this->load->view(Constante::CABECALHO_VIEW); ?>
    </head>
<body>
	<div class="row">
        	<?php $this->load->view(Constante::MENU_VIEW); ?>
      	
	<div class="col-lg-12">
			<h1>Candidatos</h1>
			<table>
             	<?php
            $usuario = null;
            $empresa = null;

            if ($this->session->userdata(Constante::USUARIO) !== null) {
                $usuario = $this->session->userdata(Constante::USUARIO);
            }
            if ($this->session->userdata(Constante::EMPRESA) !== null) {
                $empresa = $this->session->userdata(Constante::EMPRESA);
            }

            $cadastrosCandidatoVaga = $this->CandidatoVagaModel->ObterRegistro(null, null, $empresa);
            while ($cadastroCandidatoVaga = array_shift($cadastrosCandidatoVaga)) {
                $cadastrosPessoas = $this->PessoaModel->ObterRegistro($cadastroCandidatoVaga['usuario']);
                $dados0 = $this->PublicaVagaModel->ObterRegistro($cadastroCandidatoVaga['publicacao_vaga'], $empresa);
                $dados1 = array_shift($dados0);
                ?>
            	<tr>
					<td><span>**********</span><br> <br> <span>DATA DE PUBLICAÇÃO: </span> <?= $dados1['data_publicacao'] ?><br>
						<span>VAGAS: </span> <?= $dados1['vagas'] ?><br> <span>CARGO:</span> <?= $dados1['cargo'] ?><br>
						<span>SALÁRIO:</span> <?= $dados1['salario'] ?><br> <span>ESTADO:</span> <?= $estado_array[$dados1['estado']] ?><br>
						<span>CIDADE:</span> <?= $dados1['cidade'] ?><br>                                
                        <?php
                $cadastros = $this->PessoaModel->ObterRegistro($cadastroCandidatoVaga['usuario']);
                $dados = array_shift($cadastros);
                ?>
                        <br> <span>NOME: </span><?= $dados['nome']; ?>
                        <br> <span>IDADE: </span> <?= $dados['idade']; ?> ANOS
                        <br> <span>POSSUI DEFICIÊNCIA: </span> <?= $deficiencia_array[$dados['possui_deficiencia']]; ?>
                        <br> <span>ESTADO: </span> <?= $estado_array[$dados['estado']]; ?>
                        <br> <span>CIDADE:</span> <?= $dados['cidade']; ?><br>
						<br>
                        <?= anchor("CurriculumVitaeController/VerPagina/$cadastroCandidatoVaga[usuario]", "Visualizar currículo", array('target' => '_blank', 'class' => 'new_window')) ?> | 
                        <?= anchor("CandidatoVagaController/ExcluirRegistro/$dados[usuario]/$cadastroCandidatoVaga[usuario]", "Excluir currículo") ?><br>
						<br></td>
				</tr>
                <?php } ?>
		</table>
		</div>
		
	</div>
</body>
</html>