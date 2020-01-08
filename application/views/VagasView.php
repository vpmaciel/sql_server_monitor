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
			<h1>Vagas</h1>
            <?= form_open('PublicaVagaController/PesquisarRegistro') ?>
            <?php

            $template = array(
                'table_open' => '<table align="center" border="0" cellpadding="2" cellspacing="1">'
            );

            $this->table->set_template($template);

            $this->table->add_row(form_label('CARGO', Constante::CARGO));
            $this->table->add_row(form_error(Constante::CARGO, '<div class="error">', '</div>'));

            if (! isset($cargo)) {
                $cargo = '';
            }

            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::CARGO,
                Constante::ID => Constante::CARGO,
                Constante::VALUE => set_value(Constante::INSTITUICAO, $cargo),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::AUTOFOCUS => Constante::AUTOFOCUS,
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $this->table->add_row(form_input($entrada));

            $this->table->add_row(form_label('CONTRATO', Constante::CONTRATO));
            $this->table->add_row(form_error(Constante::CONTRATO, '<div class="error">', '</div>'));

            if (! isset($contrato)) {
                $contrato = '';
            }

            $entrada = array(
                Constante::NAME => Constante::CONTRATO,
                Constante::ID => Constante::CONTRATO,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $contrato = ($this->input->post(Constante::CONTRATO)) ? $this->input->post(Constante::CONTRATO) : $contrato;
            
            $contrato_array = $contrato_array + array('' => 'TODOS');

            $this->table->add_row(form_dropdown($entrada, $contrato_array, $contrato));

            $this->table->add_row(form_label('PRETENSÃO SALARIAL', Constante::PRETENSAO_SALARIAL));
            $this->table->add_row(form_error(Constante::PRETENSAO_SALARIAL, '<div class="error">', '</div>'));

            if (! isset($pretensao_salarial)) {
                $pretensao_salarial = '';
            }

            $entrada = array(
                Constante::NAME => Constante::PRETENSAO_SALARIAL,
                Constante::ID => Constante::PRETENSAO_SALARIAL,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $pretensao_salarial = ($this->input->post(Constante::PRETENSAO_SALARIAL)) ? $this->input->post(Constante::PRETENSAO_SALARIAL) : $pretensao_salarial;

            $pretensao_salarial_array = $pretensao_salarial_array + array('' => 'TODOS');
            
            $this->table->add_row(form_dropdown($entrada, $pretensao_salarial_array, $pretensao_salarial));

            $this->table->add_row(form_label('NÍVEL HIERÁRQUICO', Constante::SITUACAO));
            $this->table->add_row(form_error(Constante::SITUACAO, '<div class="error">', '</div>'));

            if (! isset($nivel_hierarquico)) {
                $nivel_hierarquico = '';
            }

            $entrada = array(
                Constante::NAME => Constante::NIVEL_HIERARQUICO,
                Constante::ID => Constante::NIVEL_HIERARQUICO,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $nivel_hierarquico_array = $nivel_hierarquico_array + array('' => 'TODOS');
            
            $nivel_hierarquico = ($this->input->post(Constante::NIVEL_HIERARQUICO)) ? $this->input->post(Constante::NIVEL_HIERARQUICO) : $nivel_hierarquico;

            $this->table->add_row(form_dropdown($entrada, $nivel_hierarquico_array, $nivel_hierarquico));

            $this->table->add_row(form_label('ÁREA DE INTERESSE', Constante::AREA_INTERESSE));
            $this->table->add_row(form_error(Constante::AREA_INTERESSE, '<div class="error">', '</div>'));

            if (! isset($area_interesse)) {
                $area_interesse = '';
            }

            $entrada = array(
                Constante::NAME => Constante::AREA_INTERESSE,
                Constante::ID => Constante::AREA_INTERESSE,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );

            $area_interesse = ($this->input->post(Constante::AREA_INTERESSE)) ? $this->input->post(Constante::AREA_INTERESSE) : $area_interesse;

            $area_interesse_array = $area_interesse_array + array('' => 'TODOS');
            
            $this->table->add_row(form_dropdown($entrada, $area_interesse_array, $area_interesse));
            
            $this->table->add_row(form_label('ESTADO', Constante::ESTADO));
            $this->table->add_row(form_error(Constante::ESTADO, '<div class="error">', '</div>'));
            
            if (! isset($estado)) {
                $estado = '';
            }
            
            $entrada = array(
                Constante::NAME => Constante::ESTADO,
                Constante::ID => Constante::ESTADO,
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::REQUIRED => 'true',
                Constante::STYLE => Constante::STYLE_WIDTH
            );
            
            $estado = ($this->input->post(Constante::ESTADO)) ? $this->input->post(Constante::ESTADO) : $estado;
            
            $estado_array = $estado_array + array('' => 'TODOS');
            $this->table->add_row(form_dropdown($entrada, $estado_array, $estado));
                        
            $this->table->add_row(form_label('CIDADE', Constante::CIDADE));
            $this->table->add_row(form_error(Constante::CARGO, '<div class="error">', '</div>'));
            
            if (! isset($cidade)) {
                $cidade = '';
            }
            
            $entrada = array(
                Constante::TYPE => Constante::TEXT,
                Constante::NAME => Constante::CIDADE,
                Constante::ID => Constante::CIDADE,
                Constante::VALUE => set_value(Constante::CIDADE, $cidade),
                Constante::CLASSE => Constante::CLASSE_ENTRADA_VALUE,
                Constante::AUTOFOCUS => Constante::AUTOFOCUS,
                Constante::MAXLENGTH => '50',
                Constante::STYLE => Constante::STYLE_WIDTH
            );
            
            $this->table->add_row(form_input($entrada));

            $entrada = array(
                Constante::TYPE => Constante::SUBMIT,
                Constante::VALUE => 'Pesquisar',
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