<?php
defined('BASEPATH') || exit('No direct script access allowed');

$situacao_array = Situacao::ObterValorArray();

$modalidade_array = Modalidade::ObterValorArray();

$nivel_array = Escolaridade::ObterValorArray();
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
			<h1>Curso</h1>
			<div class="novo">
            	<?= $novo = anchor('CursoController/VerRegistro', 'Novo Cadastro'); ?>
            </div>
            <?php
            $configuracao['base_url'] = base_url('CursoController/VerRegistros');
            $configuracao['total_rows'] = count($this->CursoModel->ObterRegistro(null, $this->session->userdata(Constante::USUARIO), - 1, 0));
            $configuracao['per_page'] = 1;
            $qtde = $configuracao['per_page'];

            $this->pagination->initialize($configuracao);

            ($this->uri->segment(3) != '') ? $inicio = $this->uri->segment(3) : $inicio = 0;

            $lista = $this->CursoModel->ObterRegistro(null, $this->session->userdata(Constante::USUARIO), $qtde, $inicio);

            $id = $this->session->userdata(Constante::USUARIO);

            $template = array(
                'table_open' => '<table border="0" cellpadding="2" cellspacing="1" class="tabela">'
            );

            $this->table->set_template($template);

            while ($dados = array_shift($lista)) {
                $excluir = anchor("CursoController/ExcluirRegistro/" . $dados[Constante::ID] . "/$id", 'Excluir cadastro');
                $editar = anchor("CursoController/EditarRegistro/" . $dados[Constante::ID], 'Editar cadastro');
                $navegacao = array(
                    'data' => "$novo | $editar | $excluir",
                    'colspan' => 2,
                    'class' => "centro"
                );
                $this->table->add_row(array(
                    'data' => 'CURSO: ',
                    'class' => "direita"
                ), $dados[Constante::CURSO]);
                $this->table->add_row(array(
                    'data' => 'INSTITUIÇÃO: ',
                    'class' => "direita"
                ), $dados[Constante::INSTITUICAO]);
                $this->table->add_row(array(
                    'data' => 'ANO DE INÍCIO: ',
                    'class' => "direita"
                ), $dados[Constante::ANO_INICIO]);
                $this->table->add_row(array(
                    'data' => 'ANO DE CONCLUSÃO: ',
                    'class' => "direita"
                ), $dados[Constante::ANO_CONCLUSAO]);
                $this->table->add_row(array(
                    'data' => 'SITUAÇÃO: ',
                    'class' => "direita"
                ), $situacao_array[$dados[Constante::SITUACAO]]);
                $this->table->add_row(array(
                    'data' => 'MODALIDADE :',
                    'class' => "direita"
                ), $modalidade_array[$dados[Constante::MODALIDADE]]);
                $this->table->add_row(array(
                    'data' => 'NÍVEL: ',
                    'class' => "direita"
                ), $nivel_array[$dados[Constante::NIVEL]]);
                $this->table->add_row($navegacao);
            }

            echo $this->table->generate();
            echo $this->pagination->create_links();
            ?>
		</div>
		
	</div>
</body>
</html>