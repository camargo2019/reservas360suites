<?php
//Gabriel CMR - Desenvolvimentos
// Plagio e Crime

	require __DIR__.'/../php/autoload.php';

if($_POST['roomId'] && $_POST['entrada'] && $_POST['saida'] && $_POST['quartos']){
	echo base64_encode($_POST['roomId']."-&&-".$_POST['entrada']."-&&-".$_POST['saida']."-&&-".$_POST['quartos']);
}