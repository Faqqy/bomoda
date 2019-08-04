<?php
class ControllerExtensionPaymentBBPayment extends Controller {

    public function index() {
        $data['button_confirm'] = $this->language->get('button_confirm');

        $data['continue'] = $this->url->link('checkout/success');

	$data['text_loading'] = $this->language->get('text_loading');

	return $this->load->view('extension/payment/bb', $data);
    }

    public function confirm() {
        if ($this->session->data['payment_method']['code'] == 'bb_payment') {
            $this->load->model('checkout/order');

            $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('bb_payment_order_status_id'));
        }
    }
}
?>