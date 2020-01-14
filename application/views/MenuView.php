<?php
defined('BASEPATH') || exit('No direct script access allowed');

$usuario = null;
if ($this->session->userdata('usuario' !== null)) {
    $usuario = $this->session->userdata('usuario');
}
?>
<nav class="navbar fixed-top navbar-expand-sm bg-company">
	<button class="navbar-toggler" type="button" data-toggle="collapse"
		data-target="#nav-content" aria-controls="nav-content"
		aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<!-- Links -->
	<div class="collapse navbar-collapse" id="nav-content">
		<ul class="navbar-nav">
			<li><?= anchor('HomeController/VerPagina', 'Home | ', array('class' => '')); ?></li>
			<li><?= anchor('CockPitController/VerRegistro', 'Cock Pit | ', array('class' => '')); ?></li>
			<li><?= anchor('AuditoriaController/VerRegistro', 'Auditoria | ', array('class' => '')); ?></li>
			<li><?= anchor('BloqueiosController/VerRegistro', 'Bloqueios | ', array('class' => '')); ?></li>
			<li><?= anchor('OutrosController/VerRegistro', 'Outros | ', array('class' => '')); ?></li>
			<li><?= anchor('StatusServidoresController/VerRegistro', 'Status Servidores | ', array('class' => '')); ?></li>
			<li><?= anchor('EventosController/VerRegistro', 'Eventos | ', array('class' => '')); ?></li>
			<li><?= anchor('ConexoesController/VerRegistro', 'Conexões | ', array('class' => '')); ?></li>
			<li><?= anchor('ConfiguracoesController/VerRegistro', 'Configurações', array('class' => '')); ?></li>
		</ul>
	</div>
</nav>