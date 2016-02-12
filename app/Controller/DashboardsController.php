
<?php
/* Janakiraman */
App::uses('AppController', 'Controller');
class DashboardsController extends AppController {
	var $helpers       = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');
	public $uses       = array('Store','Order');
	public  $components = array('Functions');

	public function admin_index() {
		$site_setting = $this->siteSetting;
		$tax          = $site_setting['Sitesetting']['vat_percent'];
        $cardfess     = $site_setting['Sitesetting']['card_fee'];
		
		$store_detail = $this->Store->find('list');
		$order_detail = $this->Order->find('all',array(
									'conditions'=>array(
									'Order.status'=>'Delivered')));
		$counts       = count($store_detail);
		$results      = $this->Functions->sumOfDetail($order_detail,$tax,$cardfess); 
		$dasboard_value['store_count']       = $counts ;
		$dasboard_value['order_count'] = $results['total_order'];
		$dasboard_value['order_price'] = $results['total'];		
		$this->set(compact('dasboard_value'));
		
	}
	public function store_index() {
		$this->layout  = 'assets';
		$id            = $this->Auth->User();
		$site_setting  = $this->siteSetting;		
		$order_detail  = $this->Order->find('all',array(
									'conditions'=>array(
									'Order.store_id'=>$id['Store']['id'],
									'Order.status'=>'Delivered')));
		$counts        = count($order_detail);
		$total         = 0;
		foreach ($order_detail as $key => $value) {
			$total     = $total + $value['Order']['order_grand_total'];			
		} 
		$dasboard_value['order_count'] = $counts ;
		$dasboard_value['order_price'] = $total;		
		$this->set(compact('dasboard_value'));
	 
	}

}
