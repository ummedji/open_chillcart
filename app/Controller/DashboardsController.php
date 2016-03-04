<?php
/* Janakiraman */
App::uses('AppController', 'Controller');

class DashboardsController extends AppController
{
    var $helpers = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');
    public $uses = array('Store', 'Order', 'Invoice');
    public $components = array('Functions');

    public function admin_index() {
        //echo $result = $this->Twilio->sendSingleSms('+919994196333', 'Hello');
        $site_setting = $this->siteSetting;
        $tax          = $site_setting['Sitesetting']['vat_percent'];
        $cardfess     = $site_setting['Sitesetting']['card_fee'];

        $store_detail = $this->Store->find('list', array(
                            'conditions' => array('Store.status' => 1)));
        $order_detail = $this->Order->find('all',array(
                                    'conditions'=>array(
                                    'Order.status'=>'Delivered')));
        $counts        = count($store_detail);
        $invoiceDetail = $this->Invoice->find('all');
        #dashboard commision calculation done here
        $results       = $this->Functions->dashboardCalculation($order_detail,$invoiceDetail);
        $dasboard_value['store_count']          = $counts ;
        $dasboard_value['order_count']          = $results['totalorder'];
        $dasboard_value['order_price']          = $results['total'];
        $dasboard_value['Commision']            = $results['commisionTotal'];
        $dasboard_value['CommisionTax']         = $results['commision_tax'];
        $dasboard_value['commisionGrandTotal']  = $results['commisionGrandTotal'];
        $this->set(compact('dasboard_value'));
        
    }

    public function store_index()
    {
        $this->layout = 'assets';
        $id = $this->Auth->User();
        $site_setting = $this->siteSetting;
        $order_detail = $this->Order->find('all', array(
            'conditions' => array(
                'Order.store_id' => $id['Store']['id'],
                'Order.status' => 'Delivered')));
        $counts = count($order_detail);
        $total = 0;
        foreach ($order_detail as $key => $value) {
            $total = $total + $value['Order']['order_grand_total'];
        }
        $dasboard_value['order_count'] = $counts;
        $dasboard_value['order_price'] = $total;
        $this->set(compact('dasboard_value'));

    }

}
