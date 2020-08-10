<?php
//Gabriel CMR - Desenvolvimentos
//Pagina inicial

	include __DIR__.'/pg.menu.php';

	$token = base64_decode($_GET['pga']);
	$exp = explode('-&&-', $token);
	$roomId = $exp[0];
	$data_entrada = $exp[1];
	$data_saida = $exp[2];
	$quartos = $exp[3];

?>
<form action="javascript:void(0);" method="POST">
<input type="hidden" name="roomId" value="<?=$roomId;?>">
<input type="hidden" name="data_entrada" value="<?=$data_entrada;?>">
<input type="hidden" name="data_saida" value="<?=$data_saida;?>">
<input type="hidden" name="quartos" value="<?=$quartos;?>">
<script>$('.contentHeader').attr('style', 'display:none');</script>
<div id="container">
<div class="center">
	<?php
		$soma = 0;
		$info_room = $db->row('SELECT * FROM 360suites_roomids WHERE roomId="'.$roomId.'"');
		$info_hotel = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE id="'.$info_room->id_hotel.'"');
		$class = new Classe\Api\Beds24\Room;
		$error_dates = [];
		$date = $class->valores_room_unit($roomId, $data_entrada, $data_saida, $info_hotel->prokey);
		foreach ($date as  $value) {
			if($value['i'] >= $quartos){
				if($value['p1']){
					$soma += $value['p1'];
					$success = 'p1-disponivel';
				}else{
					$error_dates[] = 'error';
				}
			}else{
				$error_dates[] = 'error';
			}
		}

		if(in_array('error', $error_dates)){
			 echo "<script>window.location.replace('".$base."/Finalization/NaoDisponivel')</script>";
		}
		
		$info_img = $class->room_imagens($roomId);
		$nome_room = $class->nome_room($roomId);
		$imagem_room = $info_img[0];
		$soma = $soma * $quartos;
		$soma = $soma + 75;
		$soma2 = $soma - 75;
		$soma3 = 75;
		?>
		<div class="CheckoutResume">
			<div class="CheckoutResumeCart">
				<div class="CheckoutResumeCartImg"><img src="<?=$imagem_room;?>"></div>
			</div>
			<div class="row">
				<div class="col-sm CheckoutResumeCartTitle"><?=$nome_room;?></div>
			</div>

			<div class="row">
				<div class="col-sm"><strong>Data de Entrada</strong> (Check-in após 3PM)</div>
				<div class="col-sm"><?=$data_entrada;?></div>
			</div>

			<div class="row">
				<div class="col-sm"><strong>Data de Saida</strong> (Check-out até 12PM)</div>
				<div class="col-sm"><?=$data_saida;?></div>
			</div>


			<div class="row">
				<div class="col-sm">Quantidade de Quartos</div>
				<div class="col-sm"><?=$quartos;?></div>
			</div>

			<div id="addAdicionais">
				<div class="row">
					<div class="col-sm">Quarto</div>
					<div class="col-sm"> R$<?=number_format($soma2,2,",",".");?> </div>
				</div>

				<div class="row">
					<div class="col-sm">Taxa de Limpeza</div>
					<div class="col-sm"> R$<?=number_format($soma3,2,",",".");?>  (A limpeza refere-se ao serviço realizado ao final da sua estadia. Para arrumação durante o período da hospedagem, favor consultar valores com o nosso time.)</div>
				</div>
			</div>

			<div class="CheckoutTotalResume">
				<div class="row">
					<div class="col-sm">Total</div>
					<div class="col-sm">R$ <total><?=number_format($soma,2,",",".");?></total></div>
				</div>
			</div>

		</div>
		<?php
		//Configurações do usuário
	?>


	<div class="CheckoutInformationClient">
		<div class="row">
			<div class="col-sm CheckoutAdicionalTitle">Meus Dados</div>
		</div>

		<div class="row">

			<div class="col-sm"> 

			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">Primeiro Nome *</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="Primeiro Nome" id="primeiroNome" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox fas fa-user"></i>
							<span class="validation-msg --primeiroNome">Digite o seu primeiro nome.</span>
						</div>
					</div>
				</div>
			</div>

			</div>

			<div class="col-sm">

			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">Sobrenome *</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="Sobrenome" id="sobrenome" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox fas fa-user"></i>
							<span class="validation-msg --sobrenome">Digite o seu Sobrenome.</span>
						</div>
					</div>
				</div>
			</div>

			</div>

			<div class="col-sm">
				
			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">E-mail *</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="E-mail" id="email" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox fas fa-envelope"></i>
							<span class="validation-msg --email">Digite o seu E-mail.</span>
						</div>
					</div>
				</div>
			</div>

			</div>

		</div>





	<div class="row" style="margin-top: 10px;">

		
		<div class="col-sm">

			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">Celular *</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="Celular" id="telefone" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox fas fa-phone-alt"></i>
							<span class="validation-msg --telefone">Digite o seu Celular.</span>
							<script>$(document).ready(function(){ $('#telefone').mask('(00) 00000-0000'); })</script>
						</div>
					</div>
				</div>
			</div>

			</div>


		<div class="col-sm"> 

			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">RG Hóspede *</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="RG Hóspede" id="rghospede" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox far fa-id-card"></i>
							<span class="validation-msg --rghospede">Digite o seu RG.</span>
						</div>
					</div>
				</div>
			</div>

			</div>

		<div class="col-sm">

			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">Data de Nascimento *</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="Data de Nascimento" id="datenascimento" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox far fa-calendar-alt"></i>
							<span class="validation-msg --datenascimento">Digite a data do seu nascimento.</span>
							<script>$(document).ready(function(){ $('#datenascimento').mask('00/00/0000'); })</script>
						</div>
					</div>
				</div>
			</div>


			</div>

		





	</div>








	<div class="row" style="margin-top: 10px;">

			<div class="col-sm">

			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">Nome Acompanhante</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="Nome Acompanhante" id="nomeacompanhante" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox fas fa-user-plus"></i>
							<span class="validation-msg --nomeacompanhante">Digite o nome do seu Acompanhante.</span>
						</div>
					</div>
				</div>
			</div>

			</div>

			<div class="col-sm">

			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">RG Acompanhante</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="RG Acompanhante" id="rgacompanhante" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox far fa-id-card"></i>
							<span class="validation-msg --rgacompanhante">Digite o RG do seu Acompanhante.</span>
						</div>
					</div>
				</div>
			</div>

			</div>


			<div class="col-sm">
				
			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">Anotações Adicionais</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="Anotações Adicionais" id="anotacoes" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox fas fa-asterisk"></i>
							<span class="validation-msg --anotacoes">Digite o as anotações.</span>
						</div>
					</div>
				</div>
			</div>

			</div>

		</div>



	<div class="row" style="margin-top: 10px;">

			<div class="col-sm"> 

			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">País de Residência: *</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<select name="paises" id="paises" class="input-containerInput">
	<option value="Brasil" selected="selected">Brasil</option>
	<option value="Afeganistão">Afeganistão</option>
	<option value="África do Sul">África do Sul</option>
	<option value="Albânia">Albânia</option>
	<option value="Alemanha">Alemanha</option>
	<option value="Andorra">Andorra</option>
	<option value="Angola">Angola</option>
	<option value="Anguilla">Anguilla</option>
	<option value="Antilhas Holandesas">Antilhas Holandesas</option>
	<option value="Antárctida">Antárctida</option>
	<option value="Antígua e Barbuda">Antígua e Barbuda</option>
	<option value="Argentina">Argentina</option>
	<option value="Argélia">Argélia</option>
	<option value="Armênia">Armênia</option>
	<option value="Aruba">Aruba</option>
	<option value="Arábia Saudita">Arábia Saudita</option>
	<option value="Austrália">Austrália</option>
	<option value="Áustria">Áustria</option>
	<option value="Azerbaijão">Azerbaijão</option>
	<option value="Bahamas">Bahamas</option>
	<option value="Bahrein">Bahrein</option>
	<option value="Bangladesh">Bangladesh</option>
	<option value="Barbados">Barbados</option>
	<option value="Belize">Belize</option>
	<option value="Benim">Benim</option>
	<option value="Bermudas">Bermudas</option>
	<option value="Bielorrússia">Bielorrússia</option>
	<option value="Bolívia">Bolívia</option>
	<option value="Botswana">Botswana</option>
	<option value="Brunei">Brunei</option>
	<option value="Bulgária">Bulgária</option>
	<option value="Burkina Faso">Burkina Faso</option>
	<option value="Burundi">Burundi</option>
	<option value="Butão">Butão</option>
	<option value="Bélgica">Bélgica</option>
	<option value="Bósnia e Herzegovina">Bósnia e Herzegovina</option>
	<option value="Cabo Verde">Cabo Verde</option>
	<option value="Camarões">Camarões</option>
	<option value="Camboja">Camboja</option>
	<option value="Canadá">Canadá</option>
	<option value="Catar">Catar</option>
	<option value="Cazaquistão">Cazaquistão</option>
	<option value="Chade">Chade</option>
	<option value="Chile">Chile</option>
	<option value="China">China</option>
	<option value="Chipre">Chipre</option>
	<option value="Colômbia">Colômbia</option>
	<option value="Comores">Comores</option>
	<option value="Coreia do Norte">Coreia do Norte</option>
	<option value="Coreia do Sul">Coreia do Sul</option>
	<option value="Costa do Marfim">Costa do Marfim</option>
	<option value="Costa Rica">Costa Rica</option>
	<option value="Croácia">Croácia</option>
	<option value="Cuba">Cuba</option>
	<option value="Dinamarca">Dinamarca</option>
	<option value="Djibouti">Djibouti</option>
	<option value="Dominica">Dominica</option>
	<option value="Egito">Egito</option>
	<option value="El Salvador">El Salvador</option>
	<option value="Emirados Árabes Unidos">Emirados Árabes Unidos</option>
	<option value="Equador">Equador</option>
	<option value="Eritreia">Eritreia</option>
	<option value="Escócia">Escócia</option>
	<option value="Eslováquia">Eslováquia</option>
	<option value="Eslovênia">Eslovênia</option>
	<option value="Espanha">Espanha</option>
	<option value="Estados Federados da Micronésia">Estados Federados da Micronésia</option>
	<option value="Estados Unidos">Estados Unidos</option>
	<option value="Estônia">Estônia</option>
	<option value="Etiópia">Etiópia</option>
	<option value="Fiji">Fiji</option>
	<option value="Filipinas">Filipinas</option>
	<option value="Finlândia">Finlândia</option>
	<option value="França">França</option>
	<option value="Gabão">Gabão</option>
	<option value="Gana">Gana</option>
	<option value="Geórgia">Geórgia</option>
	<option value="Gibraltar">Gibraltar</option>
	<option value="Granada">Granada</option>
	<option value="Gronelândia">Gronelândia</option>
	<option value="Grécia">Grécia</option>
	<option value="Guadalupe">Guadalupe</option>
	<option value="Guam">Guam</option>
	<option value="Guatemala">Guatemala</option>
	<option value="Guernesei">Guernesei</option>
	<option value="Guiana">Guiana</option>
	<option value="Guiana Francesa">Guiana Francesa</option>
	<option value="Guiné">Guiné</option>
	<option value="Guiné Equatorial">Guiné Equatorial</option>
	<option value="Guiné-Bissau">Guiné-Bissau</option>
	<option value="Gâmbia">Gâmbia</option>
	<option value="Haiti">Haiti</option>
	<option value="Honduras">Honduras</option>
	<option value="Hong Kong">Hong Kong</option>
	<option value="Hungria">Hungria</option>
	<option value="Ilha Bouvet">Ilha Bouvet</option>
	<option value="Ilha de Man">Ilha de Man</option>
	<option value="Ilha do Natal">Ilha do Natal</option>
	<option value="Ilha Heard e Ilhas McDonald">Ilha Heard e Ilhas McDonald</option>
	<option value="Ilha Norfolk">Ilha Norfolk</option>
	<option value="Ilhas Cayman">Ilhas Cayman</option>
	<option value="Ilhas Cocos (Keeling)">Ilhas Cocos (Keeling)</option>
	<option value="Ilhas Cook">Ilhas Cook</option>
	<option value="Ilhas Feroé">Ilhas Feroé</option>
	<option value="Ilhas Geórgia do Sul e Sandwich do Sul">Ilhas Geórgia do Sul e Sandwich do Sul</option>
	<option value="Ilhas Malvinas">Ilhas Malvinas</option>
	<option value="Ilhas Marshall">Ilhas Marshall</option>
	<option value="Ilhas Menores Distantes dos Estados Unidos">Ilhas Menores Distantes dos Estados Unidos</option>
	<option value="Ilhas Salomão">Ilhas Salomão</option>
	<option value="Ilhas Virgens Americanas">Ilhas Virgens Americanas</option>
	<option value="Ilhas Virgens Britânicas">Ilhas Virgens Britânicas</option>
	<option value="Ilhas Åland">Ilhas Åland</option>
	<option value="Indonésia">Indonésia</option>
	<option value="Inglaterra">Inglaterra</option>
	<option value="Índia">Índia</option>
	<option value="Iraque">Iraque</option>
	<option value="Irlanda do Norte">Irlanda do Norte</option>
	<option value="Irlanda">Irlanda</option>
	<option value="Irã">Irã</option>
	<option value="Islândia">Islândia</option>
	<option value="Israel">Israel</option>
	<option value="Itália">Itália</option>
	<option value="Iêmen">Iêmen</option>
	<option value="Jamaica">Jamaica</option>
	<option value="Japão">Japão</option>
	<option value="Jersey">Jersey</option>
	<option value="Jordânia">Jordânia</option>
	<option value="Kiribati">Kiribati</option>
	<option value="Kuwait">Kuwait</option>
	<option value="Laos">Laos</option>
	<option value="Lesoto">Lesoto</option>
	<option value="Letônia">Letônia</option>
	<option value="Libéria">Libéria</option>
	<option value="Liechtenstein">Liechtenstein</option>
	<option value="Lituânia">Lituânia</option>
	<option value="Luxemburgo">Luxemburgo</option>
	<option value="Líbano">Líbano</option>
	<option value="Líbia">Líbia</option>
	<option value="Macau">Macau</option>
	<option value="Macedônia">Macedônia</option>
	<option value="Madagáscar">Madagáscar</option>
	<option value="Malawi">Malawi</option>
	<option value="Maldivas">Maldivas</option>
	<option value="Mali">Mali</option>
	<option value="Malta">Malta</option>
	<option value="Malásia">Malásia</option>
	<option value="Marianas Setentrionais">Marianas Setentrionais</option>
	<option value="Marrocos">Marrocos</option>
	<option value="Martinica">Martinica</option>
	<option value="Mauritânia">Mauritânia</option>
	<option value="Maurícia">Maurícia</option>
	<option value="Mayotte">Mayotte</option>
	<option value="Moldávia">Moldávia</option>
	<option value="Mongólia">Mongólia</option>
	<option value="Montenegro">Montenegro</option>
	<option value="Montserrat">Montserrat</option>
	<option value="Moçambique">Moçambique</option>
	<option value="Myanmar">Myanmar</option>
	<option value="México">México</option>
	<option value="Mônaco">Mônaco</option>
	<option value="Namíbia">Namíbia</option>
	<option value="Nauru">Nauru</option>
	<option value="Nepal">Nepal</option>
	<option value="Nicarágua">Nicarágua</option>
	<option value="Nigéria">Nigéria</option>
	<option value="Niue">Niue</option>
	<option value="Noruega">Noruega</option>
	<option value="Nova Caledônia">Nova Caledônia</option>
	<option value="Nova Zelândia">Nova Zelândia</option>
	<option value="Níger">Níger</option>
	<option value="Omã">Omã</option>
	<option value="Palau">Palau</option>
	<option value="Palestina">Palestina</option>
	<option value="Panamá">Panamá</option>
	<option value="Papua-Nova Guiné">Papua-Nova Guiné</option>
	<option value="Paquistão">Paquistão</option>
	<option value="Paraguai">Paraguai</option>
	<option value="País de Gales">País de Gales</option>
	<option value="Países Baixos">Países Baixos</option>
	<option value="Peru">Peru</option>
	<option value="Pitcairn">Pitcairn</option>
	<option value="Polinésia Francesa">Polinésia Francesa</option>
	<option value="Polônia">Polônia</option>
	<option value="Porto Rico">Porto Rico</option>
	<option value="Portugal">Portugal</option>
	<option value="Quirguistão">Quirguistão</option>
	<option value="Quênia">Quênia</option>
	<option value="Reino Unido">Reino Unido</option>
	<option value="República Centro-Africana">República Centro-Africana</option>
	<option value="República Checa">República Checa</option>
	<option value="República Democrática do Congo">República Democrática do Congo</option>
	<option value="República do Congo">República do Congo</option>
	<option value="República Dominicana">República Dominicana</option>
	<option value="Reunião">Reunião</option>
	<option value="Romênia">Romênia</option>
	<option value="Ruanda">Ruanda</option>
	<option value="Rússia">Rússia</option>
	<option value="Saara Ocidental">Saara Ocidental</option>
	<option value="Saint Martin">Saint Martin</option>
	<option value="Saint-Barthélemy">Saint-Barthélemy</option>
	<option value="Saint-Pierre e Miquelon">Saint-Pierre e Miquelon</option>
	<option value="Samoa Americana">Samoa Americana</option>
	<option value="Samoa">Samoa</option>
	<option value="Santa Helena, Ascensão e Tristão da Cunha">Santa Helena, Ascensão e Tristão da Cunha</option>
	<option value="Santa Lúcia">Santa Lúcia</option>
	<option value="Senegal">Senegal</option>
	<option value="Serra Leoa">Serra Leoa</option>
	<option value="Seychelles">Seychelles</option>
	<option value="Singapura">Singapura</option>
	<option value="Somália">Somália</option>
	<option value="Sri Lanka">Sri Lanka</option>
	<option value="Suazilândia">Suazilândia</option>
	<option value="Sudão">Sudão</option>
	<option value="Suriname">Suriname</option>
	<option value="Suécia">Suécia</option>
	<option value="Suíça">Suíça</option>
	<option value="Svalbard e Jan Mayen">Svalbard e Jan Mayen</option>
	<option value="São Cristóvão e Nevis">São Cristóvão e Nevis</option>
	<option value="São Marino">São Marino</option>
	<option value="São Tomé e Príncipe">São Tomé e Príncipe</option>
	<option value="São Vicente e Granadinas">São Vicente e Granadinas</option>
	<option value="Sérvia">Sérvia</option>
	<option value="Síria">Síria</option>
	<option value="Tadjiquistão">Tadjiquistão</option>
	<option value="Tailândia">Tailândia</option>
	<option value="Taiwan">Taiwan</option>
	<option value="Tanzânia">Tanzânia</option>
	<option value="Terras Austrais e Antárticas Francesas">Terras Austrais e Antárticas Francesas</option>
	<option value="Território Britânico do Oceano Índico">Território Britânico do Oceano Índico</option>
	<option value="Timor-Leste">Timor-Leste</option>
	<option value="Togo">Togo</option>
	<option value="Tonga">Tonga</option>
	<option value="Toquelau">Toquelau</option>
	<option value="Trinidad e Tobago">Trinidad e Tobago</option>
	<option value="Tunísia">Tunísia</option>
	<option value="Turcas e Caicos">Turcas e Caicos</option>
	<option value="Turquemenistão">Turquemenistão</option>
	<option value="Turquia">Turquia</option>
	<option value="Tuvalu">Tuvalu</option>
	<option value="Ucrânia">Ucrânia</option>
	<option value="Uganda">Uganda</option>
	<option value="Uruguai">Uruguai</option>
	<option value="Uzbequistão">Uzbequistão</option>
	<option value="Vanuatu">Vanuatu</option>
	<option value="Vaticano">Vaticano</option>
	<option value="Venezuela">Venezuela</option>
	<option value="Vietname">Vietname</option>
	<option value="Wallis e Futuna">Wallis e Futuna</option>
	<option value="Zimbabwe">Zimbabwe</option>
	<option value="Zâmbia">Zâmbia</option>
</select>
							<span class="input-gradient"></span>
							<i class="inputIBox fas fa-globe-americas"></i>
							<span class="validation-msg --paises">Selecione o País.</span>
						</div>
					</div>
				</div>
			</div>

			</div>

			<div class="col-sm">

			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">Estado *</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="Estado" id="estado" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox fas fa-map-marker-alt"></i>
							<span class="validation-msg --estado">Digite o seu Estado.</span>
						</div>
					</div>
				</div>
			</div>

			</div>

			<div class="col-sm">
				
			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">Cidade *</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="Cidade" id="cidade" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox fas fa-building"></i>
							<span class="validation-msg --cidade">Digite a sua Cidade.</span>
						</div>
					</div>
				</div>
			</div>

			</div>

		</div>






	<div class="row" style="margin-top: 10px;">

			<div class="col-sm"> 

			<div class="RowConteudoBoxVV">
				<label class="RowConteudoBoxVV-label">Endereço *</label>
				<div class="RowConteudoBoxVV-input">
					<div class="RowConteudoBoxVV-input-relative">
						<div class="input-container">
							<input type="text" placeholder="Endereço" id="endereco" class="input-containerInput">
							<span class="input-gradient"></span>
							<i class="inputIBox fas fa-map-marked-alt"></i>
							<span class="validation-msg --endereco">Digite o seu Endereço.</span>
						</div>
					</div>
				</div>
			</div>

			</div>

		</div>





		<div class="row" style="margin-top: 10px;">
			<div class="col-md-4">
				<div class="g-recaptcha" data-sitekey="6Lcf47kZAAAAALVakkBe4TZsMK9H0g7Dj3KFevom"></div>
			</div>
			<div class="col-sm"></div>
			<div class="col-md-4">
						<div class="RowButton" style="margin: 0 auto;margin-right: 55%;margin-top:1rem;">
			<div class="RowButtonConteiner" id="finazilation">
				<a href="javascript:checkout_finalization();">
					<em class="btn-text">Confirmar Reserva</em>
					<i class="iconButton fas fa-arrow-right"></i>
				</a>
			</div>
		</div>

		<div class="AcceptTermsAndCondition" >
					<input class="form-check-input" type="checkbox" id="gridCheck1"> Eu li e aceito aos <a href="https://360suites.com.br/terms-conditions" target="_blank">Termos & Condições</a>
				</div>
			</div>
		</div>

	
<div id="returnChecked"></div>
	</div>
</div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    validate();
    $('#primeiroNome, #sobrenome, #email, #telefone, #paises, #estado, #cidade, #endereco, #datenascimento, #gridCheck1').change(validate);
});

function validate(){
    if ($('#primeiroNome').val().length > 0 &&
        $('#sobrenome').val().length > 0 &&
    	$('#email').val().length > 0 &&
        $('#telefone').val().length > 0 &&
        $('#paises').val().length > 0 &&
        $('#estado').val().length > 0 &&
    	$('#cidade').val().length > 0 &&
        $('#endereco').val().length > 0 &&
        $('#datenascimento').val().length > 0 && $("#gridCheck1").is(':checked')) {
        $("#finazilation").attr("class", "RowButtonConteiner");
    }
    else {
        $("#finazilation").attr("class", "RowButtonConteiner disabledButton");
    }
}


function checkout_finalization(){
	if($("#gridCheck1").is(':checked')){
	//Não requeridos
	var value_adicional = [];
	var nomeacompanhante = $('#nomeacompanhante').val();
	var rgacompanhante = $('input[id=rgacompanhante]').val();
	var anotacoes = $('input[id=anotacoes]').val();
	 $("input[name=adicional]:checked").each(function(i){
    	var valor = $(this).val();
    	value_adicional.push(valor);
  	});

	 //Requeridos
	 var roomId = $('input[name=roomId]').val();
     var data_entrada = $('input[name=data_entrada]').val();
   	 var data_saida = $('input[name=data_saida]').val();
	 var quartos = $('input[name=quartos]').val();
	 var primeiroNome = $('input[id=primeiroNome]').val();
	 var sobrenome = $('input[id=sobrenome]').val();
	 var email = $('input[id=email]').val();
	 var rghospede = $('input[id=rghospede]').val();
	 var telefone = $('input[id=telefone]').val();
	 var paises = $('select[id=paises]').val();
	 var estado = $('input[id=estado]').val();
	 var cidade = $('input[id=cidade]').val();
	 var endereco = $('input[id=endereco]').val();
	 var captcha = $('.g-recaptcha-response').val();
	 var datenascimento = $('input[id=datenascimento]').val();
	 if(primeiroNome == false){
	 	$('.--primeiroNome').attr('style', 'visibility: visible;opacity: 1;');
	 	setTimeout(function(){
	 		$('.--primeiroNome').removeAttr('style');
	 	}, 10000);
	 }else if(sobrenome == false){
	 	$('.--sobrenome').attr('style', 'visibility:visible;opacity:1;');
	 	setTimeout(function(){
	 		$('.--sobrenome').removeAttr('style');
	 	}, 10000);
	 }else if(email == false){
	 	$('.--email').attr('style', 'visibility:visible;opacity:1;');
	 	setTimeout(function(){
	 		$('.--email').removeAttr('style');
	 	}, 10000);
	 }else if(rghospede == false){
	 	$('.--rghospede').attr('style', 'visibility:visible;opacity:1;');
	 	setTimeout(function(){
	 		$('.--rghospede').removeAttr('style');
	 	}, 10000);
	 }else if(telefone == false){
	 	$('.--telefone').attr('style', 'visibility:visible;opacity:1;');
	 	setTimeout(function(){
	 		$('.--telefone').removeAttr('style');
	 	}, 10000);
	 }else if(paises == false){
	 	$('.--paises').attr('style', 'visibility:visible;opacity:1;');
	 	setTimeout(function(){
	 		$('.--paises').removeAttr('style');
	 	}, 10000);
	 }else if(estado == false){
	 	$('.--estado').attr('style', 'visibility:visible;opacity:1;');
	 	setTimeout(function(){
	 		$('.--estado').removeAttr('style');
	 	}, 10000);
	 }else if(cidade == false){
	 	$('.--cidade').attr('style', 'visibility:visible;opacity:1;');
	 	setTimeout(function(){
	 		$('.--cidade').removeAttr('style');
	 	}, 10000);
	 }else if(endereco == false){
	 	$('.--endereco').attr('style', 'visibility:visible;opacity:1;');
	 	setTimeout(function(){
	 		$('.--endereco').removeAttr('style');
	 	}, 10000);
	 }else if(datenascimento == false){
	 	$('.--datenascimento').attr('style', 'visibility:visible;opacity:1;');
	 	setTimeout(function(){
	 		$('.--datenascimento').removeAttr('style');
	 	}, 10000);
	 }else if(captcha == false){
	 	$('#rc-anchor-container').click();
	 }else{
	$('.FnBlurEmabassar').attr('style', 'transition: all 0.5s;-webkit-filter: blur(3px);');
 	$('.carregamento').attr('style', 'display:block;');
	 	$.ajax({
	    url: base+'/assets/ajax/checkout_finalization.ajax.php',
	    type: 'POST',
	    data: { value_adicional: value_adicional, anotacoes: anotacoes, roomId: roomId, data_entrada: data_entrada, data_saida: data_saida, quartos: quartos, primeiroNome: primeiroNome, sobrenome: sobrenome, email: email, rghospede: rghospede, telefone: telefone, paises: paises, estado: estado, cidade: cidade, endereco: endereco, captcha: captcha, nomeacompanhante: nomeacompanhante, rgacompanhante: rgacompanhante, datenascimento: datenascimento },
	  	}).done(function(data) {
	 		$('#returnChecked').html(data);
	 		$('.FnBlurEmabassar').removeAttr('style');
	 		$('.carregamento').attr('style', 'display:none;');
	  	}).fail(function() {
	  	window.location.reload();
	  });
	 }

}
}
</script>
<?php
//Include Menu
include __DIR__.'/pg.footer.php';