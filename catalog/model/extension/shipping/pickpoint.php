<?php 
class ModelExtensionShippingPickpoint extends Model {    

	protected function get_curl_post($url, $data) {

		$timeout = 10;
		$ch = curl_init($url);
		if(strtolower((substr($url,0,5))=='https')) { // если соединяемся с https
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		}

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            'Content-Type: application/json',
                                            'Connection: Keep-Alive'
                                            ));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $data ));
	
	
		$output = curl_exec($ch);

		curl_close($ch);

		return $output;
	}

	protected function get_curl_get($url) {
	
		$timeout = 10;
		$ch = curl_init($url);
		if(strtolower((substr($url,0,5))=='https')) { // если соединяемся с https
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		}

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            'Content-Type: application/json',
                                            'Connection: Keep-Alive'
                                            ));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, 0);
			
	
		$output = curl_exec($ch);

		curl_close($ch);

		return $output;
	}

 	public function login($pickpoint_url, $login, $pwd) {
		$url=$pickpoint_url . '/login';
		$data = array( "Login" => $login, "Password" =>  $pwd);
		$output = $this->get_curl_post($url, $data);

		if ($this->config->get('pickpoint_mode')=='pickpoint_mode_debug')
		{
			$this->log->write('pickpoint login ' . print_r($data, 1));
			$this->log->write('pickpoint login $output ' . print_r($output, 1));
		}
		$data = json_decode($output, true);
		return $data; 
	}

 	public function logout($pickpoint_url, $session_id) {
		$url=$pickpoint_url . '/logout';
		$data = array( "SessionId" => $session_id );

		$output = $this->get_curl_post($url, $data);
		$data = json_decode($output, true);
		return $data;
	}

 	public function getzone($pickpoint_url, $session_id, $city) {

		$output = $this->cache->get('pickpoint_getzone');
		if (!$output)
		{
			$url=$pickpoint_url . '/getzone';
			$data = array( "SessionId" => $session_id, "FromCity" => $city );

			$output = $this->get_curl_post($url,$data);
			$this->cache->set('pickpoint_getzone', $output);
		}

		$data = json_decode($output, true);
		return $data;
	}

 	public function postamatlist($pickpoint_url) {

		$output = $this->cache->get('pickpoint_postamatlist');
		if (!$output)
		{
			$url=$pickpoint_url . '/postamatlist';
			$output = $this->get_curl_get($url);
			$this->cache->set('pickpoint_postamatlist', $output);
		}

		$data = json_decode($output, true);
		return $data;
	}

 	public function createsending($pickpoint_url, $data) {

		if ($this->config->get('pickpoint_mode')=='pickpoint_mode_debug')
		{
			$this->log->write('pickpoint createsending ' . $pickpoint_url . ' ' . print_r($data, 1));
		}

		$url=$pickpoint_url . '/createsending';
		$output = $this->get_curl_post($url, $data);
		$data = json_decode($output, true);

		if ($this->config->get('pickpoint_mode')=='pickpoint_mode_debug')
		{
			$this->log->write('pickpoint createsending output ' . $pickpoint_url . ' ' . print_r($output, 1));
		}


		return $data;
	}

 	public function createshipment($pickpoint_url, $data) {

		if ($this->config->get('pickpoint_mode')=='pickpoint_mode_debug')
		{
			$this->log->write('pickpoint createshipment ' . $pickpoint_url . ' ' . print_r($data, 1));
		}

		$url=$pickpoint_url . '/CreateShipment';
		$output = $this->get_curl_post($url, $data);
		$data = json_decode($output, true);

		if ($this->config->get('pickpoint_mode')=='pickpoint_mode_debug')
		{
			$this->log->write('pickpoint createshipment output ' . $pickpoint_url . ' ' . print_r($output, 1));
		}


		return $data;
	}


 	public function calctariff($pickpoint_url, $session_id, $region, $ikn, $from_city, $from_region, $ptn_number, $length, $depth, $width, $weight) {

		$md5 = md5($region . $length . $depth . $width . $weight);

		if ($weight==0) $weight = 1;
		$output = $this->cache->get('pickpoint_calctariff'.$md5);
		if (!$output)
		{
			$url=$pickpoint_url . '/calctariff';
	
			$data = array( "SessionId" => $session_id, "IKN" => $ikn, "FromCity" => $from_city, "FromRegion" => $from_region, "PTNumber" => $ptn_number, "Length" => $length, "Depth" => $depth, "Width" => $width, "Weight" => $weight );
			$output = $this->get_curl_post($url, $data);
			$this->cache->set('pickpoint_calctariff'.$md5, $output);

			if ($this->config->get('pickpoint_mode')=='pickpoint_mode_debug')
			{
				$this->log->write('pickpoint calctariff ' . $md5 . ' - ' . print_r($data, 1));
				$this->log->write('pickpoint calctariff $output ' . print_r($output, 1));

			}

		}
		$data = json_decode($output, true);
		return $data;
	}


	private function TrimName($name) {
		$name = mb_strtolower($name,'utf8');

		$name = trim(str_replace("республика","",$name));
		$name = trim(str_replace("область","",$name));
		$name = trim(str_replace("обл.","",$name));
		$name = trim(str_replace("край","",$name));
		$name = trim(str_replace("респ.","",$name));
		$name = trim(str_replace("авт. округ","",$name));
		$name = trim(str_replace("-югра","",$name));
		$name = trim(str_replace("ао","",$name));
		if ($name=="чувашская") $name = "чувашия";

		return $name;
	}

  	public function getQuoteList($address) {

		$pickpoint_login = $this->config->get('pickpoint_login');
		$pickpoint_pwd = $this->config->get('pickpoint_pwd');
		$pickpoint_ikn = $this->config->get('pickpoint_ikn');

		$pickpoint_from_city = $this->config->get('pickpoint_from_city');
		$pickpoint_from_region = $this->config->get('pickpoint_from_region');


		$pickpoint_rub_select = $this->config->get('pickpoint_rub_select');
		$pickpoint_kg_select = $this->config->get('pickpoint_kg_select');

		$cart_total = $this->currency->convert($this->cart->getTotal(), $this->config->get('config_currency'), $this->config->get('pickpoint_rub_select') );

		$cart_weight = 0;
		foreach ($this->cart->getProducts() as $item) {
			$cart_weight = $cart_weight + $this->weight->convert($item['weight'], $item['weight_class_id'], $this->config->get('pickpoint_kg_select') );
		}

		$length = 10;
		$depth = 10;
		$width = 10;

		if (($pickpoint_login == 'apitest') && ($pickpoint_pwd == 'apitest') && ($pickpoint_ikn == '9990003041'))
			$pickpoint_url = "http://e-solution.pickpoint.ru/apitest/";
		else
			$pickpoint_url = "http://e-solution.pickpoint.ru/api/";

		$output = $this->login($pickpoint_url, $pickpoint_login, $this->config->get('pickpoint_pwd'));
		$session_id = $output['SessionId'];

		
		$this->load->language('extension/shipping/pickpoint');
		
		$quote_data = array();
		$method_data = array();



		$city = mb_strtolower($address['city'],'utf8');
		$zone = mb_strtolower($address['zone'],'utf8');

		$zone = $this->TrimName($zone);

		if ($zone=="москва") 
		{
			$zone = "московская";
			$city = "москва";
		}

		if ($zone=="санкт-петербург") 
		{
			$zone = "ленинградская";
			$city = "санкт-петербург";
		}

		if (true) {
			$quote_data = array();
			
			$i=0;

			$points_array = array();

				// получим список постаматов
				$data = $this->postamatlist($pickpoint_url);

				$in_region_and_city = false;

				// посмотрим, есть ли постаматы в нашем регионе и нашем городе
				foreach($data as $item)
				{
					
					$Area = mb_strtolower($item['Region'],'utf8');
					$Area = $this->TrimName($Area);

					if (($Area == $zone) && ( mb_strtolower($item['CitiName'],'utf8') == $city))
					{
						$in_region_and_city = true;
						break;	
					}
				}
	
				// если не нашелся ни один постамат в городе, покажем по региону
				foreach($data as $item)
				{
					$Area = mb_strtolower($item['Region'],'utf8');
					$Area = $this->TrimName($Area);

					$add_point = false;
					if ($in_region_and_city == true)
						$add_point = (($Area == $zone) && ( mb_strtolower($item['CitiName'],'utf8') == $city));
					else
						$add_point = ($Area == $zone);

					if ($add_point)
					{
		
						$ptn_number = $item['Number'];
						$city_id = $item['CitiId'];

						// Если регион Москва или Московская область, то $city_id = Москва
						// if ($zone == "московская обл.") $city_id = 992;

						// Если значения для региона не проставлены, то считаем по api			

						$min_pickpoint_price = $this->config->get('pickpoint_min_shipping_sum');

						$pickpoint_custom_region_price = $this->config->get('pickpoint_custom_region_price');
						$pickpoint_custom_region_prices = explode("\n", $pickpoint_custom_region_price);
						foreach ($pickpoint_custom_region_prices as $custom_region_price)
						{
							$price_items = explode(":", $custom_region_price);
							
							if ((count($price_items)==2) && (trim($price_items[0]) == '*')) 
							{
								$custom_price = $price_items[1];
								break;
							}
					
							if ((count($price_items)==2) && (trim($price_items[1])!='') && ($this->TrimName(mb_strtolower($price_items[0],'utf8')) == $Area)) 
								$custom_price = $price_items[1];
				
						}



						if (!isset($custom_price))
						{
							$data = $this->calctariff($pickpoint_url, $session_id, $Area, $pickpoint_ikn, $pickpoint_from_city, $pickpoint_from_region, $ptn_number, $length, $depth, $width, $cart_weight); 
							if ($data['ErrorCode']==-1)
							{	
								$this->log->write(print_r($data,1));
								$price = $min_pickpoint_price;
							}
							else
							{
								
								$price = 0;
								foreach($data['Services'] as $Service)
								{
									$price = $price + $Service['NDS'] + $Service['Tariff'];
								}
								
							}
							$price = $price + $this->config->get('pickpoint_custom_add_sum');

						}
						else
							$price = $custom_price;

						if ($this->config->get('pickpoint_cost_round')) $price = ceil($price/100) * 100;


						$pickpoint_zero_from = $this->config->get('pickpoint_zero_from');
						if (($pickpoint_zero_from!='')&&($cart_total > $pickpoint_zero_from)) $price = 0;

					      $quote_data['pickpoint' . $i] = array(
				        		'code'         => 'pickpoint.pickpoint' . $i,
				        		'title'        => $this->language->get('text_pickpoint_title'). ' - ' .$item['Name'] . ' [' . $item['Number'] . '] ' . $item['Region'] .', '. $item['CitiName'] . ', ' . $item['Address'],
				        		'cost'         => $price,
				        		'tax_class_id' => $this->config->get('pickpoint_tax_class_id'),
							'text'         => $this->currency->format($this->tax->calculate($price, $this->config->get('pickpoint_tax_class_id'), $this->config->get('config_tax')), $this->session->data['currency']) 
				      	);
						$i++;

					}
				}
	
			


			if (count($quote_data)>0)
      		$method_data = array(
	        		'code'       => 'pickpoint',
	        		'title'      => $this->language->get('text_pickpoint_title'),
	        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('pickpoint_sort_order'),
        			'error'      => false
      		);
		}

		$output = $this->logout($pickpoint_url, $session_id);
	
		return $method_data;
  	}

  	public function getQuote($address) {

		if (isset($this->session->data['api_id']))
		{
			 return $this->getQuoteList($address);
		}



		$this->load->language('extension/shipping/pickpoint');

		if ($this->config->get('pickpoint_status') == 1) {
			$status = true;
		} else {
			$status = false;
		}

		$cart_weight = $this->weight->convert($this->cart->getWeight(), $this->config->get('config_weight_class_id'), $this->config->get('pickpoint_kg_select') );
		$cart_total = $this->currency->convert($this->cart->getTotal(), $this->config->get('config_currency'), $this->config->get('pickpoint_rub_select') );

		$pickpoint_min_sum = $this->config->get('pickpoint_min_sum');
		if (($pickpoint_min_sum!='') && ($cart_total<$pickpoint_min_sum)) $status = false;
		

		$zone = mb_strtolower($address['zone'],'utf8');
		$zone = $this->TrimName($zone);

		$pickpoint_custom_region_price = $this->config->get('pickpoint_custom_region_price');
		$pickpoint_custom_region_prices = explode("\n", $pickpoint_custom_region_price);
		foreach ($pickpoint_custom_region_prices as $custom_region_price)
		{
			$price_items = explode(":", $custom_region_price);
			
			if ((count($price_items)==2) && (trim($price_items[0]) == '*')) 
			{
				$custom_price = trim($price_items[1]);
				break;
			}
	
			if ((count($price_items)==2) && (trim($price_items[1])!='') && ($this->TrimName($price_items[0]) == $zone)) 
				$custom_price = trim($price_items[1]);

		}


		if (isset($custom_price) && $custom_price == '-') $status = false;

		$method_data = array();

		if ($status) {

			$quote_data = array();

			if (!isset($this->session->data['pickpoint_price']))
			{
				$title_text = $this->language->get('text_pickpoint_title') . ' <span name="pickpoint_shipping_div"></span>'. $this->language->get('text_pickpoint_price_from');
			}
			else
			{
				$title_text = $this->language->get('text_pickpoint_title') .' <span name="pickpoint_shipping_div">'.$this->session->data['pickpoint_title'].'</span>';
			}


			$min_pickpoint_price = $this->config->get('pickpoint_min_shipping_sum');

      		$price = (isset($this->session->data['pickpoint_price']) && $this->session->data['pickpoint_price'] > 0) ? $this->session->data['pickpoint_price'] : $min_pickpoint_price;

			$pickpoint_zero_from = $this->config->get('pickpoint_zero_from');
			if (($pickpoint_zero_from!='')&&($cart_total > $pickpoint_zero_from)) $price = 0;

			$quote_data['pickpoint'] = array(
			   		'code'         => 'pickpoint.pickpoint',
			    		'title'        => $title_text,
			     		'cost'         => $price,
			     		'tax_class_id' => $this->config->get('pickpoint_tax_class_id'),
					'text'         => $this->currency->format($this->tax->calculate($price, $this->config->get('pickpoint_tax_class_id'), $this->config->get('config_tax')), $this->session->data['currency'])

			);


			if (count($quote_data)>0)
      		$method_data = array(
	        		'code'       => 'pickpoint',
	        		'title'      => $this->language->get('text_pickpoint_title'),
	        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('pickpoint_sort_order'),
        			'error'      => false
      		);
		}
		
		return $method_data;

  	}

	private function getPickpointOrders() {
		$query = $this->db->query("SELECT o.*,  o.order_id, o.firstname, o.lastname, os.name as status, o.date_added, o.total, o.currency_code, o.currency_value FROM `" . DB_PREFIX . "order` o LEFT JOIN " . DB_PREFIX . "order_status os ON (o.order_status_id = os.order_status_id) WHERE o.shipping_code like '%pickpoint%' AND o.order_status_id > '0' AND o.store_id = '" . (int)$this->config->get('config_store_id') . "' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.order_id DESC");

		return $query->rows; 
	}


	public function export() {

		$pickpoint_login = $this->config->get('pickpoint_login');
		$pickpoint_pwd = $this->config->get('pickpoint_pwd');
		$pickpoint_ikn = $this->config->get('pickpoint_ikn');

		$pickpoint_from_city = $this->config->get('pickpoint_from_city');
		$pickpoint_from_region = $this->config->get('pickpoint_from_region');

		$length = 10;
		$depth = 10;
		$width = 10;

		$this->load->language('extension/shipping/pickpoint');

		if (($pickpoint_login == 'apitest') && ($pickpoint_pwd == 'apitest') && ($pickpoint_ikn == '9990003041'))
			$pickpoint_url = "http://e-solution.pickpoint.ru/apitest/";
		else
			$pickpoint_url = "http://e-solution.pickpoint.ru/api/";

		$output = $this->login($pickpoint_url, $pickpoint_login, $this->config->get('pickpoint_pwd'));
		$session_id = $output['SessionId'];

		$text = '';


		$pickpoint_statuses = $this->config->get('pickpoint_statuses');
		$pickpoint_dont_export_statuses = $this->config->get('pickpoint_dont_export_statuses');

		if (!isset($pickpoint_statuses)) $pickpoint_statuses = array();
		if (!isset($pickpoint_dont_export_statuses)) $pickpoint_dont_export_statuses = array();
	
		$postamat_number = "";
		$pickpoint_orders = $this->getPickpointOrders();
		foreach($pickpoint_orders as $order)
		{
			if (in_array($order['order_status_id'], $pickpoint_dont_export_statuses)) continue;

			if (in_array($order['order_status_id'], $pickpoint_statuses))
			{
				$sum = 0;
				$postage_type = '10001';
			}
			else	
			{
				$sum = $order['total'];
				$postage_type = '10003';
			}


			$shipping_method = $order['shipping_method'];
			preg_match("/\[(.*?)\]/", $shipping_method, $matches);
			if (isset($matches[1])) $postamat_number = $matches[1];
		

	    		$data = array(
				"SessionId" => $session_id,
		            "Sendings"=>array(array(
			            "EDTN" => $order['order_id'],
			            "IKN"=> $pickpoint_ikn,
			            "Invoice"=>array(
			                "SenderCode"=> $order['order_id'],
			                "BarCode" => "",
			                "GCBarCode"  => "",
			                "Description" => $this->language->get('text_pickpoint_number') . $order['order_id'],
			                "RecipientName" => $order['firstname'] . ' ' . $order['lastname'],
			                "PostamatNumber" => $postamat_number,
			                "MobilePhone" => $order['telephone'],
			                "Email"  => $order['email'],
			                "PostageType" => $postage_type, // 10001-Стандарт,10002-Приоритет,10003-Стандарт НП,10004-Приоритет НП
			                "GettingType" => $this->config->get('pickpoint_getting_type'), //101-вызов курьера,102-в окне приема СЦ
			                "PayType" => 1,
			                "Sum" => $sum,
			                "InsuareValue" => $sum,	// страховка
			                "Width" => $width,
			                "Height" => $length,
			                "Depth"=> $depth,
			                "UnclaimedReturnAddress" => array(
			                    "CityName" => $this->config->get('pickpoint_return_address_city_name'),
			                    "RegionName" => $this->config->get('pickpoint_return_address_region_name'),
			                    "Address" => $this->config->get('pickpoint_return_address_address') ,
			                    "FIO"  => $this->config->get('pickpoint_return_address_fio'),
			                    "PostCode"  => $this->config->get('pickpoint_return_address_post_code'),
			                    "Organisation" => $this->config->get('pickpoint_return_address_organisation'),
			                    "PhoneNumber" => $this->config->get('pickpoint_return_address_phone_number'),
			                    "Comment" => ''),
						)
				))
			);

			$output = $this->createsending($pickpoint_url, $data);

			$CreatedSendings = array_filter($output['CreatedSendings']);
			if (!empty($CreatedSendings)) {
				// удачно - меняем статус
				
				$this->load->model('checkout/order');
				$this->model_checkout_order->addOrderHistory($order['order_id'], $this->config->get('pickpoint_export_status'),'pickpoint_export',TRUE);

				foreach($CreatedSendings as $o)
				{
					$text = $text . $this->language->get('text_pickpoint_number'). $o['EDTN'] . $this->language->get('text_pickpoint_invoice') . $o['InvoiceNumber'] . PHP_EOL;
				}

			}
			else
			{

				$RejectedSendings = array_filter($output['RejectedSendings']);
				foreach($RejectedSendings as $o)
				{
					$text = $text . $this->language->get('text_pickpoint_error'). $o['EDTN'] . ': ' . $o['ErrorMessage'] ;

					$this->load->model('checkout/order');
					if ($o['ErrorMessage']=='Отправление с указанным номером присвойки уже существует.') 
					{
						$this->model_checkout_order->addOrderHistory($order['order_id'], $this->config->get('pickpoint_export_status'),'pickpoint_export',TRUE);
						$text = $text . '[статус изменен на успешный при экпорте]';
					}

					$text = $text . PHP_EOL;
					
				}
			}


		}


		$text = $text . 'Экспорт закончен' . PHP_EOL;

		$output = $this->logout($pickpoint_url, $session_id);
		
		$this->response->addHeader('Content-Type: application/json');
		
		$this->response->setOutput(json_encode(array('text'=>$text))); 

		//return json_encode(array('1'=>'2'));
	}

	public function setprice() {
	      $this->language->load('extension/shipping/pickpoint');
	
		$pickpoint_login = $this->config->get('pickpoint_login');
		$pickpoint_pwd = $this->config->get('pickpoint_pwd');
		$pickpoint_ikn = $this->config->get('pickpoint_ikn');

		$pickpoint_from_city = $this->config->get('pickpoint_from_city');
		$pickpoint_from_region = $this->config->get('pickpoint_from_region');


		$length = 10;
		$depth = 10;
		$width = 10;

		
		if (($pickpoint_login == 'apitest') && ($pickpoint_pwd == 'apitest') && ($pickpoint_ikn == '9990003041'))
			$pickpoint_url = "http://e-solution.pickpoint.ru/apitest/";
		else
			$pickpoint_url = "http://e-solution.pickpoint.ru/api/";


		$cart_total = $this->currency->convert($this->cart->getTotal(), $this->config->get('config_currency'), $this->config->get('pickpoint_rub_select') );

		$cart_weight = 0;
		foreach ($this->cart->getProducts() as $item) {
			$cart_weight = $cart_weight + $this->weight->convert($item['weight'], $item['weight_class_id'], $this->config->get('pickpoint_kg_select') );
		}


		$this->load->model('extension/shipping/pickpoint');

		$output = $this->model_extension_shipping_pickpoint->login($pickpoint_url, $pickpoint_login, $this->config->get('pickpoint_pwd'));
		$session_id = $output['SessionId'];

		if (!isset($this->request->post['pickpoint_terminal_id'])) return "";
		else
			$pickpoint_terminal_id = $this->request->post['pickpoint_terminal_id'];

		
		// получим список постаматов
		$data = $this->model_extension_shipping_pickpoint->postamatlist($pickpoint_url);
		foreach($data as $item)
		{
			if ($item['Number'] == $pickpoint_terminal_id)
			{
				$pickpoint_terminal_cityid = $item['CitiId'];
				$pickpoint_terminal_region = $item['Region'];
				$pickpoint_terminal_cityname = $item['CitiName'];
				$pickpoint_terminal_name = $item['Name'];
				$pickpoint_terminal_address = $item['Region'] . ', ' .$item['CitiName'] .', ' .$item['Address'];

				$Area = mb_strtolower($item['Region'],'utf8');
				$Area = $this->TrimName($Area);
			}
		}

		if (!isset($pickpoint_terminal_name))
		{
			$mes = "Не найден постамат " . $pickpoint_terminal_id;
			$this->log->write($mes);
			$json['error'] = $mes;
			echo json_encode($json);
		
	      	exit;
		}


		$min_pickpoint_price = $this->config->get('pickpoint_min_shipping_sum');

		$pickpoint_custom_region_price = $this->config->get('pickpoint_custom_region_price');
		$pickpoint_custom_region_prices = explode("\n", $pickpoint_custom_region_price);
		foreach ($pickpoint_custom_region_prices as $custom_region_price)
		{
			$price_items = explode(":", $custom_region_price);
			
			if ((count($price_items)==2) && (trim($price_items[0]) == '*')) 
			{
				$custom_price = trim($price_items[1]);
				break;
			}
	
			if ((count($price_items)==2) && (trim($price_items[1])!='') && (trim($price_items[0]) == $pickpoint_terminal_region)) 
				$custom_price = trim($price_items[1]);

		}
	
		$pickpoint_zero_from = $this->config->get('pickpoint_zero_from');
		if (($pickpoint_zero_from!='')&&($cart_total > $pickpoint_zero_from)) $custom_price = 0;
			
		$DPMax = -1;
		$DPMin = -1;

		$data = $this->model_extension_shipping_pickpoint->calctariff($pickpoint_url, $session_id, $Area, $pickpoint_ikn, $pickpoint_from_city, $pickpoint_from_region, $pickpoint_terminal_id, $length, $depth, $width, $cart_weight); 

		if ($data['ErrorCode']!=0)
		{
			$json['error'] = print_r($data,1);
			$this->log->write(print_r($data,1));
			$price = $min_pickpoint_price;
		}
		else
		{
			if ($this->config->get('pickpoint_mode')=='pickpoint_mode_debug')
			{
				$this->log->write(print_r($data,1));
			}
			$price = 0;
			foreach($data['Services'] as $Service)
			{
				$price = $price + $Service['NDS'] + $Service['Tariff'];
			}
			$DPMax = $data['DPMax'];
			$DPMin = $data['DPMin'];

		}
		$price = $price + $this->config->get('pickpoint_custom_add_sum');

		if (isset($custom_price))
		{
			if (strpos($custom_price,'-')!==false)
			{
				$json['error'] = $this->language->get('text_no_shipping');
				echo json_encode($json);
				exit;
			}
			else
				$price = $custom_price;
		}
		if ($this->config->get('pickpoint_cost_round')) $price = ceil($price/100) * 100;

		$Delivery = $this->language->get('text_pickpoint_min') . $DPMin . $this->language->get('text_pickpoint_max') . $DPMax. $this->language->get('text_pickpoint_day');

		$output = $this->model_extension_shipping_pickpoint->logout($pickpoint_url, $session_id);

	      $this->session->data['shipping_methods']['pickpoint']['quote']['pickpoint']['title'] = $this->language->get('text_pickpoint_title') . ' - ' . $pickpoint_terminal_name . ' [' . $pickpoint_terminal_id . '] ' . $pickpoint_terminal_address . $Delivery;
	      $this->session->data['shipping_methods']['pickpoint']['quote']['pickpoint']['cost'] = $price;
	      $this->session->data['shipping_methods']['pickpoint']['quote']['pickpoint']['text'] = $price;
	
	      $this->session->data['pickpoint_price'] = $price;
	      $this->session->data['pickpoint_title'] = ' - ' . $pickpoint_terminal_name . ' [' . $pickpoint_terminal_id . '] ' . $pickpoint_terminal_address . $Delivery;
	      $this->session->data['pickpoint_city'] = $pickpoint_terminal_cityname;

		$json['pre_mes'] = $this->language->get('text_pickpoint_title');
		$json['mes'] = ' - ' . $pickpoint_terminal_name . ' [' . $pickpoint_terminal_id . '] ' . $pickpoint_terminal_address . $Delivery;
		$json['post_mes'] = ' - ' . $this->currency->format($this->tax->calculate($price, $this->config->get('pickpoint_tax_class_id'), $this->config->get('config_tax')), $this->session->data['currency']);


		if (!isset($json['price'])) $json['price'] = $price;
		$json['error'] = 'no_error';

		//$this->response->addHeader('Content-Type: application/json');
		//$this->response->setOutput(json_encode($json));
		echo json_encode($json);
		
	      exit;
	}

}
