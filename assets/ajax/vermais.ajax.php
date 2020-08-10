<?php 
//Gabriel CMR - Desenvolvimentos
//Ver mais Ajax

require __DIR__.'/../php/autoload.php';

if($_POST['roomId']){
?>
<div id="container">
	<div class="leftContainer" onclick="inicial();"><i class="fas fa-arrow-circle-left"></i></div>
	<div class="center --1100width">
		<div class="InforVerMais">

<?php
		$class = new Classe\Api\Beds24\Room;
		$nome_room = $class->nome_room($_POST['roomId']);
		$info_img = $class->room_imagens($_POST['roomId']);
		$text_room = $class->room_texto($_POST['roomId']);
		$valor_room = $class->valor_room($_POST['roomId'],  date('Ymd'));
		$i = 0;
		if($nome_room && $info_img){
				$html .= "<div class='InforVerMaisPersonalizeCarroselImg owl-carousel owl-theme' id='".$_POST['roomId']."'>";
					$i = 0;
					foreach($info_img as $imgHtml){
						if($i > 10){
							//Não listar nenhuma
						}else{
							$html .= "<img class='owl-lazy' data-src='".$imgHtml."'>";
							$i++;
						}
					}
				$html .= "</div>";
				$html .= "<div class='InforVerMaisfloatLeft'>
				<div class='InforVerMaisTitlteItemListRoom'>".$nome_room."</div><br/>";
				$html .= "<div class='InforVerMaisTextItemListRoom'>".$text_room."</div></div>";
				$html .= "<script> $(document).ready(function(){ $('#".$_POST['roomId']."').owlCarousel({items: 1, lazyLoad: true, lazyLoadEager: 1, loop: true, margin: 10, autoHeight: true, autoplay:true, autoplayTimeout:20000,}); });</script> </li>";
		}

	echo $html;
	$info = $class->valores_rooms($_POST['roomId']);
  	


  	?>
  	<div class="informacoesDate">
		<div class="RowConteudoBox">
					<div class="RowConteudoBoxLabelDate">
						<label class="sbox-dates-label">Datas</label>
						<label class="sbox-dates-label"></label>
					</div>
				<div class="RowContentBoxInputDate">
				<div class="RowContentBoxInputDate-input">
					<div class="input-container">
						<input type="text" placeholder="Entrada" id="entrada_assinar" class="input-tag-sbox-checkin-date">
						<i class="inputIBox far fa-calendar-alt"></i>
						<span class="validation-msg error_entrada">Insira uma data de entrada.</span>
					</div>
				</div>
				<div class="RowContentBoxInputDate-input2">
					<div class="input-container">
						<input type="text" placeholder="Saída" id="saida_assinar" class="input-tag-sbox-checkin-date">
						<i class="inputIBox far fa-calendar-alt"></i>
						<span class="validation-msg error_saida">Insira uma data de Saída.</span>
					</div>
				</div>
			</div>

		<div class="RowConteudoBox2">
			<div class="RowConteudoBoxV">
				<div class="RowConteudoBoxVV">
					<label class="RowConteudoBoxVV-label">Quantos Quartos?</label>
						<div class="RowConteudoBoxVV-input">
							<div class="RowConteudoBoxVV-input-relative">
								<div class="input-container">
									<input type="number" autocomplete="disabled" id="quartos_assinas" placeholder="Quantos Quartos?" class="input-containerInput">
									<span class="input-gradient"></span>
									<i class="inputIBox fas fa-bed"></i>
									<span class="validation-msg error_pessoas">Coloque a quantidade de quartos.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<div class="RowButton" style="width: 50px;margin: 0 auto;margin-right: 55%;margin-top: 2rem;">
			<div class="RowButtonConteiner">
				<a href="javascript:verificar_room('<?=$_POST['roomId'];?>');">
					<i class="iconButton fas fa-search"></i>
					<em class="btn-text">Verificar</em>
				</a>
			</div>
		</div>
  	</div>
  	<div id="containerReturn">

  	</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$("#entrada_assinar").datepicker({
	format:"dd/mm/yyyy",
	days:["Domingo","Segunda","Terça","Quarta","Quinta","Sexta","Sábado"],
	daysShort:["Dom","Seg","Ter","Qua","Qui","Sex","Sáb"],
	daysMin:["D","S","T","Q","Q","S","S"],
	months:["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],mmonthsShort:["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"]
}).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        $('#entrada_assinar').datepicker('setStartDate', startDate);
 });  
$("#saida_assinar").datepicker({
	format:"dd/mm/yyyy",
	days:["Domingo","Segunda","Terça","Quarta","Quinta","Sexta","Sábado"],
	daysShort:["Dom","Seg","Ter","Qua","Qui","Sex","Sáb"],
	daysMin:["D","S","T","Q","Q","S","S"],
	months:["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],mmonthsShort:["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"]
}).on('changeDate', function(selected){
        startDate = new Date(selected.date.valueOf());
        $('#saida_assinar').datepicker('setEndDate', startDate);
 });
	setTimeout(function(){
 		$('.FnBlurEmabassar').removeAttr('style');
 		$('.carregamento').attr('style', 'display:none;');
 	
 	}, 5000);
</script>
<?php }else{

	include __DIR__.'/../pg/pg.error.php';

}
?>