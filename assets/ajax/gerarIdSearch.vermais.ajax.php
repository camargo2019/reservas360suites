<?php
//Gabriel CMR - Desenvolvimentos
// Plagio e Crime

	require __DIR__.'/../php/autoload.php';

if($_POST['destino_info'] && $_POST['entrada_info'] && $_POST['saida_info'] && $_POST['quartos_info']){
	echo base64_encode($_POST['destino_info']."-&&-".$_POST['entrada_info']."-&&-".$_POST['saida_info']."-&&-".$_POST['quartos_info']);
}