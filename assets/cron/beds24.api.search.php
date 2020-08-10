<?php
	//Gabriel CMR - Desenvolvimentos
	//Search Autoload

	include __DIR__.'/../php/autoload.php';
	set_time_limit(0);
	$cidade_ou_hotel_search = $db->rows("SELECT * FROM 360suites_informacoeshotel");

foreach ($cidade_ou_hotel_search as $cidade){
	$propKey = $cidade->prokey;

	$class = new Classe\Api\Beds24\Room;
	$array_date = [];
	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+1 day",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+2 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+2 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+3 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+3 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+4 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+4 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+5 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+5 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+6 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+6 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+7 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+7 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+8 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+8 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+9 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+9 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+10 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+10 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+11 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+11 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+12 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+12 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+13 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+13 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+14 days",strtotime(date('d/m/Y'))))
	);

	$array_date[] = array(
		'data_entrada' => date('d/m/Y', strtotime("+14 days",strtotime(date('d/m/Y')))),
		'data_saida' => date('d/m/Y', strtotime("+15 days",strtotime(date('d/m/Y'))))
	);

	foreach($array_date as $date){

		$info_room = $class->room_id_search($propKey, $date['data_entrada'], $date['data_saida']);
		foreach($info_room as $info){
			$format = new Classe\Functions\Formatacao;
			$nome_room = $class->nome_room($info);
			$info_img = $class->room_imagens($info);
			$text_room = $class->room_texto($info);
			echo $info." Cadastrado no Search  </br>";
		}
	}

}