<?php
//Gabriel CMR - Desenvolvimentos

	include __DIR__.'/pg.menu.php';

?>


<div id="container">
<div class="center">

	<div class="FaturaSistemaColorWhite">
<?php
if($_GET['pga'] == "NaoDisponivel"){

?>
		<div class="row">
			<div class="col-sm closeTimes"><i class="far fa-times-circle"></i></div>
		</div>
		<div class="row">
		<div class="col-sm">
			<div class="FaturaSistemaTitle" style="text-align:center;">Ops....</div>
			<div class="FaturaSistemaTitle" style="text-align:center;">Não temos mais esse apartamento disponivel no momento!</div>
		</div>
	</div>
<?php } ?>
	</div>

</div>
</div>
<?php
	include __DIR__.'/pg.footer.php';