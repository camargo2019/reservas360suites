<?php
//Gabriel CMR - Desenvolvimentos
//Pagina inicial

	include __DIR__.'/pg.menu.php';

	$exp = base64_decode($_GET['pga']);
	$rt = explode('-&&-', $exp);
	$idRoom = $rt[0];

	$infoDb = $db->row('SELECT * FROM 360suites_ordens WHERE id="'.$idRoom.'"');
	if($infoDb){


		$soma = $infoDb->valor;
		$soma_itens = 0;
			$infoOO = json_decode($infoDb->value_adicional);
			foreach($infoOO as $inf){
				$infor = base64_decode($inf);
				$infor = explode("-&&-", $infor);
				$soma_itens += $infor[0];
				$add_json .= '"'.$infor[1].'": "'.$infor[0].'",';
			}

		$soma = $soma * $infoDb->quartos;
		$all_valor = $soma_itens + $soma;
?>
<form method="post" target="pagseguro"  
action="https://pagseguro.uol.com.br/v2/checkout/payment.html">  
          
<input name="receiverEmail" type="hidden" value="<?=$PagSeguro_email;?>">  
<input name="currency" type="hidden" value="BRL">  
  
  
<input name="itemId1" type="hidden" value="0001">  
<input name="itemDescription1" type="hidden" value="Reserva 360Suites">  
<input name="itemAmount1" type="hidden" value="<?=number_format($all_valor,2,".",",");?>">  
<input name="itemQuantity1" type="hidden" value="1">

<input name="reference" type="hidden" value="<?=$infoDb->id_systema;?>">  
          
<input name="senderName" type="hidden" value="<?=$infoDb->primeiroNome." ".$infoDb->sobrenome;?>">
<input name="senderEmail" type="hidden" value="<?=$infoDb->email;?>">  

<div id="container">
<script>$('.contentHeader').attr('style', 'display:none');</script>
<div class="center">

	<div class="FaturaSistemaColorWhite">
		<div class="row">
			<div class="col-sm">
		<div class="FaturaSistemaTitle">Fatura #<?=$infoDb->id;?></div>
		<div class="FaturaSistemaSubTitle">Data Entrada: <?=$infoDb->data_entrada;?></div>
		<div class="FaturaSistemaSubTitle">Data Saida: <?=$infoDb->data_saida;?></div>
		<div class="FaturaSistemaSubTitle">Quarto(s): <?=$infoDb->quartos;?></div>
		<div class="FaturaSistemaSubTitle">Valor Total: R$ <?=number_format($all_valor,2,",",".");?></div>
		</div>
		<div class="col-sm">
		<div class="FaturaSistemaTitle">Olá, <?=$infoDb->primeiroNome;?> <?=$infoDb->sobrenome;?></div>
		<div class="FaturaSistemaSubTitle">Status da sua Fatura: <?=$infoDb->pago;?></div>
		<?php if($infoDb->pago == "Pendente"){ ?>
		<div class="FaturaSistemaSubTitle"><button   type="image"  name="submit">Pagar com PagSeguro</button></div>
		<?php } ?>
		<div class="FaturaSistemaSubTitle">Caso você já pagou aguarde algumas horas para a confirmação!</div>
		</div>
	</div>
	</div>

</div>
</div>
</form>
<?php
}else{
	echo "<script>window.location.replace('".$base."');</script>";
}



//Include Menu
include __DIR__.'/pg.footer.php';