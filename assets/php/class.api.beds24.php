<?php
//Gabriel CMR - Desenvolvimentos
//Sistema de API Beds24


namespace Classe\Api\Beds24;

	class  Room{
		public function room_id(){
			global $keys;
			global $db;
			
			$return = array();
			$infoDB = $db->rows('SELECT * FROM 360suites_roomids');
			if($infoDB){
					foreach($infoDB as $info){
							$return[] = $info->roomId;
					}
			}else{

			$info_hotelPropKey = $db->rows('SELECT * FROM 360suites_informacoeshotel');
			foreach($info_hotelPropKey as $hotelPropKey){
				$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$hotelPropKey->prokey.'" }, "roomIds": true}';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getPropertyContent');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
				                                                            
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				if($data2->getPropertyContent){
				$room = $data2->getPropertyContent;
				if($room['0']){
				$fg1 = $room['0'];
				foreach($fg1 as $info){
					if($info){
					foreach ($info as $tst)	{
						if($tst->roomId){
								$data = [
								    'id' => NULL,
								    'roomId' => $tst->roomId,
								    'id_hotel' => $hotelPropKey->id
								];
								$db->insert('360suites_roomids', $data);
							$return[]  = $tst->roomId;
									}
								}
							}
						}
					}
				}
			}
		}
				return $return;
			}
		public function nome_room($roomId){
			global $keys;
			global $db;
			
			
				$infoDB = $db->row('SELECT * FROM 360suites_roomnames WHERE roomId="'.$roomId.'"');
				if($infoDB){
					$return = $infoDB->name;
				}else{
				$info_hotelPropKey = $db->rows('SELECT * FROM 360suites_informacoeshotel');
				foreach($info_hotelPropKey as $hotelPropKey){
				$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$hotelPropKey->prokey.'" }, "roomIds": true}';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getPropertyContent');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
				                                                            
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				if(is_string($data2->error)){
					$return = '';
				}else{
				if($data2->getPropertyContent){
				$room = $data2->getPropertyContent;
				if($room['0']){
				$fg1 = $room['0'];
				if($fg1){
				foreach($fg1 as $info){
					foreach ($info as $tst)	{
						if($tst->roomId == $roomId){
								$data = [
								    'id' => NULL,
								    'roomId' => $roomId,
								    'name' => $tst->name,
								    'id_hotel' => $hotelPropKey->id
								];
								$db->insert('360suites_roomnames', $data);
							$return  = $tst->name;
						}
					}
				}
			}

}

}

}

			}
		}
				return $return;
		}

		public function room_imagens($roomId){
			global $keys;
			global $db;
			
				$return = array();
				$infoDB = $db->rows('SELECT * FROM 360suites_roomimagens WHERE roomId="'.$roomId.'"');
				if($infoDB){
					foreach($infoDB as $info){
							$return[] = $info->img;
					}
				}else{
					$verifi_responsability = $db->row('SELECT * FROM 360suites_roomids WHERE roomId="'.$roomId.'"');
					if($verifi_responsability){
						$hotelPropKey = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE id="'.$verifi_responsability->id_hotel.'"');
						$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$hotelPropKey->prokey.'" }, "bookingData": true, "images": true, "roomIds": true, "texts": true }';
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getPropertyContent');
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						
						$data = curl_exec($ch);
						curl_close($ch);
						$data2 = json_decode($data);

						$room = $data2->getPropertyContent;
						$fg1 = $room['0'];
						$fg2 = $fg1->images;
						$finality = $fg2->hosted;
						foreach($finality as $info){
							$f3 = $info->map;
							foreach($f3 as $f4){
								if($f4->roomId == $roomId){
									$data = [
									    'id' => NULL,
									    'roomId' => $roomId,
									    'img' => $info->url,
									    'id_hotel' => $hotelPropKey->id
									];
									$db->insert('360suites_roomimagens', $data);
									$return[] = $info->url;
								}
							}
						}

					}else{
						$info_hotelPropKey = $db->rows('SELECT * FROM 360suites_informacoeshotel');
						foreach($info_hotelPropKey as $hotelPropKey){
						$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$hotelPropKey->prokey.'" }, "bookingData": true, "images": true, "roomIds": true, "texts": true }';
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getPropertyContent');
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
						                                                             
						$data = curl_exec($ch);
						curl_close($ch);
						$data2 = json_decode($data);
						$room = $data2->getPropertyContent;
						$fg1 = $room['0'];
						$fg2 = $fg1->images;
						$finality = $fg2->hosted;
						foreach($finality as $info){
								$f3 = $info->map;
								foreach($f3 as $f4){
									if($f4->roomId == $roomId){
										$data = [
										    'id' => NULL,
										    'roomId' => $roomId,
										    'img' => $info->url,
										    'id_hotel' => $hotelPropKey->id
										];
										$db->insert('360suites_roomimagens', $data);
									$return[] = $info->url;
									}
								}
							}
						}

					}

				}
				return $return;

			}

		public function room_texto($roomId){
			global $keys;
			global $db;
			
				$infoDB = $db->row('SELECT * FROM 360suites_roomtexto WHERE roomId="'.$roomId.'"');
				if($infoDB){
					$return = $infoDB->texto;
				}else{
				$verifi_responsability = $db->row('SELECT * FROM 360suites_roomids WHERE roomId="'.$roomId.'"');
				if($verifi_responsability){
					$hotelPropKey = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE id="'.$verifi_responsability->id_hotel.'"');
				$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$hotelPropKey->prokey.'" },  "roomIds": true, "texts": true }';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getPropertyContent');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
				                                                                    
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				if(is_string($data2->error)){
					$return = '';
				}else{
				if($data2->getPropertyContent){
				$room = $data2->getPropertyContent;
				if($room['0']){
				$fg1 = $room['0'];
				if($fg1->roomIds){
				$fg2 = $fg1->roomIds;
				foreach($fg2 as $roomText){
					if($roomText->roomId == $roomId){
					$textIdimo = $roomText->texts;
					$roomDescription1 = $textIdimo->roomDescription1;
								$data = [
								    'id' => NULL,
								    'roomId' => $roomId,
								    'texto' => $roomDescription1->PT,
								    'id_hotel' => $hotelPropKey->id
								];
								$db->insert('360suites_roomtexto', $data);
					$return = $roomDescription1->PT;
				}
			}

		}}} }
				
				}else{
					$info_hotelPropKey = $db->rows('SELECT * FROM 360suites_informacoeshotel');
					foreach($info_hotelPropKey as $hotelPropKey){
				$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$hotelPropKey->prokey.'" },  "roomIds": true, "texts": true }';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getPropertyContent');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
				                                                                        
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				if(is_string($data2->error)){

				}else{
				if($data2->getPropertyContent){
				$room = $data2->getPropertyContent;
				if($room['0']){
				$fg1 = $room['0'];
				if($fg1->roomIds){
				$fg2 = $fg1->roomIds;
				foreach($fg2 as $roomText){
					if($roomText->roomId == $roomId){
					$textIdimo = $roomText->texts;
					$roomDescription1 = $textIdimo->roomDescription1;
								$data = [
								    'id' => NULL,
								    'roomId' => $roomId,
								    'texto' => $roomDescription1->PT,
								    'id_hotel' => $hotelPropKey->id
								];
								$db->insert('360suites_roomtexto', $data);
					$return = $roomDescription1->PT;
				}
			}

		}}} }
				}
				}
				
			}
				return $return;
		}


		public function valor_room($roomId, $dia){
			global $keys;
			global $db;
			
			$infoDB = $db->row('SELECT * FROM 360suites_roomvalor WHERE roomId="'.$roomId.'" AND dia="'.$dia.'"');
				if($infoDB){
				$formatado = str_replace('.', ',', $infoDB->valor);
				}else{
				$verifi_responsability = $db->row('SELECT * FROM 360suites_roomids WHERE roomId="'.$roomId.'"');
				if($verifi_responsability){
					$hotelPropKey = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE id="'.$verifi_responsability->id_hotel.'"');
    			$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$hotelPropKey->prokey.'" }, "roomId": '.$roomId.'}';
    			$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getRoomDates');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);       
				                                                           
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				if(is_string($data2->error)){
						$formatado = '';
				}else{
				if($data2->$dia){
				$valor = $data2->$dia;
				$formatado = str_replace('.', ',', $valor->p1);
				if($valor && $formatado){
								$data = [
								    'id' => NULL,
								    'roomId' => $roomId,
								    'dia' => $dia,
								    'valor' => $valor->p1,
								    'id_hotel' => $hotelPropKey->id
								];
								$db->insert('360suites_roomvalor', $data);
				}
			}
		}
				}else{
					$info_hotelPropKey = $db->rows('SELECT * FROM 360suites_informacoeshotel');
							foreach($info_hotelPropKey as $hotelPropKey){
    			$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$hotelPropKey->prokey.'" }, "roomId": '.$roomId.'}';
    			$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getRoomDates');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
				                                                              
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				if(is_string($data2->error)){

				}else{
				if($data2->$dia){
				$valor = $data2->$dia;
				$formatado = str_replace('.', ',', $valor->p1);
				if($valor && $formatado){
								$data = [
								    'id' => NULL,
								    'roomId' => $roomId,
								    'dia' => $dia,
								    'valor' => $valor->p1,
								    'id_hotel' => $hotelPropKey->id
								];
								$db->insert('360suites_roomvalor', $data);
				}
			} }
			}

				}
				
		}
			return $formatado; 
		}


		public function valores_rooms($roomId){
			global $keys;
			global $db;
			
				$verifi_responsability = $db->row('SELECT * FROM 360suites_roomids WHERE roomId="'.$roomId.'"');
				if($verifi_responsability){
					$hotelPropKey = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE id="'.$verifi_responsability->id_hotel.'"');
    			$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$hotelPropKey->prokey.'" }, "roomId": '.$roomId.'}';
    			$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getRoomDates');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        
				                                                            
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
			}
			
			return $data2; 
		}

		public function valores_room_unit($roomId, $entrada, $saida, $propKey){
				global $keys;
				global $db;

				$entrada_format = str_replace('/', '-', $entrada);
				$saida_format = str_replace('/', '-', $saida);
				$from = date('Ymd', strtotime($entrada_format));
				$to = date('Ymd', strtotime("-1 day", strtotime($saida_format)));
				$find = $db->rows('SELECT * FROM 360suites_valoresroomunit WHERE propKey="'.$propKey.'" AND from2="'.$from.'" AND to2="'.$to.'" AND roomId="'.$roomId.'"');
					$return = [];
				if($find){
						foreach ($find as $value) {
							$return[] = array(
								'i' => $value->i,
								'p1' => $value->p1
							);
						}
				}else{
    			$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$propKey.'" }, "roomId": '.$roomId.', "from": "'.$from.'", "to": "'.$to.'" }';
    			$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getRoomDates');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
				                                                             
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				if(is_string($data2->error)){
					$return = false;
				}else{
					$return = [];
					foreach ($data2 as $value) {
							$data = [
								'id' => NULL,
								'propKey' => $propKey,
								'i' => $value->i,
								'p1' => $value->p1,
								'from2' => $from,
								'to2' => $to,
								'roomId' => $roomId
							];
							$db->insert('360suites_valoresroomunit', $data);
							$return[] = array(
								'i' => $value->i,
								'p1' => $value->p1
							);
						}
				}
			}
				return $return; 

		}


		/*public function items_adicionais($roomId){
			global $keys;
			global $db;
			
			$verifi_responsability = $db->row('SELECT * FROM 360suites_roomids WHERE roomId="'.$roomId.'"');
				if($verifi_responsability){
					$hotelPropKey = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE id="'.$verifi_responsability->id_hotel.'"');
			$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$hotelPropKey->prokey.'" }, "roomIds": [ '.$roomId.' ], "bookingData": true, "images": true, "texts": true }';
			$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getPropertyContent');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
				                                                                        
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				$ff = $data2->getPropertyContent;
				$ff = $ff[0];
				$ff = $ff->bookingData;
				$ff = $ff->upsell;
				$ff3 = $ff->upsell;
				$return = [];
				foreach($ff as $adicionar){
					$id = $adicionar->description;
					$en = $id->EN;
					$pt = $id->PT;
					if($pt){
						$return[] = array(
							'preco' => $adicionar->price,
							'text' => $pt
							);
					}elseif($en){
						$return[] = array(
							'preco' => $adicionar->price,
							'text' => $en
							);
					}
				}
			}else{
				$info_hotelPropKey = $db->rows('SELECT * FROM 360suites_informacoeshotel');
						foreach($info_hotelPropKey as $hotelPropKey){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getPropertyContent');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
				                                                                         
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				$ff = $data2->getPropertyContent;
				$ff = $ff[0];
				$ff = $ff->bookingData;
				$ff = $ff->upsell;
				$ff3 = $ff->upsell;
				$return = [];
				foreach($ff as $adicionar){
					$id = $adicionar->description;
					$en = $id->EN;
					$pt = $id->PT;
					if($pt){
						$return[] = array(
							'preco' => $adicionar->price,
							'text' => $pt
							);
					}elseif($en){
						$return[] = array(
							'preco' => $adicionar->price,
							'text' => $en
							);
					}
				}
			}
			}
			return	$return;
		}*/


		/*Search*/

		public function room_id_search($propKey, $check_in, $check_out){
			global $keys;
			global $db;
			
				$return = array();
				$db_hotel = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE prokey="'.$propKey.'"');
				$info_checkin = $db->rows('SELECT * FROM 320suites_search WHERE id_hotel="'.$db_hotel->id.'" AND check_in="'.$check_in.'" AND check_out="'.$check_out.'"');
				if($info_checkin){
					foreach($info_checkin as $info){
						$return[] = $info->roomId;
					}
				}else{
				$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$propKey.'" }, "roomIds": true}';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getPropertyContent');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
					                                                                            
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				$room = $data2->getPropertyContent;
				$fg1 = $room['0'];
				$i = 0;
				foreach($fg1 as $info){
					if($i > 9){
						break;
						}
					foreach ($info as $tst){
							$i++;
							if($i <= 9){
							$data_search = [
								'id' => NULL,
								'id_hotel' => $db_hotel->id,
								'check_in' => $check_in,
								'check_out' => $check_out,
								'roomId' => $tst->roomId
							];
							$db->insert('320suites_search', $data_search);
							$return[] = $tst->roomId;
							}else{
								break;
							}
						}
				}
			}

			return $return;

		}

		public function room_id_search_2($propKey){
			global $keys;
			global $db;
			
				$return = array();
				$verifi = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE prokey="'.$propKey.'"');
				$all = $db->rows('SELECT * FROM 360suites_roomids WHERE id_hotel="'.$verifi->id.'"');
				if($all){
					foreach($all as $r){
							$return[] = $r->roomId;
					}
				}else{
				$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$propKey.'" }, "roomIds": true}';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getPropertyContent');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
				                                                                  
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				$room = $data2->getPropertyContent;
				$fg1 = $room['0'];
				$i = 0;
				foreach($fg1 as $info){
					foreach ($info as $tst){
						if(is_string($tst->roomId)){
							$return[] = $tst->roomId;
						}
					}

				}
			}

			return $return;

		}

		/*
		public function room_quantidade_quartos($roomId){
			global $db;
			global $keys;
			$info_room = $db->row('SELECT * FROM 360suites_roomids WHERE roomId="'.$roomId.'"');
			$info_hotel = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE id="'.$info_room->id_hotel.'"');
			if($info_hotel && $info_room){

				$data_string = '{"authentication": { "apiKey": "'.$keys['apiKey'].'", "propKey": "'.$info_hotel->prokey.'" },"roomId": '.$roomId.', "from": "20200808", "to": "20200809", "incMaxStay": 0, "incMultiplier": 0, "incOverride": 0, "allowInventoryNegative": 0, "incChannelBookingLimit": 0 }';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getRoomDates');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				if(is_string($data2->error)){
					$return = "0 quartos disponíveis";
				}else{
					$return = $data2->$roomId->i." quarto(s) disponíveis";
				}
			}else{

				$return = "0 quartos disponíveis";

			}

			return $return;

		}*/
	}

	class Information{
		public function nomes_dos_hotel($retorn){
			global $keys;
			global $db;
			
				$infoDB = $db->rows('SELECT * FROM 360suites_informacoeshotel ORDER by id DESC');
			if($infoDB){
				$name = [];
				$city = [];
				foreach($infoDB as $info){
					if($info->name && $info->city){
						$name[] = $info->name;
						$city[] = $info->city;
					}
				}
				$countName = count($name);
				$countCity = count($city);
			}else{
			$data_string = '{ "authentication": { "apiKey": "'.$keys['apiKey'].'" } }';
			$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/getProperties');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
				                                                                                             
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				$f1 = $data2->getProperties;
				$name = [];
				$city = [];
				foreach($f1 as $info){
					if($info->name && $info->city){
						$name[] = $info->name;
						if(in_array($info->city, $city)){}else{$city[] = $info->city;}
								$data = [
								    'id' => NULL,
								    'name' => $info->name,
								    'city' => $info->city,
								    'prokey' => $info->propId
								];
								$db->insert('360suites_informacoeshotel', $data);
					}
				}
			}
				$countName = count($name);
				$countCity = count($city);
				$i = 0;
				$html = '';
				for($i = 0; $i < $countName;$i++){
					$fs = $countName - 1;
					if($i == $fs){
					$html .= '"'.$name[$i].'", "'.$city[$i].'"'; 
					}else{
					$html .= '"'.$name[$i].'", "'.$city[$i].'",'; 
					}
				}
				return $html;
		}

	}


	class Checkout{
		public function insert($id){
			global $keys;
			global $db;
			
			$info_insert = $db->row('SELECT  * FROM 360suites_ordens WHERE id="'.$id.'"');
			$rows = $db->row('SELECT * FROM 360suites_roomids WHERE roomId="'.$info_insert->roomId.'"');
			$info_db = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE id="'.$rows->id_hotel.'"');
			$date = \Classe\Api\Beds24\Room::valores_room_unit($info_insert->roomId, $info_insert->data_entrada, $info_insert->data_saida, $info_db->prokey);
				$soma = 0;
				foreach ($date as $value) {
						$soma += $value['p1'];
				}
			$data_entrada = str_replace('/', '-', $info_insert->data_entrada);
			$saida_format = str_replace('/', '-', $info_insert->data_saida);
			$data_entrada2 = date('Y-m-d', strtotime($data_entrada));
			$saida_format2 = date('Y-m-d', strtotime($saida_format));
			$soma_itens = 0;
			$infoOO = json_decode($info_insert->value_adicional);

			$soma2 = $soma * $info_insert->quartos;
			$all_valor = $soma2 + 75;
			$data_json = '{
    "authentication": {
        "apiKey": "'.$keys['apiKey'].'",
        "propKey": "'.$info_db->prokey.'"
    },
    "roomId": "'.$info_insert->roomId.'",
    "roomQty": "'.$info_insert->quartos.'",
    "status": "3",
    "firstNight": "'.$data_entrada2.'",
    "lastNight": "'.$saida_format2.'",
    "numAdult": "2",
    "numChild": "0",
    "guestFirstName": "'.$info_insert->primeiroNome.'",
    "guestName": "'.$info_insert->sobrenome.'",
    "guestEmail": "'.$info_insert->email.'",
    "guestPhone": "'.$info_insert->telefone.'",
    "guestAddress": "'.$info_insert->endereco.'",
    "guestCity": "'.$info_insert->cidade.'",
    "guestState": "'.$info_insert->estado.'",
    "guestCountry": "'.$info_insert->paises.'",
    "custom3": "'.$info_insert->rghospede.'",
    "custom4": "'.$info_insert->nomeacompanhante.'",
    "custom5": "'.$info_insert->rgacompanhante.'",
    "custom6": "'.$info_insert->anotacoes.'",
    "custom8": "'.$info_insert->datenascimento.'",
    "price": "'.$soma2.'",
    "refererEditable": "online",
    "notifyUrl": "true",
    "notifyGuest": false,
    "notifyHost": false,
    "assignBooking": false,
    "checkAvailability": false,
    "deleteInvoice": false,
    "invoice": [
        {
            "description": "PagSeguro",
            "status": "Pendente",
            "qty": "1",
            "price": "'.$all_valor.'",
            "vatRate": "0",
            "type": "0",
            "invoiceeId": ""
        }
    ],
    "infoItems": [
        {
            "code": "PAGAMENTO",
            "text": "PAGAMENTO PENDENTE PAGSEGURO - RESERVA 360 SUITES"
        } ] }';


				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/setBooking');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				                                                                
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				if(is_string($data2->error) == false){
				$return = [];
				$return['id_systema'] = $data2->bookId;
				$return['valor'] = $all_valor;
				}else{
					$return = false;
				}
				return $return;

		}

		public function atualizar_fatura_pag($id){
			global $keys;
			global $db;
			
			$info_insert = $db->row('SELECT * FROM 360suites_ordens WHERE id_systema="'.$id.'"');
			$rows = $db->row('SELECT * FROM 360suites_roomids WHERE roomId="'.$info_insert->roomId.'"');
			$info_db = $db->row('SELECT * FROM 360suites_informacoeshotel WHERE id="'.$rows->id_hotel.'"');
			$all_valor = $info_insert->valor;
			$data_json = '{
			    "authentication": {
			        "apiKey": "'.$keys['apiKey'].'",
			        "propKey": "'.$info_db->prokey.'"
			    },
			    "bookId": "'.$info_insert->id_systema.'",
                "status": "1",
			    "invoice": [
			        {
			            "description": "PagSeguro",
			            "status": "Pago",
			            "qty": "-1",
			            "price": "'.$all_valor.'",
                        "vatRate": "0",
                        "type": "0",
                        "invoiceeId": ""
			        }
			    ],
			    "infoItems": [
			        {
			            "code": "PAGAMENTO FEITO - PAGSEGURO",
			            "text": "Pago '.$all_valor.'"
			        }
			    ]
			}';


				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.beds24.com/json/setBooking');
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      
				                                                            
				$data = curl_exec($ch);
				curl_close($ch);
				$data2 = json_decode($data);
				return $data2;
		}
	}