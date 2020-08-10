<div class="header">
		<div class="logo-header" onclick="window.location.replace('//360suites.com.br')"></div>
		<div class="header-sistema">
			<ul>
			<li onclick="window.location.replace('<?=$base;?>/')"><i class="fas fa-home"></i> Inicial</li>
			<li onclick="window.location.replace('//360suites.com.br')"><i class="fas fa-chevron-left"></i> 360Suites</li>
			<li class="idioma"><div class="BrasilLinguagem" onclick="trocarIdioma('pt')"></div><div class="EnglishLinguagem" onclick="trocarIdioma('en')"></div></li>
			</ul>
		</div>
</div>
<?php
$infor_autocomplete = new Classe\Api\Beds24\Information;
	$autoCompleteInput = $infor_autocomplete->nomes_dos_hotel('array_javascript'); 
?>
<div class="contentHeader">
	<div class="center">
		<div class="sboxDatesAndLocalization">
			<div class="rowDatesAndLocalization">
				<div class="RowHeader">
					<div class="RowHeaderTitle">
						<div class="RowHeaderTitleText">
							<h1 class="RowHeaderTitleH1">Mais que <strong>hospedagem</strong>,</h1>
							<span class="RowHeaderTitleSpan"> uma <strong>experiência.</strong></span>
						</div>
						<div class="RowHeaderSubTitle">
							<span>Conforto, segurança e praticidade pelos preços mais acessíveis do mercado.</span>
						</div>
					</div>


					<div class="RowConteudo">
						<!--Destino-->
						<div class="RowConteudoBox">
							<div class="RowConteudoBoxV">
								<div class="RowConteudoBoxVV">
									<label class="RowConteudoBoxVV-label">Escolha um edifício</label>
									<div class="RowConteudoBoxVV-input">
										<div class="RowConteudoBoxVV-input-relative">
											<div class="input-container">
												<select name="autocomplete" id="autocomplete" class="destino_info input-containerInput">
													<option class="autocompleteselect" value="360 Luz">360 Luz</option>
													<option class="autocompleteselect" value="360 Sé">360 Sé</option>
													<option class="autocompleteselect" value="360 Consolação">360 Consolação</option>
													<option class="autocompleteselect" value="360 Republica">360 Republica</option>
													<option class="autocompleteselect" value="360 Higienopolis">360 Higienopolis</option>
												</select>
												<span class="input-gradient"></span>
												<i class="inputIBox fas fa-map-marker-alt"></i>
												<span class="validation-msg --destino_info">Digite um edifício.</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--Data-->
						<div class="RowConteudoBox">
							<div class="RowConteudoBoxLabelDate">
								<label class="sbox-dates-label">Datas</label>
								<label class="sbox-dates-label"></label>
							</div>
							<div class="RowContentBoxInputDate">
								<div class="RowContentBoxInputDate-input">
									<div class="input-container">
										<input type="text" placeholder="Entrada" id="entrada" class="entrada_info input-tag-sbox-checkin-date">
										<i class="inputIBox far fa-calendar-alt"></i>
										<span class="validation-msg --entrada_info">Insira uma data de entrada.</span>
									</div>
								</div>
								<div class="RowContentBoxInputDate-input2">
									<div class="input-container">
										<input type="text" placeholder="Saída" id="saida"  class="saida_info input-tag-sbox-checkin-date">
										<i class="inputIBox far fa-calendar-alt"></i>
										<span class="validation-msg --saida_info">Insira uma data de Saída.</span>
									</div>
								</div>
							</div>
						</div>


						<!--Quantidade de Pessoas-->
						<div class="RowConteudoBox2">
							<div class="RowConteudoBoxV">
								<div class="RowConteudoBoxVV">
									<label class="RowConteudoBoxVV-label">Quantos Quartos?</label>
									<div class="RowConteudoBoxVV-input">
										<div class="RowConteudoBoxVV-input-relative">
											<div class="input-container">
												<input type="number" autocomplete="disabled" id="quartos_info" placeholder="Quantos Quartos?" class="quartos_info input-containerInput">
												<span class="input-gradient"></span>
												<i class="inputIBox fas fa-bed"></i>
												<span class="validation-msg --quartos_info">Coloque a quantidade de quartos.</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--Search Procurarar-->
						<div class="RowButton">
							<div class="RowButtonConteiner">
								<a href="javascript:search();">
									<i class="iconButton fas fa-search"></i>
									<em class="btn-text">Procurar</em>
								</a>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>
