<?php
class ControllerExtensionModuleYoMenu extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/yo_menu');
		$this->load->model('extension/module');

		$this->document->setTitle($this->language->get('module_title'));

		if (!isset($this->request->get['module_id'])) {
			$data['apply_btn'] = false;
		} else {
			$data['apply_btn'] = true;
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('yo_menu', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			if ($this->request->post['apply']) {
				$this->session->data['success'] = $this->language->get('text_apply');
				$this->response->redirect($this->url->link('extension/module/yo_menu', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true));
			} else {
				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
			}
		}

		$data['heading_title'] = $this->language->get('module_title');
		$data['default_store'] = $this->config->get('config_name');
		$data['version'] = 'v2.0';

		$data['text_author'] = $this->language->get('text_author');
		$data['text_author_link'] = $this->language->get('text_author_link');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_more'] = $this->language->get('text_more');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_show'] = $this->language->get('text_show');
		$data['text_hide'] = $this->language->get('text_hide');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_keep'] = $this->language->get('text_keep');
		$data['text_hide_current'] = $this->language->get('text_hide_current');
		$data['text_select'] = $this->language->get('text_select');

		$data['text_expanded'] = $this->language->get('text_expanded');
		$data['text_minimized'] = $this->language->get('text_minimized');
		$data['text_center'] = $this->language->get('text_center');
		$data['text_left'] = $this->language->get('text_left');
		$data['text_right'] = $this->language->get('text_right');
		$data['text_notlimited'] = $this->language->get('text_notlimited');

		$data['text_allcats'] = $this->language->get('text_allcats');
		$data['text_all_brands'] = $this->language->get('text_all_brands');
		$data['text_all_customers'] = $this->language->get('text_all_customers');

		$data['text_cats'] = $this->language->get('text_cats');
		$data['text_brands'] = $this->language->get('text_brands');
		$data['text_current'] = $this->language->get('text_current');
		$data['text_main'] = $this->language->get('text_main');

		$data['text_level_1'] = $this->language->get('text_level_1');
		$data['text_level_2'] = $this->language->get('text_level_2');
		$data['text_level_3'] = $this->language->get('text_level_3');
		$data['text_level_4'] = $this->language->get('text_level_4');
		$data['text_level_5'] = $this->language->get('text_level_5');

		$data['text_am'] = $this->language->get('text_am');
		$data['text_pm'] = $this->language->get('text_pm');
		$data['text_fm'] = $this->language->get('text_fm');

		$data['text_list_view'] = $this->language->get('text_list_view');
		$data['text_grid_view'] = $this->language->get('text_grid_view');
		$data['text_mix_view'] = $this->language->get('text_mix_view');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_box_class'] = $this->language->get('entry_box_class');
		$data['entry_title_class'] = $this->language->get('entry_title_class');
		$data['entry_content_class'] = $this->language->get('entry_content_class');
		$data['entry_css'] = $this->language->get('entry_css');
		$data['entry_show_cat'] = $this->language->get('entry_show_cat');
		$data['entry_customers'] = $this->language->get('entry_customers');
		$data['entry_count'] = $this->language->get('entry_count');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_menu_type'] = $this->language->get('entry_menu_type');
		$data['entry_menu_items'] = $this->language->get('entry_menu_items');
		$data['entry_products_byitem'] = $this->language->get('entry_products_byitem');
		$data['entry_products_limit'] = $this->language->get('entry_products_limit');
		$data['entry_levels'] = $this->language->get('entry_levels');
		$data['entry_sub_limit'] = $this->language->get('entry_sub_limit');

		$data['entry_menu_design'] = $this->language->get('entry_menu_design');
		$data['entry_minimized'] = $this->language->get('entry_minimized');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_image_position'] = $this->language->get('entry_image_position');
		$data['entry_column'] = $this->language->get('entry_column');
		$data['entry_content'] = $this->language->get('entry_content');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_icon'] = $this->language->get('entry_icon');
		$data['entry_toggle'] = $this->language->get('entry_toggle');
		$data['entry_effect'] = $this->language->get('entry_effect');

		$data['help_categories'] = $this->language->get('help_categories');
		$data['help_html'] = $this->language->get('help_html');

		$data['button_apply'] = $this->language->get('button_apply');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_menu_setting'] = $this->language->get('tab_menu_setting');
		$data['tab_module_setting'] = $this->language->get('tab_module_setting');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->get['module_id'])) {
			$data['module_id'] = $this->request->get['module_id'];
		} else {
			$data['module_id'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/yo_menu', 'token=' . $this->session->data['token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/yo_menu', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true)
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/yo_menu', 'token=' . $this->session->data['token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/yo_menu', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true);
		}

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = 1;
		}

		if (isset($this->request->post['style'])) {
			$data['style'] = $this->request->post['style'];
		} elseif (!empty($module_info)) {
			$data['style'] = $module_info['style'];
		} else {
			$data['style'] = '';
		}

		$data['yo_module'] = array();

		if (isset($this->request->post['yo_module'])) {
			$data['yo_module'] = $this->request->post['yo_module'];
		} elseif (!empty($module_info)) {
			$data['yo_module'] = $module_info['yo_module'];
		} else {
			$data['yo_module']['store_id'][] = 0;
			$data['yo_module']['all_customers'] = 1;
			$data['yo_module']['allcats'] = 1;
			$data['yo_module']['cat_invert'] = 1;
		}

		$data['yomenu'] = array();

		if (isset($this->request->post['yomenu'])) {
			$data['yomenu'] = $this->request->post['yomenu'];
		} elseif (!empty($module_info)) {
			$data['yomenu'] = $module_info['yomenu'];
		} else {
			$data['yomenu']['allcats'] = 1;
			$data['yomenu']['allbrands'] = 1;
			$data['yomenu']['level_2'] = 1;
			$data['yomenu']['level_3'] = 1;
			$data['yomenu']['item_image'] = 1;
			$data['yomenu']['item_icon'] = 1;
		}

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		$this->load->model('setting/store');
		$data['stores'] = $this->model_setting_store->getStores();

		$this->load->model('catalog/category');
		$data['categories'] = array();

		if (!empty($this->request->post['yomenu']['featured_category'])) {
			$categories = $this->request->post['yomenu']['featured_category'];
		} elseif (!empty($module_info) && !empty($module_info['yomenu']['featured_category'])) {
			$categories = $module_info['yomenu']['featured_category'];
		} else {
			$categories = array();
		}

		foreach ($categories as $category_id) {
			$category_info = $this->model_catalog_category->getCategory($category_id);

			if ($category_info) {
				$data['categories'][] = array(
					'category_id' => $category_info['category_id'],
					'name'        => $category_info['path'] ? $category_info['path'] . ' - &gt; ' . $category_info['name'] : $category_info['name']
					);
			}
		}

		$data['catlocs'] = array();

		if (!empty($this->request->post['yo_module']['fcid'])) {
			$catlocs = $this->request->post['yo_module']['fcid'];
		} elseif (!empty($module_info) && !empty($module_info['yo_module']['fcid'])) {
			$catlocs = $module_info['yo_module']['fcid'];
		} else {
			$catlocs = array();
		}

		foreach ($catlocs as $category) {
			$category_info = $this->model_catalog_category->getCategory($category);

			if ($category_info) {
				$data['catlocs'][] = array(
					'category_id' => $category_info['category_id'],
					'name'        => $category_info['path'] ? $category_info['path'] . ' - &gt; ' . $category_info['name'] : $category_info['name']
				);
			}
		}

		$this->load->model('catalog/manufacturer');
		$data['manufacturers'] = array();

		if (!empty($this->request->post['yomenu']['featured_brands'])) {
			$manufacturers = $this->request->post['yomenu']['featured_brands'];
		} elseif (!empty($module_info) && !empty($module_info['yomenu']['featured_brands'])) {
			$manufacturers = $module_info['yomenu']['featured_brands'];
		} else {
			$manufacturers = array();
		}

		foreach ($manufacturers as $brand_id) {
			$brand_info = $this->model_catalog_manufacturer->getManufacturer($brand_id);

			if ($brand_info) {
				$data['manufacturers'][] = array(
					'manufacturer_id' => $brand_info['manufacturer_id'],
					'name'            => $brand_info['name']
					);
			}
		}

		$this->load->model('yomenu/yo_menu');
		$data['customer_groups'] = $this->model_yomenu_yo_menu->getCustomerGroups();

		$data['sorts'] = array();

		$data['sorts'][] = array(
			'name'  => $this->language->get('text_default_asc'),
			'value' => 'p.sort_order-ASC'
			);

		$data['sorts'][] = array(
			'name'  => $this->language->get('text_viewed_asc'),
			'value' => 'p.viewed-DESC'
			);

		if ($this->config->get('config_review_status')) {
			$data['sorts'][] = array(
				'name'  => $this->language->get('text_rating_desc'),
				'value' => 'rating-DESC'
				);
		}

		$data['sorts'][] = array(
			'name'  => $this->language->get('text_date_desc'),
			'value' => 'p.date_added-DESC'
			);

		$data['sorts'][] = array(
			'name'  => $this->language->get('text_name_asc'),
			'value' => 'pd.name-ASC'
			);

		$data['sorts'][] = array(
			'name'  => $this->language->get('text_name_desc'),
			'value' => 'pd.name-DESC'
			);

		$data['sorts'][] = array(
			'name'  => $this->language->get('text_price_asc'),
			'value' => 'p.price-ASC'
			);

		$data['sorts'][] = array(
			'name'  => $this->language->get('text_price_desc'),
			'value' => 'p.price-DESC'
			);

		$data['easings'] = array('linear', 'swing', 'easeInQuad', 'easeOutQuad', 'easeInOutQuad', 'easeInCubic', 'easeOutCubic', 'easeInOutCubic', 'easeInQuart', 'easeOutQuart', 'easeInOutQuart', 'easeInQuint', 'easeOutQuint', 'easeInOutQuint', 'easeInExpo', 'easeOutExpo', 'easeInOutExpo', 'easeInSine', 'easeOutSine', 'easeInOutSine', 'easeInCirc', 'easeOutCirc', 'easeInOutCirc', 'easeInElastic', 'easeOutElastic', 'easeInOutElastic', 'easeInBack', 'easeOutBack', 'easeInOutBack', 'easeInBounce', 'easeOutBounce', 'easeInOutBounce');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/yo_menu', $data));
	}

	public function install() {
		$image = $this->db->query("DESC `" . DB_PREFIX . "category` `yomenu_image`");
		if (!$image->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "category` ADD `yomenu_image` varchar(255) NULL AFTER image");
		}

		$icon = $this->db->query("DESC `" . DB_PREFIX . "category` `yomenu_icon`");
		if (!$icon->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "category` ADD `yomenu_icon` varchar(255) NULL AFTER image");
		}

		$content = $this->db->query("DESC `" . DB_PREFIX . "category` `yomenu_content`");
		if (!$content->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "category` ADD `yomenu_content` TEXT NOT NULL");
		}

		$brand_image = $this->db->query("DESC `" . DB_PREFIX . "manufacturer` `yomenu_image`");
		if (!$brand_image->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "manufacturer` ADD `yomenu_image` varchar(255) NULL AFTER image");
		}

		$brand_icon = $this->db->query("DESC `" . DB_PREFIX . "manufacturer` `yomenu_icon`");
		if (!$brand_icon->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "manufacturer` ADD `yomenu_icon` varchar(255) NULL AFTER image");
		}

		$brand_content = $this->db->query("DESC `" . DB_PREFIX . "manufacturer` `yomenu_content`");
		if (!$brand_content->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "manufacturer` ADD `yomenu_content` TEXT NOT NULL");
		}
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/yo_menu')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		return !$this->error;
	}
}