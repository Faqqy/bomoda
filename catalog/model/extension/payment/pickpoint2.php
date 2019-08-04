<?php 
class ModelExtensionPaymentPickpoint2 extends Model {

  	public function getMethod($address, $total) {
		$this->load->language('extension/payment/pickpoint2');
		
		if (isset($this->session->data['shipping_method']['code']))
			$shipping_method = $this->session->data['shipping_method']['code'];
		else
			$shipping_method = "";

		if (strstr($shipping_method, 'pickpoint')==false) {
		        $status = false;
		} else {
		        $status = true;
		}

		
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'code'       => 'pickpoint2',
        		'title'      =>  $this->language->get('text_title'),
			'terms'      => '',
			'sort_order' => $this->config->get('pickpoint2_sort_order')
      		);
    	}
   
    	return $method_data;
  	}
}
