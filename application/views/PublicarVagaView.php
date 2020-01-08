<?php
defined('BASEPATH') || exit('No direct script access allowed');

$contrato_array = Contrato::ObterValorArray();

$pretensao_salarial_array = PretensaoSalarial::ObterValorArray();

$nivel_hierarquico_array = NivelHierarquico::ObterValorArray();

$area_interesse_array = AreaInteresse::ObterValorArray();

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
            <?= form_open('PublicaVagaController/GravarRegistro') ?>
            <table>
				<tr>
					<td>
						<div class="form-group">
							<label for="empresa">EMPRESA</label> <span class="erro">
                                <?php echo form_error('empresa') ?: ''; ?>
                            </span> <input type="text" name="empresa"
								id="empresa" class="form-control entrada"
								placeholder="DIGITE CONFIDENCIAL OU O NOME DA EMPRESA" required
								maxlength="50" style="width: 600px;"
								value="<?= set_value('empresa') ?: (isset($empresa) ? $empresa : '') ?>"
								autofocus />
						</div>
						<div class="form-group">
							<label for="cargo">CARGO</label> <span class="erro">
                                <?php echo form_error('cargo') ?: ''; ?>
                            </span> <input type="text" name="cargo"
								id="cargo" class="form-control entrada" required maxlength="50"
								style="width: 600px;"
								value="<?= set_value('cargo') ?: (isset($cargo) ? $cargo : '') ?>">
						</div>
						<div class="form-group">
							<label for="funcoes">FUNÇÕES</label> <span class="erro">
                                <?php echo form_error('funcoes') ?: ''; ?>
                            </span>
							<textarea name="funcoes" id="funcoes"
								class="form-control entrada" required cols="50" rows="8"
								maxlength="500"><?php echo set_value('funcoes') ?: (isset($funcoes) ? $funcoes : ''); ?></textarea>
						</div>
						<div class="form-group">
							<label for="beneficios">BENEFÍCIOS</label> <span class="erro">
                                <?php echo form_error('beneficios') ?: ''; ?>
                            </span>
							<textarea name="beneficios" id="beneficios"
								class="form-control entrada" required cols="50" rows="4"
								maxlength="200"><?php echo set_value('beneficios') ?: (isset($beneficios) ? $beneficios : ''); ?></textarea>
						</div>
						<div class="form-group">
							<label for="data_publicacao">DATA DE PUBLICAÇÃO</label> <span
								class="erro">
                                <?php echo form_error('data_publicacao') ?: ''; ?>
                            </span> <input type="text"
								name="data_publicacao" id="data_publicacao"
								class="form-control entrada" required style="width: 200px;"
								maxlength="10" placeholder="dd/mm/aaaa"
								onblur="if (!(validarData(this))) {
                                               this.value = '';
                                               alert('Data inválida !');
                                           }"
								onkeypress="formatar('##/##/####', this)"
								onkeyup="somenteData(this);"
								value="<?= set_value('data_publicacao') ?: (isset($data_publicacao) ? $data_publicacao : ''); ?>">
						</div>
						<div class="form-group">
							<label for="vagas">VAGAS</label> <span class="erro">
                                <?php echo form_error('vagas') ?: ''; ?>
                            </span> <input type="number" name="vagas"
								id="vagas" class="form-control entrada" required
								style="width: 100px;"
								value="<?= set_value('vagas') ?: (isset($vagas) ? $vagas : '') ?>">
						</div>
						<div class="form-group">
							<label for="contrato">CONTRATO</label> <span class="erro">
                                <?php echo form_error('contrato') ?: ''; ?>
                            </span> <select class="form-control entrada"
								style="width: 400px;" required name="contrato" id="contrato">
							<?php
    foreach ($contrato_array as $chave => $valor) {
        echo "<option value=\"{$chave}\"";
        echo set_select('contrato', "{$chave}", (! empty($contrato) && $contrato == "{$chave}" ? TRUE : FALSE));
        echo ">{$valor}</option>";
    }
    ?>

						</select>
						</div>
						<div class="form-group">
							<label for="salario">SALÁRIO</label> <span class="erro">
                                <?php echo form_error('pretensao_salarial') ?: ''; ?>
                            </span> <select class="form-control entrada"
								style="width: 400px;" required name="salario" id="salario">
							<?php
    foreach ($pretensao_salarial_array as $chave => $valor) {
        echo "<option value=\"{$chave}\"";
        echo set_select('pretensao_salarial', "{$chave}", (! empty($pretensao_salarial) && $pretensao_salarial == "{$chave}" ? TRUE : FALSE));
        echo ">{$valor}</option>";
    }
    ?>
							</select>
						</div>
						<div class="form-group">
							<label for="nivel_hierarquico">NÍVEL HIERÁRQUICO</label> <span
								class="erro">
                                <?php echo form_error('nivel_hierarquico') ?: ''; ?>
                            </span> <select class="form-control entrada"
								style="width: 400px;" required name="nivel_hierarquico"
								id="nivel_hierarquico">
							<?php
    foreach ($nivel_hierarquico_array as $chave => $valor) {
        echo "<option value=\"{$chave}\"";
        echo set_select('nivel_hierarquico', "{$chave}", (! empty($nivel_hierarquico) && $nivel_hierarquico == "{$chave}" ? TRUE : FALSE));
        echo ">{$valor}</option>";
    }
    ?>	
						</select>
						</div>
						<div class="form-group">
							<label for="area_interesse">Área de interesse</label> <span
								class="erro">
                                <?php echo form_error('area_interesse') ?: ''; ?>
                            </span> <select class="form-control entrada"
								style="width: 600px;" required name="area_interesse"
								id="area_interesse">
							<?php
    foreach ($area_interesse_array as $chave => $valor) {
        echo "<option value=\"{$chave}\"";
        echo set_select('area_interesse', "{$chave}", (! empty($area_interesse) && $area_interesse == "{$chave}" ? TRUE : FALSE));
        echo ">{$valor}</option>";
    }
    ?>	
            	
						</select>
						</div>
						<div class="form-group">
							<label for="estado">ESTADO</label> <span class="erro">
                                <?php echo form_error('estado') ?: ''; ?>
                            </span> <select class="form-control entrada"
								style="width: 300px;" name="estado" id="estado">
						<?php
    foreach ($estado_array as $chave => $valor) {
        echo "<option value=\"{$chave}\"";
        echo set_select('estado', "{$chave}", (! empty($estado) && $estado == "{$chave}" ? TRUE : FALSE));
        echo ">{$valor}</option>";
    }
    ?>
						</select>
						</div>
						<div class="form-group">
							<label for="cidade">CIDADE</label> <span class="erro">
                                <?php echo form_error('cidade') ?: ''; ?>
                            </span> <input type="text" name="cidade"
								id="cidade" required class="form-control entrada" maxlength="50"
								style="width: 600px;"
								value="<?= set_value('cidade') ?: (isset($cidade) ? $cidade : '') ?>">
						</div>
						<div class="form-group">
							<blockquote class="separador_incolor"></blockquote>
							<input type="submit" value="Salvar" class="btn btn-default">

						</div>
					</td>
				</tr>
			</table>
            <?= form_close(); ?>
        </div>
        
	</div>
</body>
</html>