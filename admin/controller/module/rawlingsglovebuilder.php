<?php
/*
 * @support
 * http://www.opensourcetechnologies.com/contactus.html
 * sales@opensourcetechnologies.com
* */
class ControllerModuleRawlingsGloveBuilder extends Controller {
	private $error = array(); 
	public $data=array(); 
	public function index() {   
		$this->load->language('module/rawlingsglovebuilder');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$this->model_setting_setting->editSetting('rawlingsglovebuilder', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
			
						
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_embed_code'] = $this->language->get('entry_embed_code');

               
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
                

		
		
		
		$this->data['token'] = $this->session->data['token'];

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->error['embed_code'])) {
			$this->data['error_embed_code'] = $this->error['embed_code'];
		} else {
			$this->data['error_embed_code'] = '';
		}
		

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/rawlingsglovebuilder', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/rawlingsglovebuilder', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['modules'] = array();
		
		
		if (isset($this->request->post['rawlingsglovebuilder_status'])) {
			$this->data['rawlingsglovebuilder_status'] = $this->request->post['rawlingsglovebuilder_status'];
		} else {
			$this->data['rawlingsglovebuilder_status'] = $this->config->get('rawlingsglovebuilder_status');
		}
		if (isset($this->request->post['rawlingsglovebuilder_embed_code'])) {
			$this->data['rawlingsglovebuilder_embed_code'] = $this->request->post['rawlingsglovebuilder_embed_code'];
		} else {
			$this->data['rawlingsglovebuilder_embed_code'] = $this->config->get('rawlingsglovebuilder_embed_code');
		}
        	if (isset($this->request->post['rawlingsglovebuilder_sort_order'])) {
			$this->data['rawlingsglovebuilder_sort_order'] = $this->request->post['rawlingsglovebuilder_sort_order'];
		} else {
			$this->data['rawlingsglovebuilder_sort_order'] = $this->config->get('rawlingsglovebuilder_sort_order');
		}
		
		     
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
        		
		//$this->response->setOutput($this->render());
		$this->data['header'] = $this->load->controller('common/header');
		$this->data['column_left'] = $this->load->controller('common/column_left');
		$this->data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/rawlingsglovebuilder.tpl', $this->data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/rawlingsglovebuilder')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->request->post['rawlingsglovebuilder_embed_code']) {
			$this->error['embed_code'] = $this->language->get('error_embed_code');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>
