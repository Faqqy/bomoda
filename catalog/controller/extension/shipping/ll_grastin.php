<?php
/**
 * @author    p0v1n0m <p0v1n0m@gmail.com>
 * @license   Commercial
 * @link      https://github.com/p0v1n0m
 */
class ControllerExtensionShippingLLgrastin extends Controller {
	private $m = 'll_grastin';
	private $map = 'https://api-maps.yandex.ru/2.1?lang=ru_RU&apikey=';
	private $checkouts = [
		'checkout/checkout',
		'checkout/simplecheckout',
		'checkout/oct_fastorder',
		'checkout/newstorecheckout',
		'checkout/uni_checkout',
		'extension/module/qnec',
	];

	public function addCheckoutJs(&$route, &$data = null, &$output = null) {
		if ($this->config->get($this->m . '_status') && isset($this->request->get['route']) && in_array((string)$this->request->get['route'], $this->checkouts)) {
			$this->document->addScript($this->map . $this->config->get($this->m . '_map_key'));
			$this->document->addScript('catalog/view/javascript/' . $this->m . '/' . $this->m . '.js');
		}
	}

	public function setPickupId() {
		if (isset($this->request->post['code']) && isset($this->request->post['id'])) {
			if (isset($this->request->get['token'])) {
				$this->db->query("DELETE FROM `" . DB_PREFIX . "api_session` WHERE TIMESTAMPADD(HOUR, 1, date_modified) < NOW()");

				$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "api` `a` LEFT JOIN `" . DB_PREFIX . "api_session` `as` ON (a.api_id = as.api_id) LEFT JOIN " . DB_PREFIX . "api_ip `ai` ON (as.api_id = ai.api_id) WHERE a.status = '1' AND as.token = '" . $this->db->escape($this->request->get['token']) . "' AND ai.ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");
			
				if ($query->num_rows) {
					$this->session->start('api', $query->row['session_id']);

					$this->db->query("UPDATE `" . DB_PREFIX . "api_session` SET date_modified = NOW() WHERE api_session_id = '" . (int)$query->row['api_session_id'] . "'");
				}
			}

			$this->session->data[$this->m . '_' . $this->request->post['code']] = $this->request->post['id'];
		}
	}
}
