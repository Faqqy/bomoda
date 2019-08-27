<?php
/**
 * @author    p0v1n0m <p0v1n0m@gmail.com>
 * @license   Commercial
 * @link      https://github.com/p0v1n0m
 */
class ControllerExtensionShippingLLgrastin extends Controller {
	private $m = 'll_grastin';
	private $version = '1.6.9';
	private $email = 'p0v1n0m@gmail.com';
	private $site = 'https://p0v1n0m.ru';
	private $module_docs = 'https://opencartforum.com/files/file/6800-dostavka-«grastin»-neoficialnyy/';
	private $delivery = 'https://grastin.ru/';
	private $api_docs = 'http://api.grastin.ru/';
	private $variants = [
		'courier_grastin',
		'courier_boxberry',
		'pickup_grastin',
		'pickup_boxberry',
		'pickup_hermes',
		'pickup_partner',
		'pickup_post',
	];
	private $variants_map = [
		'pickup_grastin',
		'pickup_boxberry',
		'pickup_hermes',
		'pickup_partner',
	];
	private $controls = [
		'geolocationControl',
		'searchControl',
		'routeButtonControl',
		'trafficControl',
		'typeSelector',
		'fullscreenControl',
		'zoomControl',
		'rulerControl',
	];

	private $error = [];

	public function index() {
		$this->load->language('extension/shipping/' . $this->m);

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (isset($this->request->post[$this->m . '_license']) && isset($this->request->server['HTTP_HOST']) && base64_encode(hash_hmac('sha256',$this->request->server['HTTP_HOST'].$this->m,M_PI,true)) == $this->request->post[$this->m . '_license']) {
				$this->model_setting_setting->editSetting($this->m, $this->request->post);

				$this->session->data['success'] = $this->language->get('text_success');

				if (isset($this->request->get['back'])) {
					$this->response->redirect($this->url->link('extension/shipping/' . $this->m, 'token=' . $this->session->data['token'], true));
				} else {
					$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true));
				}
			} else {
				$this->load->model('extension/extension');

				$this->model_extension_extension->uninstall('shipping', $this->m);

				$this->session->data['warning'] = $this->language->get('error_license');

				$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true));
			}
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['heading_license'] = $this->language->get('heading_license');
		$data['button_total'] = $this->language->get('button_total');
		$data['button_export'] = $this->language->get('button_export');
		$data['button_order'] = $this->language->get('button_order');
		$data['button_apply'] = $this->language->get('button_apply');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['tab_setting'] = $this->language->get('tab_setting');
		$data['tab_api'] = $this->language->get('tab_api');
		$data['tab_delivery'] = $this->language->get('tab_delivery');
		$data['tab_map'] = $this->language->get('tab_map');
		$data['tab_cap'] = $this->language->get('tab_cap');
		$data['tab_support'] = $this->language->get('tab_support');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_developer'] = $this->language->get('text_developer');
		$data['text_site'] = $this->language->get('text_site');
		$data['text_module_docs'] = $this->language->get('text_module_docs');
		$data['text_delivery'] = $this->language->get('text_delivery');
		$data['text_api_docs'] = $this->language->get('text_api_docs');
		$data['text_kg'] = $this->language->get('text_kg');
		$data['text_sm'] = $this->language->get('text_sm');
		$data['text_rub'] = $this->language->get('text_rub');
		$data['text_dni'] = $this->language->get('text_dni');
		$data['text_pcs'] = $this->language->get('text_pcs');
		$data['text_volume'] = $this->language->get('text_volume');
		$data['text_width'] = $this->language->get('text_width');
		$data['text_length'] = $this->language->get('text_length');
		$data['text_height'] = $this->language->get('text_height');
		$data['text_courier_grastin'] = $this->language->get('text_courier_grastin');
		$data['text_courier_boxberry'] = $this->language->get('text_courier_boxberry');
		$data['text_pickup_grastin'] = $this->language->get('text_pickup_grastin');
		$data['text_pickup_boxberry'] = $this->language->get('text_pickup_boxberry');
		$data['text_pickup_hermes'] = $this->language->get('text_pickup_hermes');
		$data['text_pickup_partner'] = $this->language->get('text_pickup_partner');
		$data['text_pickup_post'] = $this->language->get('text_pickup_post');
		$data['text_logo'] = $this->language->get('text_logo');
		$data['text_name'] = $this->language->get('text_name');
		$data['text_desc'] = $this->language->get('text_desc');
		$data['text_days'] = $this->language->get('text_days');
		$data['text_percent_order'] = $this->language->get('text_percent_order');
		$data['text_percent_shipping'] = $this->language->get('text_percent_shipping');
		$data['text_map_overall'] = $this->language->get('text_map_overall');
		$data['text_map_individual'] = $this->language->get('text_map_individual');
		$data['text_license'] = $this->language->get('text_license');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_weight_class'] = $this->language->get('entry_weight_class');
		$data['entry_default_weight'] = $this->language->get('entry_default_weight');
		$data['entry_length_class'] = $this->language->get('entry_length_class');
		$data['entry_default_dimension'] = $this->language->get('entry_default_dimension');
		$data['entry_default_length'] = $this->language->get('entry_default_length');
		$data['entry_default_width'] = $this->language->get('entry_default_width');
		$data['entry_default_height'] = $this->language->get('entry_default_height');
		$data['entry_calc_type'] = $this->language->get('entry_calc_type');
		$data['entry_weight'] = $this->language->get('entry_weight');
		$data['entry_min_weight'] = $this->language->get('entry_min_weight');
		$data['entry_max_weight'] = $this->language->get('entry_max_weight');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_min_total'] = $this->language->get('entry_min_total');
		$data['entry_max_total'] = $this->language->get('entry_max_total');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_api_key'] = $this->language->get('entry_api_key');
		$data['entry_logging'] = $this->language->get('entry_logging');
		$data['entry_cache'] = $this->language->get('entry_cache');
		$data['entry_list'] = $this->language->get('entry_list');
		$data['entry_quote_title'] = $this->language->get('entry_quote_title');
		$data['entry_add_day'] = $this->language->get('entry_add_day');
		$data['entry_shipping_cost'] = $this->language->get('entry_shipping_cost');
		$data['entry_order_cost'] = $this->language->get('entry_order_cost');
		$data['entry_cap_cost'] = $this->language->get('entry_cap_cost');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_value'] = $this->language->get('entry_value');
		$data['entry_only_total'] = $this->language->get('entry_only_total');
		$data['entry_code'] = $this->language->get('entry_code');
		$data['entry_map_key'] = $this->language->get('entry_map_key');
		$data['entry_map_type'] = $this->language->get('entry_map_type');
		$data['entry_map_filter'] = $this->language->get('entry_map_filter');
		$data['entry_map_controls'] = $this->language->get('entry_map_controls');
		$data['entry_license'] = $this->language->get('entry_license');
		$data['help_title'] = $this->language->get('help_title');
		$data['help_sort_order'] = $this->language->get('help_sort_order');
		$data['help_weight_class_id'] = $this->language->get('help_weight_class_id');
		$data['help_default_weight'] = $this->language->get('help_default_weight');
		$data['help_length_class_id'] = $this->language->get('help_length_class_id');
		$data['help_default_dimension'] = $this->language->get('help_default_dimension');
		$data['help_calc_type'] = $this->language->get('help_calc_type');
		$data['help_min_weight'] = $this->language->get('help_min_weight');
		$data['help_max_weight'] = $this->language->get('help_max_weight');
		$data['help_min_total'] = $this->language->get('help_min_total');
		$data['help_max_total'] = $this->language->get('help_max_total');
		$data['help_api_key'] = $this->language->get('help_api_key');
		$data['help_logging'] = $this->language->get('help_logging');
		$data['help_cache'] = $this->language->get('help_cache');
		$data['help_variant_list'] = $this->language->get('help_variant_list');
		$data['help_variant_sort_order'] = $this->language->get('help_variant_sort_order');
		$data['help_variant_quote_title'] = $this->language->get('help_variant_quote_title');
		$data['help_variant_add_day'] = $this->language->get('help_variant_add_day');
		$data['help_variant_cost_cost'] = $this->language->get('help_variant_cost_cost');
		$data['help_variant_cost_city'] = $this->language->get('help_variant_cost_city');
		$data['help_variant_cost_mod'] = $this->language->get('help_variant_cost_mod');
		$data['help_variant_cost_total'] = $this->language->get('help_variant_cost_total');
		$data['help_variant_cost_example'] = $this->language->get('help_variant_cost_example');
		$data['help_variant_code'] = $this->language->get('help_variant_code');
		$data['help_map_key'] = $this->language->get('help_map_key');
		$data['help_map_type'] = $this->language->get('help_map_type');
		$data['help_map_filter'] = $this->language->get('help_map_filter');
		$data['help_map_control'] = $this->language->get('help_map_control');

		if (isset($this->session->data['warning'])) {
			$data['error_warning'] = $this->session->data['warning'];

			unset($this->session->data['warning']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true),
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/shipping/' . $this->m, 'token=' . $this->session->data['token'], true),
		];

		$data['total'] = $this->url->link('extension/total/ll_total', 'token=' . $this->session->data['token'], true);
		$data['export'] = $this->url->link('extension/module/' . $this->m . '_export', 'token=' . $this->session->data['token'], true);
		$data['order'] = $this->url->link('extension/module/' . $this->m . '_export/order', 'token=' . $this->session->data['token'], true);
		$data['action'] = $this->url->link('extension/shipping/' . $this->m, 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true);

		if (isset($this->request->post[$this->m . '_title'])) {
			$data[$this->m . '_title'] = $this->request->post[$this->m . '_title'];
		} elseif ($this->config->has($this->m . '_title')) {
			$data[$this->m . '_title'] = $this->config->get($this->m . '_title');
		} else {
			$data[$this->m . '_title'] = 'Grastin';
		}

		if (isset($this->request->post[$this->m . '_sort_order'])) {
			$data[$this->m . '_sort_order'] = $this->request->post[$this->m . '_sort_order'];
		} else {
			$data[$this->m . '_sort_order'] = $this->config->get($this->m . '_sort_order');
		}

		$this->load->model('localisation/weight_class');

		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();

		if (isset($this->request->post[$this->m . '_weight_class_id'])) {
			$data[$this->m . '_weight_class_id'] = $this->request->post[$this->m . '_weight_class_id'];
		} else {
			$data[$this->m . '_weight_class_id'] = $this->config->get($this->m . '_weight_class_id');
		}

		if (isset($this->request->post[$this->m . '_default_weight'])) {
			$data[$this->m . '_default_weight'] = $this->request->post[$this->m . '_default_weight'];
		} elseif ($this->config->has($this->m . '_default_weight')) {
			$data[$this->m . '_default_weight'] = $this->config->get($this->m . '_default_weight');
		} else {
			$data[$this->m . '_default_weight'] = 1;
		}

		$this->load->model('localisation/length_class');

		$data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		if (isset($this->request->post[$this->m . '_length_class_id'])) {
			$data[$this->m . '_length_class_id'] = $this->request->post[$this->m . '_length_class_id'];
		} else {
			$data[$this->m . '_length_class_id'] = $this->config->get($this->m . '_length_class_id');
		}

		if (isset($this->request->post[$this->m . '_default_length'])) {
			$data[$this->m . '_default_length'] = $this->request->post[$this->m . '_default_length'];
		} elseif ($this->config->has($this->m . '_default_length')) {
			$data[$this->m . '_default_length'] = $this->config->get($this->m . '_default_length');
		} else {
			$data[$this->m . '_default_length'] = 10;
		}

		if (isset($this->request->post[$this->m . '_default_width'])) {
			$data[$this->m . '_default_width'] = $this->request->post[$this->m . '_default_width'];
		} elseif ($this->config->has($this->m . '_default_width')) {
			$data[$this->m . '_default_width'] = $this->config->get($this->m . '_default_width');
		} else {
			$data[$this->m . '_default_width'] = 10;
		}

		if (isset($this->request->post[$this->m . '_default_height'])) {
			$data[$this->m . '_default_height'] = $this->request->post[$this->m . '_default_height'];
		} elseif ($this->config->has($this->m . '_default_height')) {
			$data[$this->m . '_default_height'] = $this->config->get($this->m . '_default_height');
		} else {
			$data[$this->m . '_default_height'] = 10;
		}

		if (isset($this->request->post[$this->m . '_calc_type'])) {
			$data[$this->m . '_calc_type'] = $this->request->post[$this->m . '_calc_type'];
		} elseif ($this->config->has($this->m . '_calc_type')) {
			$data[$this->m . '_calc_type'] = $this->config->get($this->m . '_calc_type');
		} else {
			$data[$this->m . '_calc_type'] = 0;
		}

		if (isset($this->request->post[$this->m . '_min_weight'])) {
			$data[$this->m . '_min_weight'] = $this->request->post[$this->m . '_min_weight'];
		} else {
			$data[$this->m . '_min_weight'] = $this->config->get($this->m . '_min_weight');
		}

		if (isset($this->request->post[$this->m . '_max_weight'])) {
			$data[$this->m . '_max_weight'] = $this->request->post[$this->m . '_max_weight'];
		} else {
			$data[$this->m . '_max_weight'] = $this->config->get($this->m . '_max_weight');
		}

		if (isset($this->request->post[$this->m . '_min_total'])) {
			$data[$this->m . '_min_total'] = $this->request->post[$this->m . '_min_total'];
		} else {
			$data[$this->m . '_min_total'] = $this->config->get($this->m . '_min_total');
		}

		if (isset($this->request->post[$this->m . '_max_total'])) {
			$data[$this->m . '_max_total'] = $this->request->post[$this->m . '_max_total'];
		} else {
			$data[$this->m . '_max_total'] = $this->config->get($this->m . '_max_total');
		}

		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post[$this->m . '_tax_class_id'])) {
			$data[$this->m . '_tax_class_id'] = $this->request->post[$this->m . '_tax_class_id'];
		} else {
			$data[$this->m . '_tax_class_id'] = $this->config->get($this->m . '_tax_class_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post[$this->m . '_geo_zone_id'])) {
			$data[$this->m . '_geo_zone_id'] = $this->request->post[$this->m . '_geo_zone_id'];
		} elseif ($this->config->has($this->m . '_geo_zone_id')) {
			$data[$this->m . '_geo_zone_id'] = $this->config->get($this->m . '_geo_zone_id');
		} else {
			$data[$this->m . '_geo_zone_id'] = [];
		}

		if (isset($this->request->post[$this->m . '_status'])) {
			$data[$this->m . '_status'] = $this->request->post[$this->m . '_status'];
		} else {
			$data[$this->m . '_status'] = $this->config->get($this->m . '_status');
		}

		if (isset($this->request->post[$this->m . '_api_key'])) {
			$data[$this->m . '_api_key'] = $this->request->post[$this->m . '_api_key'];
		} else {
			$data[$this->m . '_api_key'] = $this->config->get($this->m . '_api_key');
		}

		if (isset($this->request->post[$this->m . '_logging'])) {
			$data[$this->m . '_logging'] = $this->request->post[$this->m . '_logging'];
		} else {
			$data[$this->m . '_logging'] = $this->config->get($this->m . '_logging');
		}

		if (isset($this->request->post[$this->m . '_cache'])) {
			$data[$this->m . '_cache'] = $this->request->post[$this->m . '_cache'];
		} else {
			$data[$this->m . '_cache'] = $this->config->get($this->m . '_cache');
		}

		if (isset($this->request->post[$this->m . '_map_key'])) {
			$data[$this->m . '_map_key'] = $this->request->post[$this->m . '_map_key'];
		} elseif ($this->config->get($this->m . '_map_key')) {
			$data[$this->m . '_map_key'] = $this->config->get($this->m . '_map_key');
		} else {
			$data[$this->m . '_map_key'] = '52213c4c-d0f8-44e8-bfde-5bed0d30cc25';
		}

		if (isset($this->request->post[$this->m . '_map_type'])) {
			$data[$this->m . '_map_type'] = $this->request->post[$this->m . '_map_type'];
		} else {
			$data[$this->m . '_map_type'] = $this->config->get($this->m . '_map_type');
		}

		if (isset($this->request->post[$this->m . '_map_filter'])) {
			$data[$this->m . '_map_filter'] = $this->request->post[$this->m . '_map_filter'];
		} elseif ($this->config->has($this->m . '_map_filter')) {
			$data[$this->m . '_map_filter'] = $this->config->get($this->m . '_map_filter');
		} else {
			$data[$this->m . '_map_filter'] = 1;
		}

		foreach ($this->controls as $control) {
			$data[$this->m . '_map_controls'][] = [
				'code' => $control,
				'name' => $this->language->get('text_' . $control),
			];
		}

		if (isset($this->request->post[$this->m . '_map_control'])) {
			$data[$this->m . '_map_control'] = $this->request->post[$this->m . '_map_control'];
		} elseif ($this->config->has($this->m . '_map_control')) {
			$data[$this->m . '_map_control'] = $this->config->get($this->m . '_map_control');
		} else {
			$data[$this->m . '_map_control'] = [];
		}

		if (isset($this->request->post[$this->m . '_cap_status'])) {
			$data[$this->m . '_cap_status'] = $this->request->post[$this->m . '_cap_status'];
		} else {
			$data[$this->m . '_cap_status'] = $this->config->get($this->m . '_cap_status');
		}

 		if (isset($this->request->post[$this->m . '_cap_title'])) {
			$data[$this->m . '_cap_title'] = $this->request->post[$this->m . '_cap_title'];
		} else {
			$data[$this->m . '_cap_title'] = $this->config->get($this->m . '_cap_title');
		}

 		if (isset($this->request->post[$this->m . '_cap_cost'])) {
			$data[$this->m . '_cap_cost'] = $this->request->post[$this->m . '_cap_cost'];
		} else {
			$data[$this->m . '_cap_cost'] = $this->config->get($this->m . '_cap_cost');
		}

		$data['variants'] = $this->variants;
		$data['variants_map'] = $this->variants_map;

		foreach ($data['variants'] as $code) {
			if (isset($this->request->post[$this->m . '_status_' . $code])) {
				$data[$this->m . '_status_' . $code] = $this->request->post[$this->m . '_status_' . $code];
			} elseif ($this->config->has($this->m . '_status_' . $code)) {
				$data[$this->m . '_status_' . $code] = $this->config->get($this->m . '_status_' . $code);
			} else {
				$data[$this->m . '_status_' . $code] = 1;
			}

			if (isset($this->request->post[$this->m . '_list_' . $code])) {
				$data[$this->m . '_list_' . $code] = $this->request->post[$this->m . '_list_' . $code];
			} else {
				$data[$this->m . '_list_' . $code] = $this->config->get($this->m . '_list_' . $code);
			}

			if (isset($this->request->post[$this->m . '_sort_order_' . $code])) {
				$data[$this->m . '_sort_order_' . $code] = $this->request->post[$this->m . '_sort_order_' . $code];
			} else {
				$data[$this->m . '_sort_order_' . $code] = $this->config->get($this->m . '_sort_order_' . $code);
			}

			if (isset($this->request->post[$this->m . '_geo_zone_id_' . $code])) {
				$data[$this->m . '_geo_zone_id_' . $code] = $this->request->post[$this->m . '_geo_zone_id_' . $code];
			} elseif ($this->config->has($this->m . '_geo_zone_id_' . $code)) {
				$data[$this->m . '_geo_zone_id_' . $code] = $this->config->get($this->m . '_geo_zone_id_' . $code);
			} else {
				$data[$this->m . '_geo_zone_id_' . $code] = [];
			}

			if (isset($this->request->post[$this->m . '_quote_title_' . $code])) {
				$data[$this->m . '_quote_title_' . $code] = $this->request->post[$this->m . '_quote_title_' . $code];
			} elseif ($this->config->has($this->m . '_quote_title_' . $code)) {
				$data[$this->m . '_quote_title_' . $code] = $this->config->get($this->m . '_quote_title_' . $code);
			} else {
				$data[$this->m . '_quote_title_' . $code] = '{{logo}} {{name}} ({{days}})';
			}

			if (isset($this->request->post[$this->m . '_add_day_' . $code])) {
				$data[$this->m . '_add_day_' . $code] = $this->request->post[$this->m . '_add_day_' . $code];
			} else {
				$data[$this->m . '_add_day_' . $code] = $this->config->get($this->m . '_add_day_' . $code);
			}

			if (isset($this->request->post[$this->m . '_costs_' . $code])) {
				$data[$this->m . '_costs_' . $code] = $this->request->post[$this->m . '_costs_' . $code];
			} elseif ($this->config->has($this->m . '_costs_' . $code)) {
				$data[$this->m . '_costs_' . $code] = $this->config->get($this->m . '_costs_' . $code);
			} else {
				$data[$this->m . '_costs_' . $code] = [];
			}
		}

		if (isset($this->request->post[$this->m . '_license'])) {
			$data[$this->m . '_license'] = $this->request->post[$this->m . '_license'];
		} else {
			$data[$this->m . '_license'] = $this->config->get($this->m . '_license');
		}

		$data['m'] = $this->m;
		$data['version'] = $this->version;
		$data['email'] = $this->email;
		$data['site'] = $this->site;
		$data['module_docs'] = $this->module_docs;
		$data['delivery'] = $this->delivery;
		$data['api_docs'] = $this->api_docs;
		$data['host'] = isset($this->request->server['HTTP_HOST']) ? $this->request->server['HTTP_HOST'] : '';

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/shipping/' . $this->m, $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/shipping/' . $this->m)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function install() {
		$this->load->model('extension/event');
		$this->model_extension_event->addEvent($this->m . '_checkout_js', 'catalog/controller/common/header/before', 'extension/shipping/' . $this->m . '/addCheckoutJs');
	}

	public function uninstall() {
		$this->load->model('extension/event');
		$this->model_extension_event->deleteEvent($this->m . '_checkout_js');
	}
}
