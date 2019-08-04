<?php
class ModelExtensionShippingPickpoint extends Model {
	public function install() {

		$sql  = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."pickpoint` ( ";
		$sql .= " `pickpoint_id` int(11) NOT NULL AUTO_INCREMENT,";
		$sql .= " `order_id` int(11) NOT NULL,";
 		$sql .= " `pickpoint_order` varchar(250) NOT NULL,";
		$sql .= " `terminal_id` varchar(250) NOT NULL, ";
		$sql .= " `terminal_address` varchar(1024) NOT NULL, ";
		$sql .= " PRIMARY KEY (`pickpoint_id`) ";
		$sql .= ") ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;";
		$this->db->query($sql);

	}

	protected function get_curl_post($url, $data) {
		//$this->log->write('get_curl_post '. print_r($data,1));

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
	
		//curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	
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
			
		//curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	
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

  	public function getPostamatList($pickpoint_url) {

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


}