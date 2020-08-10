### Sistema de 360 Suites

(Atenção) não nós responsabilizamos pelo mau uso do programador que ira editar ou fazer futuras alterações no sistema.

Informamos que a única garantia ou correção será feita através do Salvianos Soluções IT.

Após a finalização da garantia de correção da Salvianos Soluções nós não iremos editar ou até mesmo dar suporte nestes arquivos.


### Configuração do Sistema

Abra /assets/php/config.php - Edite seguintes itens

```sh
<?php
//Gabriel CMR - Desenvolvimentos  
//Configurações do Sistema 

	error_reporting(0); //Não listar erros  

	session_start();
 
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese'); 

	date_default_timezone_set('America/Sao_Paulo'); 

	$base = ""; //Local que está o sistema

	$servidor_db = ""; //Servidor do banco de dados

	$usuario_db = ""; //Usuário do banco de dados

	$senha_db = ""; //Senha do banco de dados

	$nome_db = ""; //Nome do banco de dados

	$keys['apiKey'] = ""; //Apikey do Beds24

	$PagSeguro_email = "";

	$PagSeguro_token = "";

	$PagSeguro_NomeUsuario = "";

	$PagSeguro_SenhaUsuario = "";

	$PagSeguro_Parametro = ""; 
```

Ao fazer as alterações destes arquivos o sistema ira funcionar normalmente.

### Informações do Hotel

Adicionar informações dos Hotel no banco de dados em [360suites_informacoeshotel]

* Nome
* Cidade
* ProKey

### Configuração do CRON

```sh
0	0	*	*	*	/usr/local/bin/ea-php70 /home4/exoticwe/public_html/360suitescom/reservas/assets/cron/beds24.api.reload.php
*/15	*	*	*	*	/usr/local/bin/ea-php70 /home4/exoticwe/public_html/360suitescom/reservas/assets/cron/beds24.api.refresh30seg.php
0	0,12	*	*	*	/usr/local/bin/ea-php70 /home4/exoticwe/public_html/360suitescom/reservas/assets/cron/beds24.api.search.php
```

Fim da configuração agora e só usar :)
