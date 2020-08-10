<?php
//Gabriel CMR - Desenvolvimento

require __DIR__.'/assets/php/autoload.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="pt-br"  xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<title>Reserva - 360Suites.com.br</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="title" content="Reserva - 360Suites.com.br">
	<meta name="description" content="Reserva 360Suites.com.br">
	<meta name="developer" content="Gabriel Camargo (@camargo.2018)">
	<meta name="developer" content="Salviano Soluções TI">
	<link rel="shortcut icon" href="<?=$base;?>/assets/img/favicon.png">
	<link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.9/datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?=$base;?>/assets/css/style.min.css?<?=time();?>">
	<link rel="stylesheet" href="<?=$base;?>/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="<?=$base;?>/assets/css/owl.theme.default.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="<?=$base;?>/assets/js/owl.carousel.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.9/datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.9/i18n/datepicker.pt-BR.min.js"></script>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script> 
    var comboGoogleTradutor = null; //Varialvel global

    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'pt',
            includedLanguages: 'en,pt',
            layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
        }, 'google_translate_element');

        comboGoogleTradutor = document.getElementById("google_translate_element").querySelector(".goog-te-combo");
    }

    function changeEvent(el) {
        if (el.fireEvent) {
            el.fireEvent('onchange');
        } else {
            var evObj = document.createEvent("HTMLEvents");

            evObj.initEvent("change", false, true);
            el.dispatchEvent(evObj);
        }
    }

	function trocarIdioma(sigla) {
	        if (comboGoogleTradutor) {
	            comboGoogleTradutor.value = sigla;
	            changeEvent(comboGoogleTradutor);
	        }
	 }
</script>
	<script>var base = '<?=$base;?>'; var Y = <?=date('Y');?>; var M = <?=date('m');?>; var D = <?=date('d');?>;</script>
</head>
<body>
<div class="carregamento">
		<img src="<?=$base;?>/assets/img/carregamento_pg.gif">
</div>
<div class="FnBlurEmabassar" id="google_translate_element" style="transition: all 0.5s;-webkit-filter: blur(3px);">
<?php
	//Sistema de Paginação
	$pag = new Classe\Functions\Paginacao;

	include $pag->pagina($_GET['pg'], $_GET['pga'], $_GET['pgp'], $_GET['pgo']);

?>
</div>
<script type="text/javascript">
 //Carregamento de funções
 $(document).ready(function(){
 		$('.FnBlurEmabassar').removeAttr('style');
 		$('.carregamento').attr('style', 'display:none;');
 });
</script>
<script src="https://unpkg.com/blip-chat-widget" type="text/javascript">
</script>
<script>
    (function () {
        window.onload = function () {
            new BlipChat()
            .withAppKey('Ym90d2hhdHNhcHA3OmI0NTVjZDU2LWE5MzYtNGQ4My1iMTQ5LWVjOTUwNDljZTZhNQ==')
            .withButton({"color":"#bc204b","icon":""})
            .withCustomCommonUrl('https://chat.blip.ai/')
            .build();
        }
    })();
</script>
<script src="<?=$base;?>/assets/js/input.format.min.js?<?=time();?>"></script>
<script src="<?=$base;?>/assets/js/requeset.valores.js?<?=time();?>"></script>
</body>
</html>