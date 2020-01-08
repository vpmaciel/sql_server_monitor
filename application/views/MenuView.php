<?php
defined('BASEPATH') || exit('No direct script access allowed');

$usuario = null;
if ($this->session->userdata(Constante::USUARIO) !== null) {
    $usuario = $this->session->userdata(Constante::USUARIO);
}
?>
<nav class="navbar fixed-top navbar-expand-sm bg-company">
	<button class="navbar-toggler" type="button" data-toggle="collapse"
		data-target="#nav-content" aria-controls="nav-content"
		aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<!-- Brand -->
    <?= anchor('CurriculoController/VerPagina', 'Sql Server Monitor', array('class' => 'navbar-brand')); ?>

    <!-- Links -->
	<div class="collapse navbar-collapse" id="nav-content">
		<ul class="navbar-nav">
			<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
				href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
				aria-haspopup="true" aria-expanded="false"> Sistema</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?= anchor('LoginPessoaController/VerRegistro', 'Login', array('class' => 'dropdown-item')); ?>
                    <?= anchor('LoginPessoaController/DestruirSessao', 'Sair', array('class' => 'dropdown-item')); ?>
                    <div class="dropdown-divider"></div>
                    <?= anchor('LoginPessoaController/VerRegistro', 'Cock Pit', array('class' => 'dropdown-item')); ?>
					<?= anchor('LoginPessoaController/VerRegistro', 'Auditoria', array('class' => 'dropdown-item')); ?>
                    <?= anchor('LoginEmpresaController/VerRegistro', 'Bloqueios', array('class' => 'dropdown-item')); ?>
                    <?= anchor('LoginEmpresaController/VerRegistro', 'Outros', array('class' => 'dropdown-item')); ?>
                    <?= anchor('LoginPessoaController/VerRegistro', 'Status Servidores', array('class' => 'dropdown-item')); ?>
					<?= anchor('LoginPessoaController/VerRegistro', 'Eventos', array('class' => 'dropdown-item')); ?>
                    <?= anchor('LoginEmpresaController/VerRegistro', 'Conexões', array('class' => 'dropdown-item')); ?>
                    <?= anchor('LoginEmpresaController/VerRegistro', 'Configurações', array('class' => 'dropdown-item')); ?>
                    <div class="dropdown-divider"></div>
                    <?= anchor('FaleConoscoController/VerPagina', 'Fale Conosco', array('class' => 'dropdown-item')); ?>
                </div>
        	</li>
		</ul>
	</div>
</nav>