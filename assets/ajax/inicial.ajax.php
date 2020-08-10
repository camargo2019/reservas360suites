<?php 
//Gabriel CMR - Desenvolvimentos
//Ver mais Ajax

require __DIR__.'/../php/autoload.php';

?>
<div class="RoomList center">
	<ul>
<?php 
	$info_room = Classe\Api\Beds24\Room::room_id();
	foreach($info_room as $info){
		$nome_room = Classe\Api\Beds24\Room::nome_room($info);
		$info_img = Classe\Api\Beds24\Room::room_imagens($info);
		$text_room = Classe\Functions\Formatacao::texto(Classe\Api\Beds24\Room::room_texto($info), 300);
		$valor_room = Classe\Api\Beds24\Room::valor_room($info,  date('Ymd'));
		$i = 0;
		if($nome_room && $info_img){
	$html = "";
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
	echo $html;

		}
	}
		?>
</ul>
</div>