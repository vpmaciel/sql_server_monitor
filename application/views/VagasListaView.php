<?php
defined('BASEPATH') || exit('No direct script access allowed');

$contrato_array = Contrato::ObterValorArray();

$salario_array = PretensaoSalarial::ObterValorArray();

$nivel_hierarquico_array = NivelHierarquico::ObterValorArray();

$area_interesse_array = AreaInteresse::ObterValorArray();

$estado_array = Estado::ObterValorArray();
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
			<h1>Vagas</h1>
			<div class="novo">
            	<?= $novo = anchor('VagasController/VerRegistro', 'Clique aqui para pesquisar Vagas'); ?>
            </div>
            <?php
            $configuracao['base_url'] = base_url('CursoController/VerRegistros');
            $configuracao['total_rows'] = count($this->PublicaVagaModel->ObterRegistro(NULL, NULL, - 1, 0));
            $configuracao['per_page'] = 1;
            $qtde = $configuracao['per_page'];

            $this->pagination->initialize($configuracao);

            ($this->uri->segment(3) != '') ? $inicio = $this->uri->segment(3) : $inicio = 0;

            $lista = $this->PublicaVagaModel->ObterRegistro(NULL, NULL, $qtde, $inicio);

            $id = $this->session->userdata(Constante::USUARIO);

            $template = array(
                'table_open' => '<table border="0" cellpadding="2" cellspacing="1" class="tabela">'
            );

            $this->table->set_template($template);

            while ($dados = array_shift($lista)) {
                $candidatar = anchor("CandidatoVagaController/GravarRegistro/" . $dados[Constante::ID] . "/" . $dados[Constante::EMPRESA], 'Clique aqui para candidatar a essa vaga');
                $navegacao = array(
                    'data' => "$candidatar",
                    'colspan' => 2,
                    'class' => "centro"
                );
                $this->table->add_row(array(
                    'data' => 'DATA: ',
                    'class' => "direita"
                ), $dados[Constante::DATA_PUBLICACAO]);
                $this->table->add_row(array(
                    'data' => 'EMPRESA: ',
                    'class' => "direita"
                ), $dados[Constante::RAZAO_SOCIAL]);
                $this->table->add_row(array(
                    'data' => 'CARGO: ',
                    'class' => "direita"
                ), $dados[Constante::CARGO]);
                $this->table->add_row(array(
                    'data' => 'VAGAS: ',
                    'class' => "direita"
                ), $dados[Constante::VAGAS]);
                $this->table->add_row(array(
                    'data' => 'CONTRATO: ',
                    'class' => "direita"
                ), $contrato_array[$dados[Constante::CONTRATO]]);
                $this->table->add_row(array(
                    'data' => 'SALÁRIO :',
                    'class' => "direita"
                ), $salario_array[$dados[Constante::SALARIO]]);
                $this->table->add_row(array(
                    'data' => 'NÍVEL HIERÁRQUICO: ',
                    'class' => "direita"
                ), $nivel_hierarquico_array[$dados[Constante::NIVEL_HIERARQUICO]]);
                $this->table->add_row(array(
                    'data' => 'ÁREA DE INTERESSE: ',
                    'class' => "direita"
                ), $area_interesse_array[$dados[Constante::AREA_INTERESSE]]);
                $this->table->add_row(array(
                    'data' => 'FUNÇÕES: ',
                    'class' => "direita"
                ), $dados[Constante::FUNCOES]);
                $this->table->add_row(array(
                    'data' => 'BENEFÍCIOS: ',
                    'class' => "direita"
                ), $dados[Constante::BENEFICIOS]);
                $this->table->add_row(array(
                    'data' => 'ESTADO: ',
                    'class' => "direita"
                ), $estado_array[$dados[Constante::ESTADO]]);
                $this->table->add_row(array(
                    'data' => 'CIDADE: ',
                    'class' => "direita"
                ), $dados[Constante::CIDADE]);
                $this->table->add_row($navegacao);
            }

            echo $this->table->generate();
            echo $this->pagination->create_links();
            ?>
		</div>
		
	</div>
</body>
</html>