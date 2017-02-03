<?php
class ControllerModuleFBMessenger extends Controller {
	
	/*public function __construct(){
		parent::__construct($setting);
	}*/
	
	public function index($setting) {
		$this->load->language('module/fb_messenger');
		$data['heading_title'] = $this->language->get('heading_title');
		$this->load->model('setting/setting');
		$data['fb_messenger'] = array();
		$data['fb_messenger'] = $this->config->get('fb_messenger_user');
		//echo (DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/fb_messenger.tpl');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/fb_messenger.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/fb_messenger.tpl', $data);

		} else {
			return $this->load->view('default/template/module/fb_messenger.tpl', $data);

		}

	}
}