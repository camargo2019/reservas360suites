<?php
//Gabriel CMR - Desenvolvimentos

	include __DIR__.'/pg.menu.php';

	$fat = new PagSeguro\PagSeguro\Fatura;
	$info = $fat->atualizacao($_GET['transaction_id']);
?>


<div id="container">
<div class="center">

	<div class="FaturaSistemaColorWhite">
<?php
if($info == "Unauthorized"){

?>
		<div class="row">
			<div class="col-sm closeTimes"><i class="far fa-times-circle"></i></div>
		</div>
		<div class="row">
		<div class="col-sm">
			<div class="FaturaSistemaTitle" style="text-align:center;">Opss... Infelizmente não conseguimos identificar o seu pagamento, tente novamente!</div>
		</div>
	</div>
<?php }else{
	$transaction = simplexml_load_string($info);
	if($transaction->status == "1"){

?>
		<div class="row">
			<div class="col-sm warning"><i class="fas fa-exclamation-triangle"></i></div>
		</div>
		<div class="row">
		<div class="col-sm">
			<div class="FaturaSistemaTitle" style="text-align:center;">Seu pagamento está pendente, estamos ansios para encontrar você!</div>
		</div>
	</div>
<?php
	}elseif($transaction->status == "2"){
?>
		<div class="row">
			<div class="col-sm warning"><i class="fas fa-exclamation-triangle"></i></div>
		</div>
		<div class="row">
		<div class="col-sm">
			<div class="FaturaSistemaTitle" style="text-align:center;">Seu pagamento está em analise logo estaremos trazendo mais novidades para você sobre sua reserva!</div>
		</div>
	</div>
<?php
	}elseif($transaction->status == "3"){
		 $fat->status_fatura($transaction->reference);
?>
<div class="row">
			<div class="col-sm success"><i class="far fa-check-circle"></i></i></div>
		</div>
		<div class="row">
		<div class="col-sm">
			<div class="FaturaSistemaTitle" style="text-align:center;">Seu pagamento está Aprovado, você será notificado por e-mail sobre as informações da sua reserva!</div>
		</div>
	</div>
<?php
	}else{

?>
		<div class="row">
			<div class="col-sm closeTimes"><i class="far fa-times-circle"></i></div>
		</div>
		<div class="row">
		<div class="col-sm">
			<div class="FaturaSistemaTitle" style="text-align:center;">Opss... Infelizmente não conseguimos identificar o seu pagamento, tente novamente!</div>
		</div>
	</div>
<?php
	}

} ?>
	</div>

</div>
</div>
<?php
	include __DIR__.'/pg.footer.php';