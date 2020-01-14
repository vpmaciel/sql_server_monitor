<?php
defined('BASEPATH') || exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    $this->load->view('CabecalhoView');
    ?> 
    <meta http-equiv="refresh" content="5;url=http://127.0.1.1/sql_server_monitor/">
    
</head>
<body>
	<div class="row">
        <?php $this->load->view('MenuView'); ?>
		<div class="col-lg-12">
			<h1>Sql Server Monitor</h1>
			<div align="center">
				<p align="justify">O Sql Server Monitor é um sistema para Internet
					de monitoramento de Banco de Dados MS Sql Server on-line.</p>
			</div>
    	<?php

            $lista = $this->UsuarioModel->ObterRegistro();

            $template = array(
                'table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="tabela">'
            );

            $this->table->set_template($template);
            $this->table->set_heading('ID Bloqueado', 'ID Bloqueando', 'Query Bloqueada', 'Query Bloqueando', 'Tempo (ms)', 'Host Bloqueado', 'Data e Hora', 'Programa Bloqueado', 'Programa Bloqueando', 'Host Bloqueando');

            while ($dados = array_shift($lista)) {
                $this->table->add_row($dados['blockedsid'], $dados['blockingsid'], $dados['eventinfo1'], $dados['eventinfo2'], $dados['waittime'], $dados['hostname'], $dados['dat_bloqueio'], $dados['program_name1'], $dados['program_name2'], $dados['host_blocking']);
            }

            echo $this->table->generate();
        ?>
		</div>
	</div>
</body>
</html>