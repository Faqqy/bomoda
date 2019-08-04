<?php 
class ControllerExtensionPaymentPickpoint2 extends Controller {
	private $error = array(); 
	 
	public function index() { 
		$this->load->language('extension/payment/pickpoint2');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pickpoint2', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			//$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['text_edit'] = $this->language->get('text_edit');
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
				
		$data['entry_order_status'] = $this->language->get('entry_order_status');		
		$data['entry_total'] = $this->language->get('entry_total');	
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/payment/pickpoint2', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('extension/payment/pickpoint2', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');	
		
		if (isset($this->request->post['pickpoint2_total'])) {
			$data['pickpoint2_total'] = $this->request->post['pickpoint2_total'];
		} else {
			$data['pickpoint2_total'] = $this->config->get('pickpoint2_total'); 
		}
				
		if (isset($this->request->post['pickpoint2_order_status_id'])) {
			$data['pickpoint2_order_status_id'] = $this->request->post['pickpoint2_order_status_id'];
		} else {
			$data['pickpoint2_order_status_id'] = $this->config->get('pickpoint2_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['pickpoint2_geo_zone_id'])) {
			$data['pickpoint2_geo_zone_id'] = $this->request->post['pickpoint2_geo_zone_id'];
		} else {
			$data['pickpoint2_geo_zone_id'] = $this->config->get('pickpoint2_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');						
		
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['pickpoint2_status'])) {
			$data['pickpoint2_status'] = $this->request->post['pickpoint2_status'];
		} else {
			$data['pickpoint2_status'] = $this->config->get('pickpoint2_status');
		}
		
		if (isset($this->request->post['pickpoint2_sort_order'])) {
			$data['pickpoint2_sort_order'] = $this->request->post['pickpoint2_sort_order'];
		} else {
			$data['pickpoint2_sort_order'] = $this->config->get('pickpoint2_sort_order');
		}
				

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/pickpoint2.tpl', $data));


	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/pickpoint2')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
				
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
