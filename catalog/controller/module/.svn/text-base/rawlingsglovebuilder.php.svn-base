<?php
/*
 * @support
 * http://www.opensourcetechnologies.com/contactus.html
 * sales@opensourcetechnologies.com
* */
class ControllerModuleRawlingsGloveBuilder extends Controller {
	public function index() {
                $fields=array();
                foreach($_REQUEST as $var=>$val)
		{
			$fields[]=str_replace("-","_",$var).' = "'.$this->db->escape($val).'"';
		}
                $fields_string=implode(',',$fields);
                $this->db->query("insert into " . DB_PREFIX . "rawlingsglovebuilder SET ". $fields_string."");
		$sku=$_REQUEST['SKU'];
                $query=$this->db->query("select product_id from ". DB_PREFIX . "product where sku='".$this->db->escape($sku)."'");
        	$product_id=$query->row['product_id'];
		$data=array();
		$data['product_id']=$product_id;
		$data['redirect']= $this->url->link('information/rawlingsglovebuilder','','SSL');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/rawlingsglovebuilder.tpl')) {
		$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/module/rawlingsglovebuilder.tpl', $data));
		} else {
		$this->response->setOutput($this->load->view('default/template/module/rawlingsglovebuilder.tpl', $data));
		}		
		
	               
	}
	
}
?>
