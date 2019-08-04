<?php
class ControllerExtensionShippingPickpoint extends Controller {
	public function export() {
		$this->load->model('extension/shipping/pickpoint');
		$results = $this->model_extension_shipping_pickpoint->export(); 
	}

	public function setprice() {
		$this->load->model('extension/shipping/pickpoint');
		return $this->model_extension_shipping_pickpoint->setprice(); 
	}

}