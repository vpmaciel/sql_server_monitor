<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>
<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0");
?>
<meta charset="utf-8">
<meta http-equiv="Content-Language" content="pt-br">
<meta name="author" content="Vicente Paulo Maciel">
<meta name="description"
	content="Site de recrutamento on-line, divulgar vagas de emprego e cadastro de currículos">
<meta name="keywords"
	content="emprego,vaga,trabalho,currículo,rh,recursos humanos,curriculum vitae,cadastro de currículo,cebusca">
<meta name="robots" content="no-cache" />
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Currículo - CeBusca</title>
<link rel="icon" type="image/ico"
	href="<?= base_url('assets/img/favicon.ico') ?>">
<link rel="stylesheet" type="text/css"
	href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
<script src="<?= base_url('assets/bootstrap/js/jquery-3.2.1.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap/js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/js.js') ?>"></script>
<?php
$css = 'assets/css/estilo.css?' . time();
?>
<link rel="stylesheet" type="text/css" href="<?= base_url("$css") ?>">