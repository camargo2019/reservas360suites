<?php
//Gabriel CMR - Desenvolvimentos
//Functions do Sistema

namespace Classe\Functions;

	class Paginacao{
		public function pagina($pg, $pga, $pgp, $pgo){
			global $db;
			if($pg && $pga && $pgp && $pga != true){
				return __DIR__.'/../pg/pg.inicio.php';
			}elseif($pg == "EN"){
				$_SESSION['idioma'] = "EN";
			}elseif($pg == "PT"){
				$_SESSION['idioma'] = "PT";
			}elseif($pg == 'Checkout'){
				return __DIR__.'/../pg/pg.checkout.php';
			}elseif($pg == "Search"){
				return __DIR__.'/../pg/pg.search.php';
			}elseif($pg == "Finalization"){
				include __DIR__."/../pg/pg.finalization.php";
			}elseif($pg == "VerMais"){
			    return __DIR__."/../pg/pg.vermais.php";
			}elseif($pg == "Concluido"){
				return __DIR__."/../pg/pg.concluido.php";
			}elseif($pg == "Pagamento"){
				return __DIR__.'/../pg/pg.pagamento.php';
			}else{
				return __DIR__.'/../pg/pg.inicio.php';
			}
		}
	}

	class Formatacao{
		public function texto($texto, $maximo){
			$Palavra_ajustada = substr($texto, 0, $maximo); 
				if(strlen($texto) > $maximo) {
					return $Palavra_ajustada.'...';
				}else {
					return $texto;
				}
		}
	}