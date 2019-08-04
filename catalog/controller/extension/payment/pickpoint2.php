<?php
class ControllerExtensionPaymentPickpoint2 extends Controller {
	public function index() {

		$data['text_loading'] = $this->language->get('text_loading');
		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['continue'] = $this->url->link('checkout/success');

		return $this->load->view('extension/payment/pickpoint2', $data);
		
	}
	
	public function confirm() {
		$this->load->model('checkout/order');		
		$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('pickpoint2_order_status_id'));
	}
}


