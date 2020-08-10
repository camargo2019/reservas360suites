<?php
//Gabriel CMR - Desenvolvimentos
//Pagina inicial

	include __DIR__.'/../php/autoload.php';
	set_time_limit(0);
	$class = new Classe\Api\Beds24\Room;
	$info_room = $class->room_id();
	$exist = [];
	foreach($info_room as $info){
		if(is_string($info)){
			if(in_array($info, $exist) == false){
			$exist[] = $info;
			$nome_room = $class->nome_room($info);
			$info_img = $class->room_imagens($info);
			$text_room = $class->room_texto($info);
			$valor_room = $class->valor_room($info,  date('Ymd'));
		}
	}
	}

	echo "Api Atualizada!";