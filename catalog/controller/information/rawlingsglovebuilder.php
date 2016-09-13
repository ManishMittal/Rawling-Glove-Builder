<?php
/*
 * @support
 * http://www.opensourcetechnologies.com/contactus.html
 * sales@opensourcetechnologies.com
* */
class ControllerInformationRawlingsGloveBuilder extends Controller {
	public function index() {
		$this->load->language('information/rawlingsglovebuilder');
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/rawlingsglovebuilder')
		);
  		if(isset($_REQUEST['SKU']))
		{
			$this->load->model('catalog/product');
	 		$fields=array();
		    foreach($_REQUEST as $var=>$val)
			{
				if($var=='route' or $var=='PHPSESSID' or $var=='language' or $var=='currency' or $var=='viewed' or $var=='__atuvc' or $var=='_ga' or $var=='__unam') continue;
		 		$fields[]=$var.' = '.$this->db->escape($val);
			}
	        $fields_string=implode(',',$fields);
			//$this->db->query("insert into " . DB_PREFIX . "rawlingsglovebuilder SET ". $fields_string."");
			//$this->session->data['rawlingsglovebuilder_id']=$this->db->getLastId();
			$sku=$_REQUEST['SKU'];
                        //echo "select product_id from ". DB_PREFIX . "product where sku='".$this->db->escape($sku)."'";
			$query=$this->db->query("select product_id from ". DB_PREFIX . "product where sku='".$this->db->escape($sku)."'");
			$product_id=$query->row['product_id'];
			$data['product_id']=$product_id;
			$options = array();
			foreach ($this->model_catalog_product->getProductOptions($product_id) as $option) 
			{
				$product_option_value_data = array();
				foreach ($option['product_option_value'] as $option_value) 
				{
					if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) 
					{
						if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price'])
						{
							$price = $this->currency->format($this->tax->calculate($option_value['price'], $result['tax_class_id'], $this->config->get('config_tax') ? 'P' : false));
						} 
						else 
						{
							$price = false;
						}

						$product_option_value_data[] = array(
							'product_option_value_id' => $option_value['product_option_value_id'],
								'option_value_id'         => $option_value['option_value_id'],
								'name'                    => $option_value['name'],
								'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
								'price'                   => $price,
								'price_prefix'            => $option_value['price_prefix']
							);
					}
				}

				$options[] = array(
					'product_option_id'    => $option['product_option_id'],
					'product_option_value' => $product_option_value_data,
					'option_id'            => $option['option_id'],
					'name'                 => $option['name'],
					'type'                 => $option['type'],
					'value'                => $fields_string,
					'required'             => $option['required']
					);
			}
			$data['options']=$options;	
		}
		
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title']=	$this->language->get('heading_title');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$data['rawlingsglovebuilder']=html_entity_decode($this->config->get('rawlingsglovebuilder_embed_code'),ENT_QUOTES, 'UTF-8');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/rawlingsglovebuilder.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/rawlingsglovebuilder.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/information/rawlingsglovebuilder.tpl', $data));
		}
	}
}

