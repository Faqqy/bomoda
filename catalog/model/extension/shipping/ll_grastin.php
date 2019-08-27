<?php
/**
 * @author    p0v1n0m <p0v1n0m@gmail.com>
 * @license   Commercial
 * @link      https://github.com/p0v1n0m
 */
include_once DIR_SYSTEM . 'library/ll/grastin/src/Grastin.php';

use Depakespedro\Grastin\Grastin as Grastin;

class ModelExtensionShippingLLgrastin extends Model {
	private $m = 'll_grastin';
	private $delivery_region_courier_grastin_ms = 'e92ae8a3-074c-11e2-a6e5-00152d030203';
	private $delivery_region_courier_grastin_sp = 'e92ae8a4-074c-11e2-a6e5-00152d030203';
	private $delivery_region_courier_grastin_nn = '4f14dcd5-e633-11e3-be1e-00155d030401';
	private $delivery_region_courier_grastin_or = 'ff4c9278-e0f3-4035-8d5c-e0da19e90fa3';
	private $delivery_region_courier_boxberry = '7d9e8b58-c94b-445d-97b8-c5cf57654f11';
	private $delivery_region_pickup_grastin_ms = 'e92ae8a3-074c-11e2-a6e5-00152d030203';
	private $delivery_region_pickup_grastin_sp = 'e92ae8a4-074c-11e2-a6e5-00152d030203';
	private $delivery_region_pickup_grastin_nn = '4f14dcd5-e633-11e3-be1e-00155d030401';
	private $delivery_region_pickup_grastin_or = 'ff4c9278-e0f3-4035-8d5c-e0da19e90fa3';
	private $delivery_region_pickup_boxberry = '7d9e8b58-c94b-445d-97b8-c5cf57654f11';
	private $delivery_region_pickup_hermes = '50d5a8de-edfe-482c-8896-1f7df52d7c8a';
	private $delivery_region_pickup_partner = '34a0cb74-32f7-4f80-bb5b-098e12647e13';
	private $delivery_region_pickup_post = 'e92ae8a2-074c-11e2-a6e5-00152d030203';
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
	private $point_colors = [
		'pickup_grastin'  => 'islands#pinkIcon',
		'pickup_partner'  => 'islands#violetIcon',
		'pickup_boxberry' => 'islands#redIcon',
		'pickup_hermes'   => 'islands#darkBlueIcon',
	];
	private $point_active_colors = [
		'pickup_grastin'  => 'islands#pinkDotIcon',
		'pickup_partner'  => 'islands#violetDotIcon',
		'pickup_boxberry' => 'islands#redDotIcon',
		'pickup_hermes'   => 'islands#darkBlueDotIcon',
	];
	private $pvzs = null;
	private $pickups = null;
	private $address = null;
	private $msk_cities = [
		'москва', 'апрелевка', 'балашиха', 'бронницы', 'видное', 'голицыно', 'дедовск', 'дзержинский', 'долгопрудный', 'домодедово',
		'железнодорожный', 'жуковский', 'звенигород', 'ивантеевка', 'истра', 'климовск', 'королев', 'королёв', 'котельники', 'красноармейск',
		'красногорск', 'краснознаменск', 'кубинка', 'лобня', 'лосино-петровский', 'лыткарино', 'люберцы', 'московский', 'мытищи', 'ногинск',
		'одинцово', 'подольск', 'пушкино', 'раменское', 'реутов', 'солнечногорск', 'старая купавна', 'троицк', 'фрязино', 'химки',
		'черноголовка', 'щёлково', 'щелково', 'щербинка', 'электросталь', 'электроугли', 'юбилейный', 'яхрома', 'мск',
	];

	function getQuote($address) {
		$status = true;

		if (!empty($this->config->get($this->m . '_geo_zone_id'))) {
			$query_rows = 0;

			foreach ($this->config->get($this->m . '_geo_zone_id') as $geo_zone_id) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$geo_zone_id . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

				$query_rows += $query->num_rows;
			}

			if (!$query_rows) {
				$status = false;
			}
		}

		$method_data = [];

		if ($status && $this->config->get($this->m . '_api_key') && isset($address['city'])) {
			$this->load->language('extension/shipping/' . $this->m);

			$this->address = $address;
			$address_city = mb_strtolower(trim($address['city']));
			$address_postcode = $address['postcode'];
			$weight = 0;
			$length = 0;
			$width = 0;
			$height = 0;
			$volume = 0;
			$bulky = 'false';
			$start = true;
			$total = isset($address['ll_total']) ? $address['ll_total'] : $this->cart->getSubTotal();
			$products = isset($address['ll_products']) ? $address['ll_products'] : $this->cart->getProducts();

 			foreach ($products as $product) {
				if ($product['shipping']) {
					$product_weight = $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get($this->m . '_weight_class_id'));
					$product_length = $this->length->convert($product['length'], $product['length_class_id'], $this->config->get($this->m . '_length_class_id'));
					$product_width = $this->length->convert($product['width'], $product['length_class_id'], $this->config->get($this->m . '_length_class_id'));
					$product_height = $this->length->convert($product['height'], $product['length_class_id'], $this->config->get($this->m . '_length_class_id'));

					$product_weight = $product_weight == 0 ? $this->config->get($this->m . '_default_weight') : $product_weight;
					$product_length = $product_length == 0 ? $this->config->get($this->m . '_default_length') : $product_length;
					$product_width = $product_width == 0 ? $this->config->get($this->m . '_default_width') : $product_width;
					$product_height = $product_height == 0 ? $this->config->get($this->m . '_default_height') : $product_height;

					if ($this->config->get($this->m . '_calc_type') == 1) {
						$length += $product_length > $length ? $product_length : 0;
						$width += $product_width * $product['quantity'];
						$height += $product_height > $height ? $product_height : 0;
					} elseif ($this->config->get($this->m . '_calc_type') == 2) {
						$length += $product_length * $product['quantity'];
						$width += $product_width > $width ? $product_width : 0;
						$height += $product_height > $height ? $product_height : 0;
					} elseif ($this->config->get($this->m . '_calc_type') == 3) {
						$length += $product_length > $length ? $product_length : 0;
						$width += $product_width > $width ? $product_width : 0;
						$height += $product_height * $product['quantity'];
					} else {
						$volume += ($product_length * $product_width * $product_height) * $product['quantity'];
					}

					$weight += $product_weight;
				}
			}

			if ($this->config->get($this->m . '_calc_type') == 0) {
				$length = $width = $height = ceil(pow($volume, 1/3));
			}

			$volume = round($volume / 1000000, 3);

			if (($this->config->get($this->m . '_min_total') > 0 && $total < $this->config->get($this->m . '_min_total'))
				|| ($this->config->get($this->m . '_max_total') > 0 && $total > $this->config->get($this->m . '_max_total'))
				|| ($this->config->get($this->m . '_min_weight') > 0 && $weight < $this->config->get($this->m . '_min_weight'))
				|| ($this->config->get($this->m . '_max_weight') > 0 && $weight > $this->config->get($this->m . '_max_weight'))
			) {
				$start = false;
			}

			if (($length + $width + $height) >= 180 || $length > 120 || $width > 120 || $height > 120) {
				$bulky = 'true';
			} else {
				$volume = 0;
				$width = 0;
				$height = 0;
				$length = 0;
			}

			// переводим в граммы и пишем в сессию для модуля экспорта
			$this->session->data[$this->m . '_weight'] = $weight = $weight * 1000;

			$params = [
				'weight'           => $weight,
				'assessedsumma'    => (int)$total,
				'summa'            => (int)$total,
				'bulky'            => $bulky,
				'volume'           => $volume,
				'width'            => $width,
				'height'           => $height,
				'length'           => $length,
				'transportcompany' => 'false',
				'paiddistance'     => 0,
			];

			if ($start && $address_city != '') {
				$results = $this->getCost($params, $address_city, $address_postcode);
			}

			if (!empty($results)) {
				$quote_data = [];
	
				foreach ($results as $result) {
					$map = null;

					if (in_array($result['code'], $this->variants_map)) {
						if (isset($this->session->data['api_id'])) {
							$map .= '<div class="input-group hidden ll_shipping" data-shipping="' . $this->m . '.' . $this->m . '_' . $result['code'] . '"><div class="input-group-addon">' . $this->language->get('text_change_pickup') . '</div><select class="form-control" onchange="ll_shipping_set_pickup_id(\'' . $result['code'] . '\', this.value);">';

							foreach ($this->pvzs[$result['code']]['pickups'] as $pvz) {
								$id = isset($pvz['Id']) ? $pvz['Id'] : $pvz['id'];
								$name = $result['code'] == 'pickup_partner' ? $pvz['addres'] : $pvz['Name'];
								$map .= '<option value="' . $id . '" ' . ($id == $this->getActivePickupId($result['code']) ? 'selected="selected"' : '') . '>' . $name . '</option>';
							}

							$map .= '</select></div>';
						} else {
							if ($this->config->get($this->m . '_list_' . $result['code']) && !empty($this->pvzs[$result['code']]['pickups'])) {
								$map .= '<div style="max-width: 100%;"><select data-onchange="reloadAll" onchange="' . $this->m . '_set_pickup_id(\'' . $result['code'] . '\', this.value);" style="max-width: 300px;">';

								foreach ($this->pvzs[$result['code']]['pickups'] as $pvz) {
									$id = isset($pvz['Id']) ? $pvz['Id'] : $pvz['id'];
									$name = $result['code'] == 'pickup_partner' ? $pvz['addres'] : $pvz['Name'];
									$map .= '<option value="' . $id . '" ' . ($id == $this->getActivePickupId($result['code']) ? 'selected="selected"' : '') . '>' . $name . '</option>';
								}

								$map .= '</select>';
							}

							if ($this->config->get($this->m . '_map_type')) {
								if ($this->config->get($this->m . '_map_filter')) {
									$map .= '<a class="btn btn-default ll_set_button" style="padding: 1px;" onclick="' . $this->m . '_show_modal(\'' . $result['code'] . '\'); return false;">' . $this->language->get('text_change_pickup') . '</a>';
								} else {
									$map .= '<a class="btn btn-default ll_set_button" style="padding: 1px;" onclick="' . $this->m . '_show_modal(); return false;">' . $this->language->get('text_change_pickup') . '</a>';
								}
							}

							if ($this->config->get($this->m . '_list_' . $result['code']) && !empty($this->pvzs[$result['code']]['pickups'])) {
								$map .= '</div>';
							}
						}
					}

					$quote_data[$this->m . '_' . $result['code']] = [
						'code'         => $this->m . '.' . $this->m . '_' . $result['code'],
						'title'        => $result['title'],
						'cost'         => $this->config->get('ll_total_status') ? $result['cost_total'] : $result['cost'],
						'cost_total'   => $this->config->get('ll_total_status') ? $result['cost'] : $result['cost_total'],
						'tax_class_id' => $this->config->get($this->m . '_tax_class_id'),
						'text'         => $this->currency->format($this->tax->calculate($result['cost_total'], $this->config->get($this->m . '_tax_class_id'), $this->config->get('config_tax')), $this->session->data['currency']),
						'description'  => $map,
					];

					if (!isset($this->session->data['shipping_method']['code']) && isset($this->session->data['ll_shipping_widget_active']) && $this->session->data['ll_shipping_widget_active'] == $quote_data[$this->m . '_' . $result['code']]['code']) {
						$this->session->data['shipping_method']['code'] = $quote_data[$this->m . '_' . $result['code']]['code'];
						$this->session->data['shipping_method']['title'] = $quote_data[$this->m . '_' . $result['code']]['title'];
						$this->session->data['shipping_method']['cost'] = $quote_data[$this->m . '_' . $result['code']]['cost'];
						$this->session->data['shipping_method']['tax_class_id'] = $quote_data[$this->m . '_' . $result['code']]['tax_class_id'];
						$this->session->data['shipping_method']['text'] = $quote_data[$this->m . '_' . $result['code']]['text'];
					}
				}

				$map = null;

				if (!empty($this->pickups) && !isset($this->session->data['api_id'])) {
					$this->pickups['data']['type'] = 'FeatureCollection';
					$this->pickups['controls'] = $this->config->get($this->m . '_map_control') ? $this->config->get($this->m . '_map_control') : [];

					$map = '<script>' . $this->m . '_init(' . json_encode($this->pickups) . ');</script>';

					if (!$this->config->get($this->m . '_map_type')) {
						$map .= '<p><a class="btn btn-default ll_set_button" style="padding: 1px;" onclick="' . $this->m . '_show_modal();">' . $this->language->get('text_change_pickup') . '</a></p>';
					}
				}

				$method_data = [
					'code'       => $this->m,
					'title'      => $this->config->get($this->m . '_title') . $map,
					'quote'      => $quote_data,
					'sort_order' => $this->config->get($this->m . '_sort_order'),
					'error'      => false,
				];
			}
		}

		if (empty($method_data)) {
			$method_data = $this->getCap();
		}

		return $method_data;
	}

	protected function getCap() {
		if ($this->config->get($this->m . '_cap_status')) {
			$cost = $this->config->get($this->m . '_cap_cost') > 0 ? $this->config->get($this->m . '_cap_cost') : 0;

			$quote_data[$this->m . '_empty'] = [
				'code'         => $this->m . '.' . $this->m . '_empty',
				'title'        => $this->config->get($this->m . '_cap_title'),
				'cost'         => $cost,
				'tax_class_id' => $this->config->get($this->m . '_tax_class_id'),
				'text'         => $this->currency->format($this->tax->calculate($cost, $this->config->get($this->m . '_tax_class_id'), $this->config->get('config_tax')), $this->session->data['currency']),
			];

			$method_data = [
				'code'       => $this->m,
				'title'      => $this->config->get($this->m . '_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get($this->m . '_sort_order'),
				'error'      => false,
			];

			return $method_data;
		}
	}

	protected function getCost($params, $city, $postcode) {
		$data = [];
		$request = [];
		$initial = [];

		$api = new Grastin($this->config->get($this->m . '_api_key'));

		try {
			foreach ($this->variants as $code) {
				$pickups = [];
				$postfix = '';
				$regional = 'false';
				$idpickup = '';
				$idpostcode = '';
				$key = 0;

				if (!$this->config->get($this->m . '_status_' . $code)) {
					continue;
				}

				if ($code == 'courier_grastin' || $code == 'pickup_grastin') {
					if (in_array($city, $this->msk_cities)) {
						$postfix = '_ms';
					} elseif ($city == 'санкт-петербург') {
						$postfix = '_sp';
					} elseif ($city == 'нижний новгород') {
						$postfix = '_nn';
					} elseif ($city == 'орел' || $city == 'орёл') {
						$postfix = '_or';
					}
				}

				$idregion = $this->{'delivery_region_' . $code . $postfix};

				if ($code == 'pickup_grastin') {
					// костыль из-за разного наименования городов
					if ($city == 'орел') {
						$city = 'орёл';
					}

					$selfpickups = $this->getCache('selfpickup.city', $city);

					if (!$selfpickups) {
						$selfpickups = $api->selfpickup($city);

						if ($selfpickups) {
							$this->setCache('selfpickup.city', $city, $selfpickups);

							$this->addLog(1, 'selfpickup', $city, count($selfpickups));
						} else {
							$this->addLog(2, 'selfpickup', $city);

							continue;
						}
					}

					if (!isset($selfpickups[0])) {
						$selfpickups = [$selfpickups];
					}

					if (isset($this->session->data[$this->m . '_' . $code])) {
						foreach ($selfpickups as $k => $pickup) {
							if ($pickup['id'] == $this->session->data[$this->m . '_' . $code]) {
								$key = $k;
							}
						}
					}

					$regional = $selfpickups[$key]['regional'];
					$idpickup = $selfpickups[$key]['id'];

					$initial[$code]['pickups'] = $selfpickups;
					$initial[$code]['pickup'] = $selfpickups[$key];
					$initial[$code]['key'] = $key;

					$this->session->data[$this->m . '_' . $code] = $idpickup;
				}

				if ($code == 'courier_boxberry') {
					// костыль из-за разного наименования городов
					if ($city == 'орёл') {
						$city = 'орел';
					}

					$boxberrypostcodes = $this->getCache('boxberrypostcode.city', $city);

					if (!$boxberrypostcodes) {
						$boxberrypostcodes = $api->boxberrypostcode($city);

						if ($boxberrypostcodes) {
							$this->setCache('boxberrypostcode.city', $city, $boxberrypostcodes);

							$this->addLog(1, 'boxberrypostcode', $city, count($boxberrypostcodes));
						} else {
							$this->addLog(2, 'boxberrypostcode', $city);

							continue;
						}
					}

					if (!empty($boxberrypostcodes)) {
						foreach ($boxberrypostcodes as $boxberrypostcode) {
							if (isset($boxberrypostcode['Id']) && mb_strtoupper($boxberrypostcode['City']) == mb_strtoupper($city)) {
								$idpostcode = $boxberrypostcode['Id'];
								$initial[$code]['pickup'] = $boxberrypostcode;

								if ($idpostcode != '') {
									break;
								}
							}
						}

						$this->session->data[$this->m . '_' . $code] = $idpostcode;
					}
				}

				if ($code == 'pickup_boxberry') {
					// костыль из-за разного наименования городов
					if ($city == 'орёл') {
						$city = 'орел';
					}

					$boxberryselfpickups = $this->getCache('boxberryselfpickup.city', $city);

					if (!$boxberryselfpickups) {
						$boxberryselfpickups = $api->boxberryselfpickup($city);

						if ($boxberryselfpickups) {
							$this->setCache('boxberryselfpickup.city', $city, $boxberryselfpickups);

							$this->addLog(1, 'boxberryselfpickup', $city, count($boxberryselfpickups));
						} else {
							$this->addLog(2, 'boxberryselfpickup', $city);

							continue;
						}
					}

					if (!isset($boxberryselfpickups[0])) {
						$boxberryselfpickups = [$boxberryselfpickups];
					}

					if (isset($this->session->data[$this->m . '_' . $code])) {
						foreach ($boxberryselfpickups as $k => $pickup) {
							if ($pickup['Id'] == $this->session->data[$this->m . '_' . $code]) {
								$key = $k;
							}
						}
					}

					$idpickup = $boxberryselfpickups[$key]['Id'];

					$initial[$code]['pickups'] = $boxberryselfpickups;
					$initial[$code]['pickup'] = $boxberryselfpickups[$key];
					$initial[$code]['key'] = $key;

					$this->session->data[$this->m . '_' . $code] = $idpickup;
				}

				if ($code == 'pickup_hermes') {
					// костыль из-за разного наименования городов
					if ($city == 'орел') {
						$city = 'орёл';
					}

					$hermesselfpickups = $this->getCache('hermesselfpickup.city', $city);

					if (!$hermesselfpickups) {
						$hermesselfpickups = $api->hermesselfpickup($city);

						if ($hermesselfpickups) {
							$this->setCache('hermesselfpickup.city', $city, $hermesselfpickups);

							$this->addLog(1, 'hermesselfpickup', $city, count($hermesselfpickups));
						} else {
							$this->addLog(2, 'hermesselfpickup', $city);

							continue;
						}
					}

					if (!isset($hermesselfpickups[0])) {
						$hermesselfpickups = [$hermesselfpickups];
					}

					if (isset($this->session->data[$this->m . '_' . $code])) {
						foreach ($hermesselfpickups as $k => $pickup) {
							if ($pickup['Id'] == $this->session->data[$this->m . '_' . $code]) {
								$key = $k;
							}
						}
					}

					$idpickup = $hermesselfpickups[$key]['Id'];

					$initial[$code]['pickups'] = $hermesselfpickups;
					$initial[$code]['pickup'] = $hermesselfpickups[$key];
					$initial[$code]['key'] = $key;

					$this->session->data[$this->m . '_' . $code] = $idpickup;
				}

				if ($code == 'pickup_partner') {
					$partnerselfpickups = $this->getCache('partnerselfpickup.city', $city);

					if (!$partnerselfpickups) {
						$partnerselfpickups = $api->partnerselfpickup($city);

						if ($partnerselfpickups) {
							$this->setCache('partnerselfpickup.city', $city, $partnerselfpickups);

							$this->addLog(1, 'partnerselfpickup', $city, count($partnerselfpickups));
						} else {
							$this->addLog(2, 'partnerselfpickup', $city);

							continue;
						}
					}

					if (!isset($partnerselfpickups[0])) {
						$partnerselfpickups = [$partnerselfpickups];
					}

					if (isset($this->session->data[$this->m . '_' . $code])) {
						foreach ($partnerselfpickups as $k => $pickup) {
							if ($pickup['Id'] == $this->session->data[$this->m . '_' . $code]) {
								$key = $k;
							}
						}
					}

					$regional = $partnerselfpickups[$key]['regional'];
					$idpickup = $partnerselfpickups[$key]['Id'];

					$initial[$code]['pickups'] = $partnerselfpickups;
					$initial[$code]['pickup'] = $partnerselfpickups[$key];
					$initial[$code]['key'] = $key;

					$this->session->data[$this->m . '_' . $code] = $idpickup;
				}

				$new_params = [
					'number'     => $code,
					'idregion'   => $idregion,
					'selfpickup' => $code == 'courier_grastin' || $code == 'courier_boxberry' ? 'false' : 'true',
					'regional'   => $regional,
					'idpickup'   => $idpickup,
					'idpostcode' => $idpostcode,
					'postcode'   => $code == 'pickup_post' ? $postcode : '',
				];

				$request[] = array_merge($new_params, $params);
			}

			$result = $this->getCache('CalcShipingCost' . $this->getCacheName($params) . 'city', $city . $postcode);

			if (!$result) {
				$result = $api->CalcShipingCost($request);

				$this->setCache('CalcShipingCost' . $this->getCacheName($params) . 'city', $city . $postcode, $result);

				array_push($params, $city, $postcode);
				$this->addLog(1, 'CalcShipingCost', $params, $result);
			}

			// готовим методы после кэша, чтобы выбирать нужный пвз
			if (!empty($result)) {
				// если в ответе один вариант доставки, то он приходит в корне массива
				if (!isset($result[0])) {
					$result[0] = $result;
				}

				$data = $this->prepareVariants($initial, $result, $params['summa']);
				$this->pvzs = $initial;
			}
		} catch (Exception $e){
			array_push($params, $city, $postcode);
			$this->addLog(0, 'CalcShipingCost', $params, $e->getMessage());
		}

		return $data;
	}

	protected function prepareVariants($initial, $result, $summa) {
		$data = [];

		foreach ($result as $item) {
			if (isset($item['shippingcost']) && $item['shippingcost'] > 0) {
				$code = $item['number'];

				if (!$this->config->get($this->m . '_status_' . $code)) {
					continue;
				}

				if (!empty($this->config->get($this->m . '_geo_zone_id_' . $code))) {
					$query_rows = 0;

					foreach ($this->config->get($this->m . '_geo_zone_id_' . $code) as $geo_zone_id) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$geo_zone_id . "' AND country_id = '" . (int)$this->address['country_id'] . "' AND (zone_id = '" . (int)$this->address['zone_id'] . "' OR zone_id = '0')");

						$query_rows += $query->num_rows;
					}

					if (!$query_rows) {
						continue;
					}
				}

				$id = $this->getActivePickupId($code);
				$key = isset($initial[$code]['pickups']) ? $initial[$code]['key'] : 0;
				$cost = $this->prepareCost($item, $summa);

				$data[] = [
					'code'       => $code,
					'title'      => $this->prepareTitle($initial, $code, $key),
					'cost'       => $cost['cost'],
					'cost_total' => $cost['cost_total'],
					'sort'       => $this->config->get($this->m . '_sort_order_' . $code),
					'pickup_id'  => $id,
				];

				$this->prepareMap($initial, $code);
			}
		}

		$keys = array_column($data, 'sort');
		array_multisort($keys, SORT_ASC, $data);

		return $data;
	}

	protected function prepareTitle($initial, $code, $key) {
		$name = isset($initial[$code]['pickups'][$key]['Name']) ? $initial[$code]['pickups'][$key]['Name'] : '';

		$input = [
			'{{logo}}',
			'{{name}}',
			'{{desc}}',
			'{{days}}',
		];

		$output = [
			'logo' => $this->prepareImage($code, $name),
			'name' => $name,
			'desc' => $this->getPickupDescription($initial, $code, $key),
			'days' => $this->prepareDays($initial, $code),
		];

		return html_entity_decode(str_replace($input, $output, $this->config->get($this->m . '_quote_title_' . $code)));
	}

	protected function prepareImage($code, $name) {
		$image_name = explode('_', $code);

		return '<img src="' . ($this->request->server['HTTPS'] ? HTTPS_SERVER : HTTP_SERVER) . 'image/catalog/' . $this->m . '/small/' . $image_name[1] . '.png" >';
	}

	protected function prepareDays($initial, $code) {
		$add = $this->config->get($this->m . '_add_day_' . $code);

		if (isset($initial[$code]['pickup']['deliveryperiod'])) {
			$days = $initial[$code]['pickup']['deliveryperiod'];
		} elseif (isset($initial[$code]['pickup']['DeliveryPeriod'])) {
			$days = $initial[$code]['pickup']['DeliveryPeriod'];
		} else {
			$days = 0;
		}

		if ($days == 0) {
			if ($code == 'courier_grastin' || $code == 'pickup_grastin') {
				$days = 1;
			} elseif ($code == 'pickup_partner') {
				$days = 2;
			}
		}

		if (stripos($days, '-')) {
			$numbers = explode('-', $days);

			$last = $numbers[1];
			$days = implode('-', $numbers);
		} else {
			$last = $days;
		}

		if ($add > 0) {
			if (isset($numbers)) {
				$numbers[0] += $add;
				$numbers[1] += $add;
				
				if ($numbers[0] == $numbers[1]) {
					$days = $numbers[0];
				} else {
					$days = implode('-', $numbers);
				}

				$last = $numbers[1];
			} elseif (is_numeric($days)) {
				$days += $add;

				$last = $days;
			}
		}

		return $days > 0 ? $days . $this->numericСases($last) : 'уточняйте';
	}

	protected function prepareCost($result, $summa) {
		$costs = $this->config->get($this->m . '_costs_' . $result['number']);
		$price = (float)$result['shippingcost'] + (float)$result['additionalshippingcosts'];
		$price_total = $price;

		if (!empty($costs)) {
			foreach ($costs as $cost) {
				if ($summa >= $cost['cost']) {
					if ($cost['geo_zone_id']) {
						$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$cost['geo_zone_id'] . "' AND country_id = '" . (int)$this->address['country_id'] . "' AND (zone_id = '" . (int)$this->address['zone_id'] . "' OR zone_id = '0')");

						if (!$query->num_rows) {
							continue;
						}
					}

					if ($cost['city'] != '') {
						$city = mb_strtolower(trim($this->address['city']));

						if (stripos($cost['city'], ',')) {
							$cities = explode(',', $cost['city']);

							if (!in_array($city, $cities)) {
								continue;
							}
						} else {
							if ($city != $cost['city']) {
								continue;
							}
						}
					}

					switch ($cost['source']) {
						case 0:
							$value = (float)$cost['value'];
							break;
						case 1:
							$value = $summa * $cost['value'] / 100;
							break;
						case 2:
							$value = $price * $cost['value'] / 100;
							break;
					}

					switch ($cost['action']) {
						case '+':
							$price += $value;
							break;
						case '-':
							$price -= $value;
							break;
						case '=':
							$price = $value;
							break;
					}
				}

				if (!$cost['total']) {
					$price_total = $price;
				}
			}
		}

		return [
			'cost'       => $price < 0 ? 0 : $price,
			'cost_total' => $price_total < 0 ? 0 : $price_total
		];
	}

	protected function getPickupDescription($initial, $code, $key) {
		if (isset($initial[$code]['pickups'][$key]['drivingdescription'])) {
			if (is_array($initial[$code]['pickups'][$key]['drivingdescription'])) {
				if (!empty($initial[$code]['pickups'][$key]['drivingdescription'][0]) && isset($initial[$code]['pickups'][$key]['drivingdescription'][0])) {
					$description = $initial[$code]['pickups'][$key]['drivingdescription'][0];
				} else {
					$description = '';
				}
			} else {
				$description = $initial[$code]['pickups'][$key]['drivingdescription'];
			}
		} else {
			$description = '';
		}

		return $description;
	}

	protected function getBalloonContent($pickup, $code) {
		if ($code == 'pickup_grastin') {
			$content = '<i class="fa fa-map-marker fa-fw" style="color: green;"></i> ' . $pickup['address'];

			if (isset($pickup['metrostation'])) {
				if (is_array($pickup['metrostation'])) {
					if (!empty($pickup['metrostation'][0]) && isset($pickup['metrostation'][0])) {
						$content .= '<br><i class="fa fa-subway fa-fw" style="color: green;"></i> ' . $pickup['metrostation'][0];
					}
				} else {
					$content .= '<br><i class="fa fa-subway fa-fw" style="color: green;"></i> ' . $pickup['metrostation'];
				}
			}

			$content .= '<br><i class="fa fa-clock-o fa-fw" style="color: green;"></i> ' . $pickup['timetable'];
			$content .= is_array($pickup['phone']) ? '' : '<br><i class="fa fa-phone fa-fw" style="color: green;"></i> ' . $pickup['phone'];
			$content .= $pickup['paymentcard'] ? '<br><i class="fa fa-credit-card fa-fw" style="color: green;"></i> ' . $this->language->get('text_paymentcard') : '';
			$content .= $pickup['dressingroom'] ? '<br><i class="fa fa-black-tie fa-fw" style="color: green;"></i> ' . $this->language->get('text_dressingroom') : '';

			if (isset($pickup['drivingdescription'])) {
				if (is_array($pickup['drivingdescription'])) {
					if (!empty($pickup['drivingdescription'][0]) && isset($pickup['drivingdescription'][0])) {
						$description = $pickup['drivingdescription'][0];
					}
				} else {
					$description = $pickup['drivingdescription'];
				}
			}

			$content .= isset($description) ? '<br><i class="fa fa-map-o fa-fw" style="color: green;"></i> ' . $description : '';
		} elseif ($code == 'pickup_boxberry') {
			$content = '<i class="fa fa-map-marker fa-fw" style="color: green;"></i> ' . $pickup['Name'];
			$content .= '<br><i class="fa fa-clock-o fa-fw" style="color: green;"></i> ' . $pickup['schedule'];
			$content .= $pickup['acquiring'] ? '<br><i class="fa fa-credit-card fa-fw" style="color: green;"></i> ' . $this->language->get('text_paymentcard') : '';
			if (isset($pickup['drivingdescription'])) {
				if (is_array($pickup['drivingdescription'])) {
					if (!empty($pickup['drivingdescription'][0]) && isset($pickup['drivingdescription'][0])) {
						$description = $pickup['drivingdescription'][0];
					}
				} else {
					$description = $pickup['drivingdescription'];
				}
			}

			$content .= isset($description) ? '<br><i class="fa fa-map-o fa-fw" style="color: green;"></i> ' . $description : '';
		} elseif ($code == 'pickup_partner') {
			$content = '<i class="fa fa-map-marker fa-fw" style="color: green;"></i> ' . $pickup['addres'];
			$content .= !empty($pickup['metrostation']) ? '<br><i class="fa fa-subway fa-fw" style="color: green;"></i> ' . $pickup['metrostation'] : '';
			$content .= '<br><i class="fa fa-clock-o fa-fw" style="color: green;"></i> ' . $pickup['schedule'];
			$content .= is_array($pickup['phone']) ? '' : '<br><i class="fa fa-phone fa-fw" style="color: green;"></i> ' . $pickup['phone'];
			$content .= $pickup['paymentcard'] ? '<br><i class="fa fa-credit-card fa-fw" style="color: green;"></i> ' . $this->language->get('text_paymentcard') : '';

			if (isset($pickup['drivingdescription'])) {
				if (is_array($pickup['drivingdescription'])) {
					if (!empty($pickup['drivingdescription'][0]) && isset($pickup['drivingdescription'][0])) {
						$description = $pickup['drivingdescription'][0];
					}
				} else {
					$description = $pickup['drivingdescription'];
				}
			}

			$content .= isset($description) ? '<br><i class="fa fa-map-o fa-fw" style="color: green;"></i> ' . $description : '';
		} else {
			$content = '<i class="fa fa-map-marker fa-fw" style="color: green;"></i> ' . $pickup['name'];
		}

		return $content;
	}

	protected function prepareMap($initial, $code) {
		$pickup_id = $this->getActivePickupId($code);

		if (isset($initial[$code]['pickups']) && !empty($initial[$code]['pickups'])) {
			foreach ($initial[$code]['pickups'] as $key => $pickup) {
				$id = isset($pickup['Id']) ? $pickup['Id'] : $pickup['id'];
				$name = isset($pickup['Name']) ? $pickup['Name'] : '';
				$name = $code == 'pickup_partner' ? $pickup['addres'] : $name;
				$image = $this->prepareImage($code, $name);
				$desc = $this->getPickupDescription($initial, $code, $key);

				$hintContent = $image . ' ' . $name;
				$balloonContentHeader = $image . ' ' . $name;
				$balloonContentFooter = '<a class="btn btn-default btn-block" onclick="' . $this->m . '_set_pickup_id(\'' . $code . '\', \'' . $id . '\');">' . $this->language->get('text_choose_pickup') . '</a>';
				$balloonContentBody = $this->getBalloonContent($pickup, $code);

				$this->pickups['data']['features'][] = [
					'type'     => 'Feature',
					'id'       => $id,
					'geometry' => [
						'type'        => 'Point',
						'coordinates' => [
							$pickup['latitude'],
							$pickup['longitude'],
						]
					],
					'properties' => [
						'hintContent'          => $hintContent,
						'balloonContentHeader' => $balloonContentHeader,
						'balloonContentBody'   => $balloonContentBody,
						'balloonContentFooter' => $balloonContentFooter,
					],
					'options' => [
						'preset' => $id === $pickup_id ? $this->point_active_colors[$code] : $this->point_colors[$code],
					],
					'params' => [
						'code' => $code,
					]
				];

				if (!isset($this->pickups['delivery'][$code])) {
					$this->pickups['delivery'][$code] = [
						'code'    => $code,
						'content' => '<img src="' . ($this->request->server['HTTPS'] ? HTTPS_SERVER : HTTP_SERVER) . 'image/catalog/' . $this->m . '/middle/' . explode('_', $code)[1] . '.png" id="' . $this->m . '_filter_' . $code . '" >',
						'title'   => $this->language->get('text_filter_' . $code),
					];
				}
			}
		}
	}

	protected function getActivePickupId($code) {
		if (isset($this->session->data[$this->m . '_' . $code])) {
			return $this->session->data[$this->m . '_' . $code];
		} else {
			return 0;
		}
	}

	protected function numericСases($num, $word = [' день', ' дня', ' дней']) {
		return $word[ ($num%100>4 && $num%100<20)? 2: [2, 0, 1, 1, 1, 2][min($num%10, 5)] ];
	}

	protected function upperFirst($str) {
		return mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1, mb_strlen($str));
	}

	protected function getCacheName($params = []) {
		$cache_name = '.';

		$data = array_merge(
			[
				$this->config->get('config_store_id'),
				$this->config->get($this->m . '_weight_class_id'),
				$this->config->get($this->m . '_default_weight'),
				$this->config->get($this->m . '_length_class_id'),
				$this->config->get($this->m . '_default_length'),
				$this->config->get($this->m . '_default_width'),
				$this->config->get($this->m . '_default_height'),
				$this->config->get($this->m . '_calc_type'),
				$this->config->get($this->m . '_min_weight'),
				$this->config->get($this->m . '_max_weight'),
				$this->config->get($this->m . '_min_total'),
				$this->config->get($this->m . '_max_total'),
			],
			$params
		);

		foreach ($data as $item) {
			$cache_name .= (int)$item . '.';
		}

		return $cache_name;
	}

	protected function getCache($method, $postfix = '') {
		if ($this->config->get($this->m . '_cache')) {
			return $this->cache->get($this->m . '.' . $method . '.' . base64_encode($postfix));
		}
	}

	protected function setCache($method, $postfix = '', $data) {
		if ($this->config->get($this->m . '_cache')) {
			$this->cache->set($this->m . '.' . $method . '.' . base64_encode($postfix), $data);
		}
	}

	protected function addLog($type, $method, $request, $response = []) {
		if ($this->config->get($this->m . '_logging')) {
			switch ($type) {
				case 0:
					$type = 'error';
					break;
				case 1:
					$type = 'success';
					break;
				case 2:
					$type = 'info';
					break;
			}

			$this->log->write('[' . $this->m . '][' . $type . '][' . $method . '][request:' . serialize($request) . '][response:' . serialize($response) . ']');
		}
	}
}
