<?php
class ControllerExtensionModuleVisitedproduct extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/visitedproduct');

		$data['heading_title'] = $this->language->get('heading_title');

		$this->load->model('catalog/category');

		$this->load->model('catalog/product');
		
		$this->load->model('tool/image');
		
		$data['products'] = array();
		
		if(isset($this->session->data['products_id']))
			$this->session->data['products_id'] = array_slice($this->session->data['products_id'], -$setting['limit']);

		if (isset($this->session->data['products_id'])) {
			foreach ($this->session->data['products_id'] as $result_id) {
				$result = $this->model_catalog_product->getProduct($result_id);

				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
				} 
				
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
				} else {
					$rating = false;
				}
				if(utf8_strlen($result['name']) < 80){
					$sub_name = $result['name'];
				}else{
					$sub_name = utf8_substr($result['name'], 0, 80) . '..';
				}


				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
                    'full_image'       => $result['image'],
					'name'        => $sub_name ,
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}
		}
		
		if ($data['products']) {
			return $this->load->view('extension/module/visitedproduct', $data);
		}
	}
}