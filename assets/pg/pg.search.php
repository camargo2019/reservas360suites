<?php
	//Gabriel CMR - Desenvolvimentos
	//Search

	include __DIR__.'/pg.menu.php';


$info = explode('-&&-', base64_decode($_GET['pga']));

$cidade_ou_hotel = $info[0];
$data_entrada = $info[1];
$data_saida = $info[2];
$quartos = $info[3];

$cidade_ou_hotel_search = $db->row("SELECT * FROM 360suites_informacoeshotel WHERE name LIKE '%".$cidade_ou_hotel."%'");

$propKey = $cidade_ou_hotel_search->prokey;
?>
<script>
$('.destino_info').val('<?=$cidade_ou_hotel;?>');
$('.entrada_info').val('<?=$data_entrada;?>');
$('.saida_info').val('<?=$data_saida;?>');
$('.quartos_info').val('<?=$quartos;?>');
</script>
<div id="container">
<div class="RoomList center">
	<ul>
<?php
$class = new Classe\Api\Beds24\Room;
	$html = ""; 
	if($data_entrada && $data_saida && $quartos){
	$info_room = $class->room_id_search($propKey, $data_entrada, $data_saida);
			$soma = 0;
			$error = '';
			$success = [];
			$in = 0;
			$listagem = 0;
	if(count($info_room) >= 1){
			foreach($info_room as $info){
				$date = $class->valores_room_unit($info, $data_entrada, $data_saida, $propKey);
				foreach ($date as $value) {
					if($value['i'] >= $quartos){
							$success[] = $info;
					}else{
						$error = 'Infelizmente não temos essa quantidade de quartos! No dia '.date('d/m/Y', strtotime($key));
					}
			}
		if(in_array($info, $success)){
		$format = new Classe\Functions\Formatacao;
		$nome_room = $class->nome_room($info);
		$info_img = $class->room_imagens($info);
		$text_room = $format->texto($class->room_texto($info), 300);
		$valor_room = $class->valor_room($info,  date('Ymd'));
		if($nome_room && $info_img){
			$listagem++;
		$html .= "<li>
		<div class='ItemListRoom'>";
				$html .= "<div class='PersonalizeCarroselImg owl-carousel owl-theme' id='".$info."'>";
					$i = 0;
					foreach($info_img as $imgHtml){
						if($i > 10){
							break;
						}else{
							$html .= "<img class='owl-lazy' data-src='".$imgHtml."'>";
							$i++;
						}
					}
				$html .= "</div>";
				$html .= "<div class='TitlteItemListRoom'>".$nome_room."</div>";
				$html .= "<div class='TextItemListRoom'>".$text_room."</div>";
				$html .= "<div class='ReserveInformacoes'>";
				$html .= '<div class="ItemListPriceBox">
							<div class="ItemListPriceBoxDescription">Preço por adulto a partir de</div>
								<div class="ItemListPriceBoxPrice">
	    							<span class="ItemListPriceBoxSimbolo">R$</span>'.$valor_room.'</div>
    					</div>';
				$html .= "<button class='VerInformacoes' onclick='ver_mais(\"".$info."\")'>Ver mais</button>
				</div>";
				$html .= "</div>";
				$html .= "<script> $(document).ready(function(){ $('#".$info."').owlCarousel({items: 1, lazyLoad: true, lazyLoadEager: 1, loop: true, margin: 10, autoHeight: true, autoplay:true, autoplayTimeout:20000,}); });</script> </li>";
		}

		}
	}
	if($listagem <= 0){
		?>
		<div class="row">
			<div class="col-sm closeTimes"><i class="far fa-times-circle"></i></div>
		</div>
		<div class="row">
		<div class="col-sm">
			<div class="FaturaSistemaTitle" style="text-align:center;">Não encontramos nenhum edifício disponivel nestas datas.</div>
		</div>
	</div>
<?php
	}
	echo $html;
}else{

?>
		<div class="row">
			<div class="col-sm closeTimes"><i class="far fa-times-circle"></i></div>
		</div>
		<div class="row">
		<div class="col-sm">
			<div class="FaturaSistemaTitle" style="text-align:center;">Não encontramos nenhum edifício disponivel nestas datas.</div>
		</div>
	</div>
<?php
}



}else{
	$info_room = $class->room_id_search_2($propKey);
$listagem = 0;
$html = '';
$edificio = [];
foreach($info_room as $info){
		$format = new Classe\Functions\Formatacao;
		$nome_room = $class->nome_room($info);
		$info_img = $class->room_imagens($info);
		$text_room =  htmlentities($format->texto($class->room_texto($info), 300));
		$valor_room = $class->valor_room($info,  date('Ymd'));

		if(in_array($info, $edificio) == false){
			$edificio[] = $info;
		if($nome_room && $valor_room){
			$listagem++;
		$html .= "<li>
		<div class='ItemListRoom'>";
				$html .= "<div class='PersonalizeCarroselImg owl-carousel owl-theme' id='".$info."'>";
					$i = 0;
					foreach($info_img as $imgHtml){
						if($i > 10){
							break;
						}else{
							$html .= "<img class='owl-lazy' data-src='".$imgHtml."'>";
							$i++;
						}
					}
				$html .= "</div>";
				$html .= "<div class='TitlteItemListRoom'>".$nome_room."</div><br/>";
				$html .= "<div class='TextItemListRoom'>".$text_room."</div>";
				$html .= "<div class='ReserveInformacoes'>";
				$html .= '<div class="ItemListPriceBox">
							<div class="ItemListPriceBoxDescription">Preço por adulto a partir de</div>
								<div class="ItemListPriceBoxPrice">
	    							<span class="ItemListPriceBoxSimbolo">R$</span>'.$valor_room.'</div>
    					</div>';
				$html .= "<button class='VerInformacoes' onclick='ver_mais(\"".$info."\")'>Ver mais</button>
				</div>";
				$html .= "</div>";
				$html .= "<script> $(document).ready(function(){ $('#".$info."').owlCarousel({items: 1, lazyLoad: true, lazyLoadEager: 1, loop: true, margin: 10, autoHeight: true, autoplay:true, autoplayTimeout:20000,}); });</script> </li>";
		}
	}
}
echo $html;

if($listagem <= 0){

?>
		<div class="row">
			<div class="col-sm closeTimes"><i class="far fa-times-circle"></i></div>
		</div>
		<div class="row">
		<div class="col-sm">
			<div class="FaturaSistemaTitle" style="text-align:center;">Não encontramos nenhum apartamento deste edifício disponível hoje.</div>
		</div>
	</div>
<?php
}

}
	?>

</ul>
</div>
</div>
<?php
	include __DIR__.'/pg.footer.php';