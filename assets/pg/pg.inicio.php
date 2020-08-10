<?php
//Gabriel CMR - Desenvolvimentos
//Pagina inicial

	include __DIR__.'/pg.menu.php';

?>
<div id="container">
<div class="RoomList center">
	<ul>
<?php
	$class = new Classe\Api\Beds24\Room;
	$info_room = $class->room_id();
	$edificio = [];
	foreach($info_room as $info){
		$class_for = new Classe\Api\Beds24\Room;
		$format = new Classe\Functions\Formatacao;
		$nome_room = $class_for->nome_room($info);
		$info_img = $class_for->room_imagens($info);
		$quartos_disponivel = '';//$class_for->room_quantidade_quartos($info);
		$text_room = htmlentities($format->texto($class_for->room_texto($info), 300));
		$valor_room = $class_for->valor_room($info,  date('Ymd'));
		$i = 0;
		if(in_array($info, $edificio) == false){
		$edificio[] = $info;
		if($nome_room && $valor_room && $text_room && $info_img){
		$html = ""; 
		$html .= "<li>
		<div class='ItemListRoom'>";
				$html .= "<div class='PersonalizeCarroselImg owl-carousel owl-theme' id='".$info."'>";
					$i = 0;
					foreach($info_img as $imgHtml){
					    if($i <= 11){
							$html .= "<img class='owl-lazy' data-src='".$imgHtml."'>";
							$i++;
					    }
					}
				$html .= "</div>";
				$html .= "<div class='TitlteItemListRoom'>".$nome_room."</div>";
				$html .= "<div class='QuartosItemListRoom'>".$quartos_disponivel."</div>";
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
				echo $html;
		}
	}
	}

	?>
</ul>
</div>
</div>

<?php
//Include Menu
include __DIR__.'/pg.footer.php';