<?php
class ControllerModuleFBMessenger extends Controller {
	private $errors = array();

	public function __construct($setting) {
		parent::__construct($setting);
	}

	public function index() {
		$this->load->language('module/fb_messenger');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('module/fb_messenger');
		$this->load->model('setting/setting');
		/* 
		 * Date Added: 03.02.17
		 * Author: HAIHN
		 * Sigle: 1.0.0
		 * Description:
			 * Load Style Bootsrap Switch.
			 * CSS , JS style for Facebook Messenger.
		 */
		$this->document->addScript( 'view/template/module/fb_messenger/bootstrap-switch/bootstrap-switch.min.js');
		$this->document->addStyle( 'view/template/module/fb_messenger/bootstrap-switch/bootstrap-switch.min.css');


		if (isset($this->request->post['fb_messenger_user'])) {
			$data['fb_messenger_user'] = $this->request->post['fb_messenger_user'];
		} else {
			$data['fb_messenger_user'] = $this->config->get('fb_messenger_user');
		}

		if (isset($this->request->post['fb_messenger_status'])) {
			$data['fb_messenger_status'] = $this->request->post['fb_messenger_status'];
		} else {
			$data['fb_messenger_status'] = $this->config->get('fb_messenger_status');
		}

		if (isset($this->request->post['fb_messenger_postion'])) {
			$data['fb_messenger_status'] = $this->request->post['fb_messenger_postion'];
		} else {
			$data['fb_messenger_postion'] = $this->fb_messenger_check_position($this->config->get('fb_messenger_postion'));
		}

		if (isset($this->request->post['fb_messenger_display'])) {
			$data['fb_messenger_display'] = $this->request->post['fb_messenger_display'];
		} else {
			$data['fb_messenger_display'] = $this->config->get('fb_messenger_display');
		}

		if (isset($this->request->post['fb_messenger_app'])) {
			$data['fb_messenger_app'] = $this->request->post['fb_messenger_app'];
		} else {
			$data['fb_messenger_app'] = $this->config->get('fb_messenger_app');
		}

		if (isset($this->request->post['fb_messenger_chili_position'])) {
			$data['fb_messenger_chili_position'] = $this->request->post['fb_messenger_chili_position'];
		} else {
			$data['fb_messenger_chili_position'] = $this->config->get('fb_messenger_chili_position');
		}

		if (isset($this->request->post['fb_messenger_type'])) {
			$data['fb_messenger_type'] = $this->request->post['fb_messenger_type'];
		} else {
			$data['fb_messenger_type'] = $this->config->get('fb_messenger_type');
		}

		if (isset($this->request->post['fb_messenger_hide_display'])) {
			$data['fb_messenger_hide_display'] = $this->request->post['fb_messenger_hide_display'];
		} else {
			$data['fb_messenger_hide_display'] = $this->config->get('fb_messenger_hide_display');
		}

		if (isset($this->request->post['fb_messenger_app_text'])) {
			$data['fb_messenger_app_text'] = $this->request->post['fb_messenger_app_text'];
		} else {
			$data['fb_messenger_app_text'] = $this->config->get('fb_messenger_app_text');
		}

		if (isset($this->request->post['fb_messenger_chat_facebook_display'])) {
			$data['fb_messenger_chat_facebook_display'] = $this->request->post['fb_messenger_chat_facebook_display'];
		} else {
			$data['fb_messenger_chat_facebook_display'] = $this->config->get('fb_messenger_chat_facebook_display');
		}

		if (isset($this->request->post['fb_messenger_text_botton'])) {
			$data['fb_messenger_text_botton'] = $this->request->post['fb_messenger_text_botton'];
		} else {
			$data['fb_messenger_text_botton'] = $this->config->get('fb_messenger_text_botton');
		}

		if (isset($this->request->post['fb_messenger_text_img'])) {
			$data['fb_messenger_text_img'] = $this->request->post['fb_messenger_text_img'];
		} else {
			$data['fb_messenger_text_img'] = $this->config->get('fb_messenger_text_img');
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_module_fb_messenger->editSetting('fb_messenger', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('module/fb_messenger', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] 	= $this->language->get('heading_title');

		$data['text_edit'] 		= $this->language->get('text_edit');
		$data['text_enabled'] 	= $this->language->get('text_enabled');
		$data['text_disabled'] 	= $this->language->get('text_disabled');
		$data['entry_status'] 	= $this->language->get('entry_status');

		$data['entry_fb_messenger_user'] 			= $this->language->get('entry_fb_messenger_user');
		$data['entry_fb_messenger_backgroud'] 		= $this->language->get('entry_fb_messenger_backgroud');
		$data['entry_fb_messenger_lang'] 			= $this->language->get('entry_fb_messenger_lang');
		$data['entry_fb_messenger_display'] 		= $this->language->get('entry_fb_messenger_display');
		$data['entry_fb_messenger_app'] 			= $this->language->get('entry_fb_messenger_app');
		$data['entry_fb_messenger_chili_position'] 	= $this->language->get('entry_fb_messenger_chili_position');
		$data['entry_fb_messenger_postion'] 		= $this->language->get('entry_fb_messenger_postion');
		$data['entry_fb_messenger_type'] 			= $this->language->get('entry_fb_messenger_type');
		$data['entry_fb_messenger_hide_display'] 	= $this->language->get('entry_fb_messenger_hide_display');
		$data['entry_fb_messenger_app_text'] 		= $this->language->get('entry_fb_messenger_app_text');
		$data['entry_fb_messenger_text_img'] 		= $this->language->get('entry_fb_messenger_text_img');
		$data['entry_fb_messenger_text_botton'] 	= $this->language->get('entry_fb_messenger_text_botton');
		$data['entry_fb_messenger_chat_facebook_display'] 	= $this->language->get('entry_fb_messenger_chat_facebook_display');

		$data['fb_messenger_display_text']	= array(
			'Ẩn tất cả',
			'Sử dụng tiêu đề nhỏ',
			'Sử dụng tiêu đề lớn'
		);
		$data['entry_tab_fb_chat'] 			= $this->language->get('entry_tab_fb_chat');
		$data['entry_tab_fb_messenger'] 	= $this->language->get('entry_tab_fb_messenger');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->errors['warning'];
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

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/fb_messenger', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['action'] = $this->url->link('module/fb_messenger', 'token=' . $this->session->data['token'], 'SSL');


		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/fb_messenger.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/fb_messenger')) {
			$this->errors['warning'] = $this->language->get('error_permission');
		}

		return !$this->errors;
	}

	/* Install
	*/
	public function install(){
		
	}

	/* Uninstall
	*/
	public function uninstall(){
		
	}

	/*
	 * Check Position FB Messenger.
	 */
	private function fb_messenger_check_position( $post_input = NULL ) {
		if ( $post_input ) {
			$post_input = $post_input;
		} else{
			$post_input = 'off';
		}
		return $post_input;
	}
}