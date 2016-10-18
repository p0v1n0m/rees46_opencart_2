<?php
class ControllerModuleRees46 extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/rees46');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
		$this->load->model('extension/module');
		$this->load->model('localisation/language');
		$this->load->model('catalog/manufacturer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!empty($this->request->post['module'])) {
				foreach ($this->request->post['module'] as $key => $module) {
					if (!isset($module['module_id'])) {
						$module_data = $this->request->post['module'][$key];

						$module_data['module_id'] = $this->model_extension_module->addModule('rees46', $this->request->post['module'][$key]);

						$this->model_extension_module->editModule($module_data['module_id'], $module_data);
					} else {
						$this->model_extension_module->editModule($module['module_id'], $this->request->post['module'][$key]);
					}
				}
			}

			if (!empty($this->request->post['delete'])) {
				foreach ($this->request->post['delete'] as $delete) {
					$this->model_extension_module->deleteModule($delete);
				}
			}

			$this->model_setting_setting->editSetting('rees46', $this->request->post['setting']);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['tab_settings'] = $this->language->get('tab_settings');
		$data['tab_orders'] = $this->language->get('tab_orders');
		$data['tab_subscribers'] = $this->language->get('tab_subscribers');
		$data['tab_modules'] = $this->language->get('tab_modules');
		$data['tab_help'] = $this->language->get('tab_help');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_export'] = $this->language->get('button_export');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_tab_module'] = $this->language->get('text_tab_module');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_documentation_url'] = $this->language->get('text_documentation_url');
		$data['text_type_interesting'] = $this->language->get('text_type_interesting');
		$data['text_type_also_bought'] = $this->language->get('text_type_also_bought');
		$data['text_type_similar'] = $this->language->get('text_type_similar');
		$data['text_type_popular'] = $this->language->get('text_type_popular');
		$data['text_type_see_also'] = $this->language->get('text_type_see_also');
		$data['text_type_recently_viewed'] = $this->language->get('text_type_recently_viewed');
		$data['text_type_buying_now'] = $this->language->get('text_type_buying_now');
		$data['text_type_search'] = $this->language->get('text_type_search');
		$data['text_template_default'] = $this->language->get('text_template_default');
		$data['text_template_basic'] = $this->language->get('text_template_basic');
		$data['text_template_bestseller'] = $this->language->get('text_template_bestseller');
		$data['text_template_featured'] = $this->language->get('text_template_featured');
		$data['text_template_latest'] = $this->language->get('text_template_latest');
		$data['text_template_special'] = $this->language->get('text_template_special');
		$data['text_autocomplete'] = $this->language->get('text_autocomplete');
		$data['text_subscribers'] = $this->language->get('text_subscribers');
		$data['text_customers'] = $this->language->get('text_customers');
		$data['text_info_1'] = $this->language->get('text_info_1');
		$data['text_info_2'] = $this->language->get('text_info_2');
		$data['entry_shop_id'] = $this->language->get('entry_shop_id');
		$data['entry_secret_key'] = $this->language->get('entry_secret_key');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_export_orders'] = $this->language->get('entry_export_orders');
		$data['entry_export_subscribers'] = $this->language->get('entry_export_subscribers');
		$data['entry_export_type'] = $this->language->get('entry_export_type');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_template'] = $this->language->get('entry_template');
		$data['entry_css'] = $this->language->get('entry_css');
		$data['entry_discount'] = $this->language->get('entry_discount');
		$data['entry_brands'] = $this->language->get('entry_brands');
		$data['entry_exclude_brands'] = $this->language->get('entry_exclude_brands');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/rees46', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/rees46', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/rees46', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/rees46', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['rees46_shop_id'])) {
			$data['rees46_shop_id'] = $this->request->post['rees46_shop_id'];
		} else {
			$data['rees46_shop_id'] = $this->config->get('rees46_shop_id');
		}

		if (isset($this->request->post['rees46_secret_key'])) {
			$data['rees46_secret_key'] = $this->request->post['rees46_secret_key'];
		} else {
			$data['rees46_secret_key'] = $this->config->get('rees46_secret_key');
		}

		if (isset($this->request->post['rees46_tracking_status'])) {
			$data['rees46_tracking_status'] = $this->request->post['rees46_tracking_status'];
		} else {
			$data['rees46_tracking_status'] = $this->config->get('rees46_tracking_status');
		}

		if (isset($this->request->post['rees46_subscribers'])) {
			$data['rees46_subscribers'] = $this->request->post['rees46_subscribers'];
		} else {
			$data['rees46_subscribers'] = $this->config->get('rees46_subscribers');
		}

		if (isset($this->request->get['module_id'])) {
			$data['module_id'] = $this->request->get['module_id'];
		}

		$data['modules'] = array();

		$modules = $this->model_extension_module->getModulesByCode('rees46');

		if (!empty($modules)) {
			foreach ($modules as $module) {
				$setting = json_decode($module['setting'], true);

				$manufacturers = array();

				if (!empty($setting['manufacturers'])) {
					foreach ($setting['manufacturers'] as $manufacturer_id) {
						$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

						if ($manufacturer_info) {
							$manufacturers[] = array(
								'manufacturer_id' => $manufacturer_info['manufacturer_id'],
								'name'            => $manufacturer_info['name']
							);
						}
					}
				}

				$manufacturers_exclude = array();

				if (!empty($setting['manufacturers_exclude'])) {
					foreach ($setting['manufacturers_exclude'] as $manufacturer_id) {
						$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($manufacturer_id);

						if ($manufacturer_info) {
							$manufacturers_exclude[] = array(
								'manufacturer_id' => $manufacturer_info['manufacturer_id'],
								'name'            => $manufacturer_info['name']
							);
						}
					}
				}

				$data['modules'][] = array(
					'module_id'             => $module['module_id'],
					'name'                  => $module['name'],
					'setting'               => $setting,
					'manufacturers'         => $manufacturers,
					'manufacturers_exclude' => $manufacturers_exclude
				);

				$setting = '';
			}
		}

		sort($data['modules']);

		$data['module_row'] = 1;

		if (count($data['modules']) + 1 > $data['module_row']) {
			$data['module_row'] = count($data['modules']) + 1;
		}

		$data['token'] = $this->session->data['token'];
		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/rees46.tpl', $data));
	}

	public function exportOrders() {
		$this->load->language('module/rees46');

		$this->load->model('module/rees46');
		$this->load->model('catalog/product');

		$json = array();

		if ($this->validate()) {
			$next = $this->request->post['next'];
			$limit = 100;

			$filter_data = array(
				'start'             => ($next - 1) * $limit,
				'limit'             => $limit
			);

			if ($filter_data['start'] < 0) {
				$filter_data['start'] = 0;
			}

			$results_total = $this->model_module_rees46->getTotalOrders();

			$results = $this->model_module_rees46->getOrders($filter_data);

			$orders = array();

			foreach ($results as $result) {
				$order_products = array();

				$products = $this->model_module_rees46->getOrderProducts($result['order_id']);

				foreach ($products as $product) {
					$categories = array();

					$categories = $this->model_catalog_product->getProductCategories($product['product_id']);

					$order_products[] = array(
						'id'           => $product['product_id'],
						'price'        => $product['price'],
						'categories'   => $categories,
						'is_available' => $product['stock'],
						'amount'       => $product['quantity']
					);
				}

				$orders[] = array(
					'id'         => $result['order_id'],
					'user_id'    => $result['customer_id'],
					'user_email' => $result['email'],
					'date'       => strtotime($result['date_added']),
					'items'      => $order_products
				);
			}

			if (!empty($orders)) {
				$url = 'http://api.rees46.com/import/orders';

				$params['shop_id'] = $this->config->get('rees46_shop_id');
				$params['shop_secret'] = $this->config->get('rees46_secret_key');
				$params['orders'] = $orders;

				$data = $this->curl($url, json_encode($params, true));

				if ($data['info']['http_code'] < 200 || $data['info']['http_code'] >= 300) {
					$json['error'] = $data['info']['http_code'];
				} else {
					if ($results_total > $next * $limit) {
						$json['next'] = $next + 1;

						$json['success'] = sprintf($this->language->get('text_processing_orders'), $next * $limit ? $results_total : 0, $results_total);
					} else {
						$json['success'] = sprintf($this->language->get('text_success_orders'), $results_total, $results_total);
					}
				}
			} else {
				$json['error'] = $this->language->get('text_error_orders');
			}
		} else {
			$json['error'] = $this->language->get('error_permission');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function exportSubscribers() {
		$this->load->language('module/rees46');

		$this->load->model('customer/customer');

		$json = array();

		if ($this->validate()) {
			$next = $this->request->post['next'];
			$limit = 100;

			$filter_data = array(
				'start' => ($next - 1) * $limit,
				'limit' => $limit
			);

			if ($filter_data['start'] < 0) {
				$filter_data['start'] = 0;
			}

			if (!$this->config->get('rees46_subscribers')) {
				$filter_data['filter_newsletter'] = 1;
			}

			$results_total = $this->model_customer_customer->getTotalCustomers($filter_data);

			$results = $this->model_customer_customer->getCustomers($filter_data);

			$emails = array();

			foreach ($results as $result) {
				$emails[] = array(
					'id'    => $result['customer_id'],
					'email' => $result['email']
				);
			}

			if (!empty($emails)) {
				$url = 'http://api.rees46.com/import/audience';

				$params['shop_id'] = $this->config->get('rees46_shop_id');
				$params['shop_secret'] = $this->config->get('rees46_secret_key');
				$params['audience'] = $emails;

				$data = $this->curl($url, json_encode($params, true));

				if ($data['info']['http_code'] < 200 || $data['info']['http_code'] >= 300) {
					$json['error'] = $data['info']['http_code'];
				} else {
					if ($results_total > $next * $limit) {
						$json['next'] = $next + 1;

						$json['success'] = sprintf($this->language->get('text_processing_subscribers'), $next * $limit ? $results_total : 0, $results_total);
					} else {
						$json['success'] = sprintf($this->language->get('text_success_subscribers'), $results_total, $results_total);
					}
				}
			} else {
				$json['error'] = $this->language->get('text_error_subscribers');
			}
		} else {
			$json['error'] = $this->language->get('error_permission');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function curl($url, $params) {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

		$data['result'] = curl_exec($ch);
		$data['info'] = curl_getinfo($ch);

		curl_close($ch);

		return $data;
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/rees46')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}