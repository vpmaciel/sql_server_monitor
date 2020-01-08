<?php
defined('BASEPATH') || exit('No direct script access allowed');

$contrato_array = Contrato::ObterValorArray();

$pretensao_salarial_array = PretensaoSalarial::ObterValorArray();

$nivel_hierarquico_array = NivelHierarquico::ObterValorArray();

$area_interesse_array = AreaInteresse::ObterValorArray();

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
			<h1>Objetivo Profissional</h1>
			<div class="novo">
            	<?= $novo = anchor('ObjetivoProfissionalController/VerRegistro', 'Novo Cadastro'); ?>
            </div>
            <?php
            $configuracao['base_url'] = base_url('ObjetivoProfissionalController/VerRegistros');
            $configuracao['total_rows'] = count($this->ObjetivoProfissionalModel->ObterRegistro(null, $this->session->userdata(Constante::USUARIO), - 1, 0));
            $configuracao['per_page'] = 1;
            $qtde = $configuracao['per_page'];

            $this->pagination->initialize($configuracao);

            ($this->uri->segment(3) != '') ? $inicio = $this->uri->segment(3) : $inicio = 0;

            $lista = $this->ObjetivoProfissionalModel->ObterRegistro(null, $this->session->userdata(Constante::USUARIO), $qtde, $inicio);

            $id = $this->session->userdata(Constante::USUARIO);

            $template = array(
                'table_open' => '<table border="0" cellpadding="2" cellspacing="1" class="tabela">'
            );

            $this->table->set_template($template);

            while ($dados = array_shift($lista)) {

                $excluir = anchor("ObjetivoProfissionalController/ExcluirRegistro/" . $dados[Constante::ID] . "/$id", 'Excluir cadastro');
                $editar = anchor("ObjetivoProfissionalController/EditarRegistro/" . $dados[Constante::ID], 'Editar cadastro');
                $navegacao = array(
                    'data' => "$novo | $editar | $excluir",
                    'colspan' => 2,
                    'class' => "centro"
                );
                $this->table->add_row(array(
                    'data' => 'CARGO: ',
                    'class' => "direita"
                ), $dados[Constante::CARGO]);
                $this->table->add_row(array(
                    'data' => 'CONTRATO: ',
                    'class' => "direita"
                ), $contrato_array[$dados[Constante::CONTRATO]]);
                $this->table->add_row(array(
                    'data' => 'PRETENSÃO SALARIAL: ',
                    'class' => "direita"
                ), $pretensao_salarial_array[$dados[Constante::PRETENSAO_SALARIAL]]);
                $this->table->add_row(array(
                    'data' => 'NÍVEL HIERÁRQUICO: ',
                    'class' => "direita"
                ), $nivel_hierarquico_array[$dados[Constante::NIVEL_HIERARQUICO]]);
                $this->table->add_row(array(
                    'data' => 'ÁREA DE INTERESSE: ',
                    'class' => "direita"
                ), $area_interesse_array[$dados[Constante::AREA_INTERESSE]]);
                $this->table->add_row($navegacao);
            }

            echo $this->table->generate();
            echo $this->pagination->create_links();
            ?>
		</div>
		
	</div>
</body>
</html>