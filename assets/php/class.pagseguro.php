<?php
//Gabriel CMR - Desenvolvimentos
//PagSeguro

namespace PagSeguro\PagSeguro;

	class Fatura{
		public function atualizacao($id){
				global $PagSeguro_email;
				global $PagSeguro_token;
			    $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' .$id. '?email='.$PagSeguro_email.'&token='.$PagSeguro_token;
			    $curl = curl_init($url);
			    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			    $transaction = curl_exec($curl);
			    curl_close($curl);

			    return $transaction;
		}

		 public function status_fatura($refente){
		 	global $db;
		 	$atualiza = $db->update('360suites_ordens', ['pago' => 'Pago'], ['id_systema' => $refente]);
		 	$tr = \Classe\Api\Beds24\Checkout::atualizar_fatura_pag($refente);
		 	return true;
		 }
	}
