<div class="AndTotalOrcamento">
	<div class="TotalOrcamento">
<?php
//Gabriel CMR - Desenvolvimentos
//Plagio e Crime

	require __DIR__.'/../php/autoload.php';

if($_POST['roomId'] && $_POST['entrada'] && $_POST['saida'] && $_POST['quartos']){
	$db_info_room = $db->row('SELECT * FROM 360suites_roomids WHERE roomId="'.$_POST['roomId'].'"');
	$info_key = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE id="'.$db_info_room->id_hotel.'"');

	$date = Classe\Api\Beds24\Room::valores_room_unit($_POST['roomId'], $_POST['entrada'], $_POST['saida'], $info_key->prokey);
	$soma = 0;
	$error = [];
	$success = '';
	$in = 0;
	
	foreach ($date as $value) {
	if($value['i'] >= $_POST['quartos']){
			if($value['p1']){
				$in += 1;
				$soma += $value['p1'];
				$success = 'p1-disponivel';
			}else{
				$error[] = 'error';
			}
		}else{
			$error[] = 'error'; 
		}
	}

	if(in_array('error', $error)){
		?>
<div class="alert alert-danger" role="alert">
  Não temos vagas disponivel no momento para estas datas!
</div>
		<?php
	}else{


	$texto = '';
	if($in <= 0){
		?>
<div class="alert alert-danger" role="alert">
  Não temos vagas disponivel no momento para estas datas!
</div>
		<?php
	}elseif($success == 'p1-disponivel'){
		$soma = $soma * $_POST['quartos'];
		$nome_quarto = '';
		if($_POST['quartos'] == '1'){
			$nome_quarto = 'Um';
		}elseif($_POST['quartos'] == '2'){
			$nome_quarto = 'Dois';
		}elseif($_POST['quartos'] == '3'){
			$nome_quarto = 'Três';
		}elseif($_POST['quartos'] == '4'){
			$nome_quarto = 'Quatro';
		}elseif($_POST['quartos'] == '5'){
			$nome_quarto = 'Cinco';
		}elseif($_POST['quartos'] == '6'){
			$nome_quarto = 'Seis';
		}elseif($_POST['quartos'] == '7'){
			$nome_quarto = 'Sete';
		}elseif($_POST['quartos'] == '8'){
			$nome_quarto = 'Oito';
		}elseif($_POST['quartos'] == '9'){
			$nome_quarto = 'Nove';
		}elseif($_POST['quartos'] == '10'){
			$nome_quarto = 'Dez';
		}
		?>
				<script type="text/javascript">
					var roomId_checkout = '<?=$_POST['roomId']?>',
					entrada_checkout  = '<?=$_POST['entrada'];?>',
					saida_checkout = '<?=$_POST['saida'];?>',
					quartos_checkout = '<?=$_POST['quartos']?>';
				</script>
			<div class="TotalOrcamentosInformativo"><strong>Importante:</strong> um quarto tem ocupação máxima para duas pessoas!</div>
			<div class="datasEntradaAndSaida">
				<div class="dataEntradaInformativo">Data de entrada: <?=$_POST['entrada'];?></div>
				<div class="dataSaidaInformativo">Data de saida: <?=$_POST['saida'];?></div>
			</div>
			<div class="total"><?=$nome_quarto;?> quarto(s) por apenas R$ <?=number_format($soma,2,",",".");?></div>
			<div class="ButtonCheckout"><button onclick="fazer_checkout('<?=$_POST['roomId']?>', '<?=$_POST['entrada'];?>', '<?=$_POST['saida'];?>', '<?=$_POST['quartos']?>');">Fazer Check-In <i class="fas fa-arrow-right"></i></button></div>
			<span class="validation-msg error_checkout">Não conseguimos fazer o checkout, Tente novamente!</span>
		<?php
	}elseif($error){
		?>
<div class="alert alert-danger" role="alert">
  <?=$error;?>
</div>
		<?php
	} }
}else{
	?>
<div class="alert alert-danger" role="alert">
  Infelizmente não conseguimos retornar nenhuma informação!
</div>
	<?php
}
?>
		</div>
	</div>