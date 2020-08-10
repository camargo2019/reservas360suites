<?php
//Gabriel CMR - Desenvolvimentos  
//Configurações do Sistema 

	error_reporting(0); //Não listar erros  

	session_start();
 
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); 

	date_default_timezone_set('America/Sao_Paulo'); 

	$base = "/reservas"; //Local que está o sistema

	$servidor_db = "localhost"; //Servidor do banco de dados

	$usuario_db = "exoticwe_reserva"; //Usuário do banco de dados

	$senha_db = "exoticwe_reservas"; //Senha do banco de dados

	$nome_db = "exoticwe_reservas"; //Nome do banco de dados

	$keys['apiKey'] = "815ff14a654e5420b745ccfa941433b4"; //Apikey do Beds24

	$PagSeguro_email = "caio@360suites.com.br";

	$PagSeguro_token = "9E9DB1D4505090C994C96F9B70A62F13";

	$PagSeguro_NomeUsuario = "360SuitesReservas";

	$PagSeguro_SenhaUsuario = "360SuitesReservas@2020";

	$PagSeguro_Parametro = "transaction_id";
