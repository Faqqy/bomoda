<?php
class ControllerExtensionShippingPickpoint extends Controller { 
	private $error = array();
	
	public function index() {  
		$this->load->language('extension/shipping/pickpoint');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
	
		$this->load->model('extension/shipping/pickpoint');

		$pickpoint_login = $this->config->get('pickpoint_login');
		$pickpoint_pwd = $this->config->get('pickpoint_pwd');
		$pickpoint_ikn = $this->config->get('pickpoint_ikn');

		$pickpoint_from_city = $this->config->get('pickpoint_from_city');
		$pickpoint_from_region = $this->config->get('pickpoint_from_region');

		$length = 10;
		$depth = 10;
		$width = 10;

	//	$pickpoint_login = 'apitest';
	//	$pickpoint_pwd = 'apitest';
	//	$pickpoint_ikn = '9990003041';

		if (($pickpoint_login == 'apitest') && ($pickpoint_pwd == 'apitest') && ($pickpoint_ikn == '9990003041'))
			$pickpoint_url = "http://e-solution.pickpoint.ru/apitest/";
		else
			$pickpoint_url = "http://e-solution.pickpoint.ru/api/";

		$output = $this->model_extension_shipping_pickpoint->login($pickpoint_url, $pickpoint_login, $this->config->get('pickpoint_pwd'));
		$session_id = $output['SessionId'];

			 
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pickpoint', $this->request->post);	

			$this->session->data['success'] = $this->language->get('text_success');
									
			//$this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));


		}

		$data['entry_main_settings'] = $this->language->get('entry_main_settings');
		$data['entry_export_settings'] = $this->language->get('entry_export_settings');

		$data['text_edit'] = $this->language->get('text_edit');		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['pickpoint_version'] = '2.3.7.7';

		$data['text_none'] = $this->language->get('text_none');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		
		$data['entry_rate'] = $this->language->get('entry_rate');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['entry_min_sum'] = $this->language->get('entry_min_sum');
		$data['entry_min_shipping_sum'] = $this->language->get('entry_min_shipping_sum');
		$data['entry_zero_from'] = $this->language->get('entry_zero_from');
		$data['entry_zero_sum'] = $this->language->get('entry_zero_sum');
		$data['entry_orders_status'] = $this->language->get('entry_orders_status');
		$data['entry_markup'] = $this->language->get('entry_markup');
		$data['entry_mode'] = $this->language->get('entry_mode');
		$data['button_export'] = $this->language->get('button_export');

		$data['entry_custom_add_sum'] = $this->language->get('entry_custom_add_sum');

		$data['entry_cart_weight'] = $this->language->get('entry_cart_weight');
		$data['help_cart_weight'] = $this->language->get('help_cart_weight');

		$data['entry_cart_cost'] = $this->language->get('entry_cart_cost');
		$data['help_cart_cost'] = $this->language->get('help_cart_cost');

		$data['entry_cost_round'] = $this->language->get('entry_cost_round');
		
		$data['entry_login'] = $this->language->get('entry_login');
		$data['help_login'] = $this->language->get('help_login');

		$data['entry_url'] = $this->language->get('entry_url');
		$data['help_url'] = $this->language->get('help_url');

		$data['entry_pwd'] = $this->language->get('entry_pwd');
		$data['help_pwd'] = $this->language->get('help_pwd');

		$data['entry_ikn'] = $this->language->get('entry_ikn');
		$data['help_ikn'] = $this->language->get('help_ikn');

		$data['entry_from_city'] = $this->language->get('entry_from_city');
		$data['help_from_city'] = $this->language->get('help_from_city');

		$data['entry_from_region'] = $this->language->get('entry_from_region');
		$data['help_from_region'] = $this->language->get('help_from_region');

		$data['entry_export'] = $this->language->get('entry_export');

		$data['entry_custom_price'] = $this->language->get('entry_custom_price');
		$data['entry_custom_region_price'] = $this->language->get('entry_custom_region_price');
		$data['help_custom_region_price'] = $this->language->get('help_custom_region_price');

		$data['entry_custom_city_price'] = $this->language->get('entry_custom_city_price');
		$data['help_custom_city_price'] = $this->language->get('help_custom_city_price');

		$data['entry_deleted_cities'] = $this->language->get('entry_deleted_cities');
		$data['help_deleted_cities'] = $this->language->get('help_deleted_cities');

		$data['entry_point_cost'] = $this->language->get('entry_point_cost');
		$data['help_point_cost'] = $this->language->get('help_point_cost');

		$data['entry_point_days'] = $this->language->get('entry_point_days');
		$data['help_point_days'] = $this->language->get('help_point_days');

		$data['entry_courier_cost'] = $this->language->get('entry_courier_cost');
		$data['help_courier_cost'] = $this->language->get('help_courier_cost');

		$data['entry_courier_days'] = $this->language->get('entry_courier_days');
		$data['help_courier_days'] = $this->language->get('help_courier_days');

		$data['entry_pickpoint_rub_select'] = $this->language->get('entry_pickpoint_rub_select');
		$data['entry_pickpoint_kg_select'] = $this->language->get('entry_pickpoint_kg_select');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');

		$data['pickpoint_modes'][] = array('code'=>'pickpoint_mode_normal', 'code_text'=>$this->language->get('entry_mode_normal'));
		$data['pickpoint_modes'][] = array('code'=>'pickpoint_mode_debug', 'code_text'=>$this->language->get('entry_mode_debug'));

		$this->load->model('localisation/order_status');	
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		$data['entry_postage_type'] = $this->language->get('entry_postage_type');
		$data['pickpoint_postage_types'][] = array('code'=>'10001', 'code_text'=>$this->language->get('entry_postage_type_10001'));
		$data['pickpoint_postage_types'][] = array('code'=>'10002', 'code_text'=>$this->language->get('entry_postage_type_10002'));
		$data['pickpoint_postage_types'][] = array('code'=>'10003', 'code_text'=>$this->language->get('entry_postage_type_10003'));
		$data['pickpoint_postage_types'][] = array('code'=>'10004', 'code_text'=>$this->language->get('entry_postage_type_10004'));

		$data['entry_getting_type'] = $this->language->get('entry_getting_type');
		$data['pickpoint_getting_types'][] = array('code'=>'101', 'code_text'=>$this->language->get('entry_getting_type_101'));
		$data['pickpoint_getting_types'][] = array('code'=>'102', 'code_text'=>$this->language->get('entry_getting_type_102'));
		$data['pickpoint_getting_types'][] = array('code'=>'103', 'code_text'=>$this->language->get('entry_getting_type_103'));
		$data['pickpoint_getting_types'][] = array('code'=>'104', 'code_text'=>$this->language->get('entry_getting_type_104'));


		$data['entry_dont_export_statuses'] = $this->language->get('entry_dont_export_statuses');

		$data['entry_return_address'] = $this->language->get('entry_return_address');

		$data['entry_return_address_city_name'] = $this->language->get('entry_return_address_city_name');
		$data['entry_return_address_region_name'] = $this->language->get('entry_return_address_region_name');
		$data['entry_return_address_address'] = $this->language->get('entry_return_address_address');
		$data['entry_return_address_fio'] = $this->language->get('entry_return_address_fio');
		$data['entry_return_address_post_code'] = $this->language->get('entry_return_address_post_code');
		$data['entry_return_address_organisation'] = $this->language->get('entry_return_address_organisation');
		$data['entry_return_address_phone_number'] = $this->language->get('entry_return_address_phone_number');

		$data['entry_export_status'] = $this->language->get('entry_export_status');

		$data['regions'] = array();

		$this->load->model('localisation/country');	
		foreach ($this->model_localisation_country->getCountries() as $country)
		{
			if ($country['iso_code_3'] == 'RUS')
			{
				$this->load->model('localisation/zone');	
				$data['regions'] = $this->model_localisation_zone->getZonesByCountryId($country['country_id']);
				
			}
		}


 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['pickpoint_login'])) {
			$data['error_pickpoint_login'] = $this->error['pickpoint_login'];
		} else {
			$data['error_pickpoint_login'] = '';
		}

		if (isset($this->error['pickpoint_url'])) {
			$data['error_pickpoint_url'] = $this->error['pickpoint_url'];
		} else {
			$data['error_pickpoint_url'] = '';
		}

		if (isset($this->error['pickpoint_pwd'])) {
			$data['error_pickpoint_pwd'] = $this->error['pickpoint_pwd'];
		} else {
			$data['error_pickpoint_pwd'] = '';
		}

		if (isset($this->error['pickpoint_ikn'])) {
			$data['error_pickpoint_ikn'] = $this->error['pickpoint_ikn'];
		} else {
			$data['error_pickpoint_ikn'] = '';
		}

		if (isset($this->error['pickpoint_from_city'])) {
			$data['error_pickpoint_from_city'] = $this->error['pickpoint_from_city'];
		} else {
			$data['error_pickpoint_from_city'] = '';
		}

		if (isset($this->error['pickpoint_from_region'])) {
			$data['error_pickpoint_from_region'] = $this->error['pickpoint_from_region'];
		} else {
			$data['error_pickpoint_from_region'] = '';
		}


  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_shipping'),
			'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/shipping/pickpoint', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('extension/shipping/pickpoint', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'); 

		$this->load->model('localisation/geo_zone');
		
		$geo_zones = $this->model_localisation_geo_zone->getGeoZones();
		
		foreach ($geo_zones as $geo_zone) {
			if (isset($this->request->post['pickpoint_' . $geo_zone['geo_zone_id'] . '_rate'])) {
				$data['pickpoint_' . $geo_zone['geo_zone_id'] . '_rate'] = $this->request->post['pickpoint_' . $geo_zone['geo_zone_id'] . '_rate'];
			} else {
				$data['pickpoint_' . $geo_zone['geo_zone_id'] . '_rate'] = $this->config->get('pickpoint_' . $geo_zone['geo_zone_id'] . '_rate');
			}		
			
			if (isset($this->request->post['pickpoint_' . $geo_zone['geo_zone_id'] . '_status'])) {
				$data['pickpoint_' . $geo_zone['geo_zone_id'] . '_status'] = $this->request->post['pickpoint_' . $geo_zone['geo_zone_id'] . '_status'];
			} else {
				$data['pickpoint_' . $geo_zone['geo_zone_id'] . '_status'] = $this->config->get('pickpoint_' . $geo_zone['geo_zone_id'] . '_status');
			}		
		}
		
		$data['geo_zones'] = $geo_zones;

		$this->load->model('localisation/currency');
		$data['currencies'] = $this->model_localisation_currency->getCurrencies();

		if (isset($this->request->post['pickpoint_rub_select'])) {
			$data['pickpoint_rub_select'] = $this->request->post['pickpoint_rub_select'];
		} elseif( $this->config->get('pickpoint_rub_select') ) {
			$data['pickpoint_rub_select'] = $this->config->get('pickpoint_rub_select');
		} else {
			$data['pickpoint_rub_select'] = 'RUB';
		}

		$this->load->model('localisation/weight_class');
		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();

		if (isset($this->request->post['pickpoint_gram_select'])) {
			$data['pickpoint_gram_select'] = $this->request->post['pickpoint_gram_select'];
		} elseif( $this->config->get('pickpoint_gram_select') ) {
			$data['pickpoint_gram_select'] = $this->config->get('pickpoint_gram_select');
		} else {
			$data['pickpoint_gram_select'] = 1;
		}


		if (isset($this->request->post['pickpoint_login'])) {
			$data['pickpoint_login'] = $this->request->post['pickpoint_login'];
		} else {
			$data['pickpoint_login'] = $this->config->get('pickpoint_login');
		}

		if (isset($this->request->post['pickpoint_url'])) {
			$data['pickpoint_url'] = $this->request->post['pickpoint_url'];
		} elseif ( $this->config->get('pickpoint_url') ) {
			$data['pickpoint_url'] = $this->config->get('pickpoint_url');
		} else {
			$data['pickpoint_url'] = 'http://pickpoint.ru/select/postamat.js';
		}

	

		if (isset($this->request->post['pickpoint_pwd'])) {
			$data['pickpoint_pwd'] = $this->request->post['pickpoint_pwd'];
		} else {
			$data['pickpoint_pwd'] = $this->config->get('pickpoint_pwd');
		}

		if (isset($this->request->post['pickpoint_ikn'])) {
			$data['pickpoint_ikn'] = $this->request->post['pickpoint_ikn'];
		} else {
			$data['pickpoint_ikn'] = $this->config->get('pickpoint_ikn');
		}

		if (isset($this->request->post['pickpoint_from_city'])) {
			$data['pickpoint_from_city'] = $this->request->post['pickpoint_from_city'];
		} else {
			$data['pickpoint_from_city'] = $this->config->get('pickpoint_from_city');
		}

		if (isset($this->request->post['pickpoint_from_region'])) {
			$data['pickpoint_from_region'] = $this->request->post['pickpoint_from_region'];
		} else {
			$data['pickpoint_from_region'] = $this->config->get('pickpoint_from_region');
		}

		if (isset($this->request->post['pickpoint_deleted_cities'])) {
			$data['pickpoint_deleted_cities'] = $this->request->post['pickpoint_deleted_cities'];
		} else {
			$data['pickpoint_deleted_cities'] = $this->config->get('pickpoint_deleted_cities');
		}


		if (isset($this->request->post['pickpoint_cart_weight'])) {
			$data['pickpoint_cart_weight'] = $this->request->post['pickpoint_cart_weight'];
		} else {
			$data['pickpoint_cart_weight'] = $this->config->get('pickpoint_cart_weight');
		}

		if (isset($this->request->post['pickpoint_cart_cost'])) {
			$data['pickpoint_cart_cost'] = $this->request->post['pickpoint_cart_cost'];
		} else {
			$data['pickpoint_cart_cost'] = $this->config->get('pickpoint_cart_cost');
		}

		if (isset($this->request->post['pickpoint_cost_round'])) {
			$data['pickpoint_cost_round'] = $this->request->post['pickpoint_cost_round'];
		} else {
			$data['pickpoint_cost_round'] = $this->config->get('pickpoint_cost_round');
		}



		if (isset($this->request->post['pickpoint_point_cost'])) {
			$data['pickpoint_point_cost'] = $this->request->post['pickpoint_point_cost'];
		} else {
			$data['pickpoint_point_cost'] = $this->config->get('pickpoint_point_cost');
		}

		if (isset($this->request->post['pickpoint_point_days'])) {
			$data['pickpoint_point_days'] = $this->request->post['pickpoint_point_days'];
		} else {
			$data['pickpoint_point_days'] = $this->config->get('pickpoint_point_days');
		}

		if (isset($this->request->post['pickpoint_courier_cost'])) {
			$data['pickpoint_courier_cost'] = $this->request->post['pickpoint_courier_cost'];
		} else {
			$data['pickpoint_courier_cost'] = $this->config->get('pickpoint_courier_cost');
		}

		if (isset($this->request->post['pickpoint_courier_days'])) {
			$data['pickpoint_courier_days'] = $this->request->post['pickpoint_courier_days'];
		} else {
			$data['pickpoint_courier_days'] = $this->config->get('pickpoint_courier_days');
		}

		if (isset($this->request->post['pickpoint_min_sum'])) {
			$data['pickpoint_min_sum'] = $this->request->post['pickpoint_min_sum'];
		} else {
			$data['pickpoint_min_sum'] = $this->config->get('pickpoint_min_sum');
		}

		if (isset($this->request->post['pickpoint_custom_add_sum'])) {
			$data['pickpoint_custom_add_sum'] = $this->request->post['pickpoint_custom_add_sum'];
		} else {
			$data['pickpoint_custom_add_sum'] = $this->config->get('pickpoint_custom_add_sum');
		}

		if (isset($this->request->post['pickpoint_min_shipping_sum'])) {
			$data['pickpoint_min_shipping_sum'] = $this->request->post['pickpoint_min_shipping_sum'];
		} elseif ( $this->config->get('pickpoint_min_shipping_sum') ) {
			$data['pickpoint_min_shipping_sum'] = $this->config->get('pickpoint_min_shipping_sum');
		} else {
			$data['pickpoint_min_shipping_sum'] = '150';
		}

		if (isset($this->request->post['pickpoint_zero_from'])) {
			$data['pickpoint_zero_from'] = $this->request->post['pickpoint_zero_from'];
		} else {
			$data['pickpoint_zero_from'] = $this->config->get('pickpoint_zero_from');
		}

		if (isset($this->request->post['pickpoint_zero_sum'])) {
			$data['pickpoint_zero_sum'] = $this->request->post['pickpoint_zero_sum'];
		} else {
			$data['pickpoint_zero_sum'] = $this->config->get('pickpoint_zero_sum');
		}

		if (isset($this->request->post['pickpoint_markup'])) {
			$data['pickpoint_markup'] = $this->request->post['pickpoint_markup'];
		} else {
			$data['pickpoint_markup'] = $this->config->get('pickpoint_markup');
		}
		

		if (isset($this->request->post['pickpoint_status'])) {
			$data['pickpoint_status'] = $this->request->post['pickpoint_status'];
		} else {
			$data['pickpoint_status'] = $this->config->get('pickpoint_status');
		}

		if (isset($this->request->post['pickpoint_mode'])) {
			$data['pickpoint_mode'] = $this->request->post['pickpoint_mode'];
		} else {
			$data['pickpoint_mode'] = $this->config->get('pickpoint_mode');
		}

		if (isset($this->request->post['pickpoint_tax_class_id'])) {
			$data['pickpoint_tax_class_id'] = $this->request->post['pickpoint_tax_class_id'];
		} else {
			$data['pickpoint_tax_class_id'] = $this->config->get('pickpoint_tax_class_id');
		}
		
		if (isset($this->request->post['pickpoint_sort_order'])) {
			$data['pickpoint_sort_order'] = $this->request->post['pickpoint_sort_order'];
		} else {
			$data['pickpoint_sort_order'] = $this->config->get('pickpoint_sort_order');
		}	

		if (isset($this->request->post['pickpoint_statuses'])) {
			$data['pickpoint_statuses'] = $this->request->post['pickpoint_statuses'];
		} else {
			$data['pickpoint_statuses'] = $this->config->get('pickpoint_statuses');
		}	

		if (isset($this->request->post['pickpoint_dont_export_statuses'])) {
			$data['pickpoint_dont_export_statuses'] = $this->request->post['pickpoint_dont_export_statuses'];
		} elseif ($this->config->get('pickpoint_dont_export_statuses')) {
			$data['pickpoint_dont_export_statuses'] = $this->config->get('pickpoint_dont_export_statuses');
		} else 
			$data['pickpoint_dont_export_statuses'] = array();

		if (isset($this->request->post['pickpoint_postage_type'])) {
			$data['pickpoint_postage_type'] = $this->request->post['pickpoint_postage_type'];
		} else {
			$data['pickpoint_postage_type'] = $this->config->get('pickpoint_postage_type');
		}	

		if (isset($this->request->post['pickpoint_getting_type'])) {
			$data['pickpoint_getting_type'] = $this->request->post['pickpoint_getting_type'];
		} else {
			$data['pickpoint_getting_type'] = $this->config->get('pickpoint_getting_type');
		}	


		if (isset($this->request->post['pickpoint_return_address_city_name'])) {
			$data['pickpoint_return_address_city_name'] = $this->request->post['pickpoint_return_address_city_name'];
		} else {
			$data['pickpoint_return_address_city_name'] = $this->config->get('pickpoint_return_address_city_name');
		}
	
		if (isset($this->request->post['pickpoint_return_address_region_name'])) {
			$data['pickpoint_return_address_region_name'] = $this->request->post['pickpoint_return_address_region_name'];
		} else {
			$data['pickpoint_return_address_region_name'] = $this->config->get('pickpoint_return_address_region_name');
		}
	
		if (isset($this->request->post['pickpoint_return_address_address'])) {
			$data['pickpoint_return_address_address'] = $this->request->post['pickpoint_return_address_address'];
		} else {
			$data['pickpoint_return_address_address'] = $this->config->get('pickpoint_return_address_address');
		}	

		if (isset($this->request->post['pickpoint_return_address_fio'])) {
			$data['pickpoint_return_address_fio'] = $this->request->post['pickpoint_return_address_fio'];
		} else {
			$data['pickpoint_return_address_fio'] = $this->config->get('pickpoint_return_address_fio');
		}	

		if (isset($this->request->post['pickpoint_return_address_post_code'])) {
			$data['pickpoint_return_address_post_code'] = $this->request->post['pickpoint_return_address_post_code'];
		} else {
			$data['pickpoint_return_address_post_code'] = $this->config->get('pickpoint_return_address_post_code');
		}	

		if (isset($this->request->post['pickpoint_return_address_organisation'])) {
			$data['pickpoint_return_address_organisation'] = $this->request->post['pickpoint_return_address_organisation'];
		} else {
			$data['pickpoint_return_address_organisation'] = $this->config->get('pickpoint_return_address_organisation');
		}	

		if (isset($this->request->post['pickpoint_return_address_phone_number'])) {
			$data['pickpoint_return_address_phone_number'] = $this->request->post['pickpoint_return_address_phone_number'];
		} else {
			$data['pickpoint_return_address_phone_number'] = $this->config->get('pickpoint_return_address_phone_number');
		}	

		if (isset($this->request->post['pickpoint_export_status'])) {
			$data['pickpoint_export_status'] = $this->request->post['pickpoint_export_status'];
		} else {
			$data['pickpoint_export_status'] = $this->config->get('pickpoint_export_status');
		}	

		if (isset($this->request->post['pickpoint_custom_price'])) {
			$data['pickpoint_custom_price'] = $this->request->post['pickpoint_custom_price'];
		} else {
			$data['pickpoint_custom_price'] = $this->config->get('pickpoint_custom_price');
		}

		if (isset($this->request->post['pickpoint_custom_region_price'])) {
			$data['pickpoint_custom_region_price'] = $this->request->post['pickpoint_custom_region_price'];
		} else {
			$data['pickpoint_custom_region_price'] = $this->config->get('pickpoint_custom_region_price');
		} 

		if ($data['pickpoint_custom_region_price'] == "")
		{
			$postamats = $this->model_extension_shipping_pickpoint->getPostamatList($pickpoint_url);

			$regions = array();
			foreach($postamats as $postamat)
			{
				if (in_array($postamat['Region'], $regions)==false) $regions[]=$postamat['Region']; 
			}

			$list = "";

			foreach($regions as $region)
			{
				$list = $list . $region . " : " . "\n";
			}

			$data['pickpoint_custom_region_price'] = $list;

		}

		if (isset($this->request->post['pickpoint_custom_city_price'])) {
			$data['pickpoint_custom_city_price'] = $this->request->post['pickpoint_custom_city_price'];
		} else {
			$data['pickpoint_custom_city_price'] = $this->config->get('pickpoint_custom_city_price');
		}	

		if (isset($this->request->post['pickpoint_rub_select'])) {
			$data['pickpoint_rub_select'] = $this->request->post['pickpoint_rub_select'];
		} else {
			$data['pickpoint_rub_select'] = $this->config->get('pickpoint_rub_select');
		}	

		if (isset($this->request->post['pickpoint_kg_select'])) {
			$data['pickpoint_kg_select'] = $this->request->post['pickpoint_kg_select'];
		} else {
			$data['pickpoint_kg_select'] = $this->config->get('pickpoint_kg_select');
		}	


		if (!isset($data['pickpoint_statuses'])) $data['pickpoint_statuses'] = array();
		
		$this->load->model('localisation/tax_class');
				
		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$output = $this->model_extension_shipping_pickpoint->logout($pickpoint_url, $session_id);

		$this->response->setOutput($this->load->view('extension/shipping/pickpoint.tpl', $data));

	}
		
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/shipping/pickpoint')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['pickpoint_login']) {
			$this->error['pickpoint_login'] = $this->language->get('error_pickpoint_login');
		}

		if (!$this->request->post['pickpoint_url']) {
			$this->error['pickpoint_url'] = $this->language->get('error_pickpoint_url');
		}

		if (!$this->request->post['pickpoint_pwd']) {
			$this->error['pickpoint_pwd'] = $this->language->get('error_pickpoint_pwd');
		}

		if (!$this->request->post['pickpoint_ikn']) {
			$this->error['pickpoint_ikn'] = $this->language->get('error_pickpoint_ikn');
		}

		if (!$this->request->post['pickpoint_from_city']) {
			$this->error['pickpoint_from_city'] = $this->language->get('error_pickpoint_from_city');
		}

		if (!$this->request->post['pickpoint_from_region']) {
			$this->error['pickpoint_from_region'] = $this->language->get('error_pickpoint_from_region');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}

	public function install() {
		$this->load->model('extension/shipping/pickpoint');
		$this->model_extension_shipping_pickpoint->install();
	}
}