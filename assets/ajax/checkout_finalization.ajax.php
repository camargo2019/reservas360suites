<?php
//Gabriel CMR - Desenvolvimentos
// Plagio e Crime

	require __DIR__.'/../php/autoload.php';

	$value_adicional = $_POST['value_adicional'];
	$anotacoes = $_POST['anotacoes'];
	$roomId = $_POST['roomId'];
	$data_entrada = $_POST['data_entrada'];
	$data_saida = $_POST['data_saida'];
	$quartos = $_POST['quartos'];
	$primeiroNome = $_POST['primeiroNome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$rghospede = $_POST['rghospede'];
	$telefone = $_POST['telefone'];
	$paises = $_POST['paises'];
	$estado = $_POST['estado'];
	$cidade = $_POST['cidade'];
	$endereco = $_POST['endereco'];
	$captcha = $_POST['captcha'];
	$nomeacompanhante = $_POST['nomeacompanhante'];
	$rgacompanhante = $_POST['rgacompanhante'];
	$datenascimento = $_POST['datenascimento'];

	if($roomId && $data_entrada && $data_saida && $quartos && $primeiroNome && $sobrenome && $email && $rghospede && $telefone && $estado && $cidade && $endereco && $captcha && $datenascimento){
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6Lcf47kZAAAAAAAuAsII3-4IaCgxgLJaakdD-zVN&response='.$captcha);
        $responseData = json_decode($verifyResponse);
        $datenascimento_format = str_replace('/', '-', $datenascimento);
        $datenascimento_format = date('Y-m-d', strtotime($datenascimento_format));
        $idade = date('Y-m-d') - $datenascimento_format;

        if($idade >= 18){
        if($responseData->success){
        	$data = [
        		'id' => NULL,
        		'roomId' => $roomId,
        		'data_entrada' => $data_entrada,
        		'data_saida' => $data_saida,
        		'quartos' => $quartos,
        		'primeiroNome' => $primeiroNome,
        		'sobrenome' => $sobrenome,
        		'email' => $email,
        		'rghospede' => $rghospede,
        		'telefone' => $telefone,
        		'paises' => $paises,
        		'estado' => $estado,
        		'cidade' => $cidade,
        		'endereco' => $endereco,
        		'anotacoes' => $anotacoes,
        		'value_adicional' => json_encode($value_adicional),
        		'pago' => 'Pendente',
        		'api_enviado' => 'Y',
        		'id_systema' => '',
        		'valor' => '',
        		'nomeacompanhante' => $nomeacompanhante,
				'rgacompanhante' => $rgacompanhante,
				'datenascimento' => $datenascimento
        	];

        	$db->insert('360suites_ordens', $data);
        	$id_return = $db->lastInsertId();
        	$return = Classe\Api\Beds24\Checkout::insert($id_return);
        	if($return){
        	$db->update('360suites_ordens', ['id_systema' => $return['id_systema'], 'valor' => $return['valor']], ['id' => $id_return]);
        	$base64Return = base64_encode($id_return."-&&-".$rghospede."-&&-".$roomId);
        	echo "<script>window.location.replace('".$base."/Pagamento/".$base64Return."')</script>";
        	}else{
			?>
<div>
	<div class="TotalOrcamento">
		<div class="alert alert-danger" role="alert">
		  Opss.. Não conseguimos finalizar a sua reserva, tente novamente!
		</div>
	</div>
</div>
			<?php
        	}

		}else{
			?>
<div>
	<div class="TotalOrcamento">
		<div class="alert alert-danger" role="alert">
		  Opss.. Recaptcha invalido, tente novamente!
		</div>
	</div>
</div>
			<?php
		}
	}else{
		?>
<div>
	<div class="TotalOrcamento">
		<div class="alert alert-danger" role="alert">
		  Opss.. Você e menor de 18 anos!
		</div>
	</div>
</div>
			<?php
	}

	}else{

			?>
<div>
	<div class="TotalOrcamento">
		<div class="alert alert-danger" role="alert">
		  Opss.. Aconteceu algum erro, tente novamente!
		</div>
	</div>
</div>
			<?php
	}