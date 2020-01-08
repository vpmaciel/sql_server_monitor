<?php
defined('BASEPATH') || exit('No direct script access allowed');

$nivel_hierarquico_array = NivelHierarquico::ObterValorArray();
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
			<h1>Experiência Profissional</h1>
			<div class="novo">
            	<?= $novo = anchor('ExperienciaProfissionalController/VerRegistro', 'Novo Cadastro'); ?>
            </div>
            <?php
            $configuracao['base_url'] = base_url('ExperienciaProfissionalController/VerRegistros');
            $configuracao['total_rows'] = count($this->ExperienciaProfissionalModel->ObterRegistro(null, $this->session->userdata(Constante::USUARIO), - 1, 0));
            $configuracao['per_page'] = 1;
            $qtde = $configuracao['per_page'];

            $this->pagination->initialize($configuracao);

            ($this->uri->segment(3) != '') ? $inicio = $this->uri->segment(3) : $inicio = 0;

            $lista = $this->ExperienciaProfissionalModel->ObterRegistro(null, $this->session->userdata(Constante::USUARIO), $qtde, $inicio);

            $id = $this->session->userdata(Constante::USUARIO);

            $template = array(
                'table_open' => '<table border="0" cellpadding="2" cellspacing="1" class="tabela">'
            );

            $this->table->set_template($template);

            while ($dados = array_shift($lista)) {
                $excluir = anchor("ExperienciaProfissionalController/ExcluirRegistro/" . $dados[Constante::ID] . "/$id", 'Excluir cadastro');
                $editar = anchor("ExperienciaProfissionalController/EditarRegistro/" . $dados[Constante::ID], 'Editar cadastro');
                $navegacao = array(
                    'data' => "$novo | $editar | $excluir",
                    'colspan' => 2,
                    'class' => "centro"
                );
                $this->table->add_row(array(
                    'data' => 'EMPRESA: ',
                    'class' => "direita"
                ), $dados[Constante::EMPRESA]);
                $this->table->add_row(array(
                    'data' => 'CARGO: ',
                    'class' => "direita"
                ), $dados[Constante::CARGO]);
                $this->table->add_row(array(
                    'data' => 'DATA	DE ADMISSSÃO: ',
                    'class' => "direita"
                ), $dados[Constante::DATA_ADMISSAO]);
                $this->table->add_row(array(
                    'data' => 'DATA	DE SAÍDA:: ',
                    'class' => "direita"
                ), $dados[Constante::DATA_SAIDA]);
                $this->table->add_row(array(
                    'data' => 'NÍVEL HIERÁRQUICO: ',
                    'class' => "direita"
                ), $nivel_hierarquico_array[$dados[Constante::NIVEL_HIERARQUICO]]);
                $this->table->add_row(array(
                    'data' => 'FUNÇÕES :',
                    'class' => "direita"
                ), $dados[Constante::FUNCOES]);
                $this->table->add_row($navegacao);
            }

            echo $this->table->generate();
            echo $this->pagination->create_links();
            ?>
		</div>
		
	</div>
</body>
</html>