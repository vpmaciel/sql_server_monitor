<?php
defined('BASEPATH') || exit('No direct script access allowed');

$nivel_conhecimento_array = NivelConhecimento::ObterValorArray();
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
			<h1>Habilidade</h1>
			<div class="novo">
            	<?= $novo = anchor('HabilidadeController/VerRegistro', 'Novo Cadastro'); ?>
            </div>
            <?php
            $configuracao['base_url'] = base_url('HabilidadeController/VerRegistros');
            $configuracao['total_rows'] = count($this->HabilidadeModel->ObterRegistro(null, $this->session->userdata(Constante::USUARIO), - 1, 0));
            $configuracao['per_page'] = 1;
            $qtde = $configuracao['per_page'];

            $this->pagination->initialize($configuracao);

            ($this->uri->segment(3) != '') ? $inicio = $this->uri->segment(3) : $inicio = 0;

            $lista = $this->HabilidadeModel->ObterRegistro(null, $this->session->userdata(Constante::USUARIO), $qtde, $inicio);

            $id = $this->session->userdata(Constante::USUARIO);

            $template = array(
                'table_open' => '<table border="0" cellpadding="2" cellspacing="1" class="tabela">'
            );

            $this->table->set_template($template);

            while ($dados = array_shift($lista)) {
                $excluir = anchor("HabilidadeController/ExcluirRegistro/" . $dados[Constante::ID] . "/$id", 'Excluir cadastro');
                $editar = anchor("HabilidadeController/EditarRegistro/" . $dados[Constante::ID], 'Editar cadastro');
                $navegacao = array(
                    'data' => "$novo | $editar | $excluir",
                    'colspan' => 2,
                    'class' => "centro"
                );
                $this->table->add_row(array(
                    'data' => 'CONHECIMENTO: ',
                    'class' => "direita"
                ), $dados[Constante::CONHECIMENTO]);
                $this->table->add_row(array(
                    'data' => 'NÍVEL DE CONHECIMENTO: ',
                    'class' => "direita"
                ), $nivel_conhecimento_array[$dados[Constante::NIVEL_CONHECIMENTO]]);
                $this->table->add_row($navegacao);
            }

            echo $this->table->generate();
            echo $this->pagination->create_links();
            ?>
		</div>
		
	</div>
</body>
</html>