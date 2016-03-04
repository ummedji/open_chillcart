<?php
/* janakiraman */
App::uses('AppController','Controller');
class InvoicesController extends AppController {    
  public $helpers = array('Html','Form', 'Session', 'Javascript');  
  public $uses    = array('Invoice','Store','Order','State','City','Location');
  public  $components = array('Functions');
  /**
   * BrandsController::admin_index()
   * Brand Management  Process
   * @return void
   */
  public function admin_index() {   
      $invoice_list  = $this->Invoice->find('all');
      $this->set(compact('invoice_list'));

  }

  public function admin_invoiceDetail() {

    $ids        = $this->params['pass'];
    $startdate  = explode(' ', $ids[1]);
    $endDate    = explode(' ', $ids[2]);
    $site_detail    = $this->siteSetting;
    $tax            = $site_detail['Sitesetting']['vat_percent'];
    $invoice_detail = $this->Invoice->findById($ids[3]);
    $order_detail   = $this->Order->find('all',array(
                        'conditions'=>array('Order.store_id'=>$ids[0],
                                            'Order.status'=>'Delivered',
                            'Order.delivery_date between ? and ?' =>
                                        array($startdate[0], $endDate[0]))));

    $state_list   = $this->State->findById($order_detail[0]['Store']['store_state']);
    $city_list   = $this->City->findById($order_detail[0]['Store']['store_city']);
    $area_list   = $this->Location->findById($order_detail[0]['Store']['store_zip']);

    $this->set(compact('order_detail','state_list','city_list','area_list','invoice_detail','site_detail','tax'));
  }
    public function admin_invoiceCalculation() {
        $status   = 1;
        $site_detail  = $this->siteSetting;
        $tax          = $site_detail['Sitesetting']['vat_percent'];
        $cardfess     = $site_detail['Sitesetting']['card_fee'];
        $store_detail = $this->Store->find('all', array(
                                'conditions'=>array('Store.status'=>$status),
                                'group'=>array('Store.id')));

        $start_dat = date('Y-m-d', strtotime('first day of last month'));
        $end_date  = date('Y-m-d', strtotime('last day of last month'));
        
        if(!empty($store_detail)) {

            foreach($store_detail as $key => $value) {

                if ($value['Store']['invoice_period'] == '30day') {

                    $first_setvlue  = $this->request->data['Invoice']['id'];
                    $first_setvlue  = '';
                    $id             = $value['Store']['id'];
                    $order_detail   = $this->Order->find('all',array(
                                                'conditions'=>array('Order.store_id'=>$id,
                                                         'Order.delivery_date between ? and ?' =>
                                                                array($start_dat, $end_date),
                                                        'Order.status'=>'Delivered')));


                    if(!empty($order_detail)) {
                        $results = $this->Functions->sumOfDetail($order_detail,$tax,$cardfess);

                        $sub_total                                     = $results['total'];
                        $tax                                           = $site_detail['Sitesetting']['vat_percent'];
                        $grand_total                                   = $sub_total - ($tax + $results['stripe_tax']);
                        $commision                                     = $sub_total*($tax/100);
                        $commision_tax                                 = $commision *($tax/100);
                        $this->request->data['Invoice']['store_id']    = $id;
                        $this->request->data['Invoice']['subtotal']    = $sub_total;
                        $this->request->data['Invoice']['tax']         = $tax;
                        $this->request->data['Invoice']['grand_total'] = $grand_total;
                        $this->request->data['Invoice']['total_order'] = $results['total_order'];
                        $this->request->data['Invoice']['cod_count']   = $results['cod_count'];
                        $this->request->data['Invoice']['cod_price']   = $results['cod_total'];
                        $this->request->data['Invoice']['card_count']  = $results['stripe_count'];
                        $this->request->data['Invoice']['card_price']  = $results['stripe_total'];
                        $this->request->data['Invoice']['card_tax']    = $results['stripe_tax'];
                        $this->request->data['Invoice']['commision']     = $commision;
                        $this->request->data['Invoice']['commision_tax'] =$commision_tax;
                        $this->request->data['Invoice']['commisionGrand'] =$commision_tax + $commision;
                        $this->request->data['Invoice']['start_date']  = $start_dat;
                        $this->request->data['Invoice']['end_date']    = $end_date;
                        $checking   = $this->Invoice->find('all',array(
                                                'conditions'=>array('Invoice.store_id'=>$id),
                                                'NOT'=>array('Invoice.start_date'=>$start_dat,
                                                    'Invoice.start_date.end_date'=>$end_date)));
                        if (empty($checking)) {
                            $this->Invoice->save($this->request->data['Invoice']);
                            $invoice_id = $this->Invoice->id;
                            $ref_id = '#GR000' . $invoice_id . 'INV';
                            $this->request->data['Invoice']['id'] = $this->Invoice->id;
                            $this->request->data['Invoice']['ref_id'] = $ref_id;
                            $this->Invoice->save($this->request->data['Invoice']);
                        }
                    }

                } else {

                    if(date('j') == 1) {

                        //Next Month 1 -> Day 16 To Day 30 OR 31

                        $last_date = date("Y-m-d", strtotime('-1 day', strtotime(date('Y-m-d'))) );

                        list($ll_yr, $ll_mon, $ll_date) = explode("-", $last_date);
                        $startdate              = $ll_yr.'-'.$ll_mon.'-16';
                        $endeddate              = $last_date;
                        //$endeddate              = '2014-01-31';

                        $invoice_monthly_2      = $ll_yr.'-'.$ll_mon;
                        $inv_month_period       = 16;
                        $inv_month_period_limit = '16-'.$ll_date;
                        $inv_month              = $ll_yr.'-'.$ll_mon;
                    } else {
                        //Day 16 -> Day 01 to Day 15
                        $startdate              = date('Y').'-'.date('m').'-01';
                        $endeddate              = date('Y').'-'.date('m').'-15';

                        $invoice_monthly_2      = date('Y').'-'.date('m');
                        $inv_month_period       = 1;
                        $inv_month_period_limit = '01-15';
                        $inv_month              = date('Y').'-'.date('m');
                    }
                    $first_setvlue  = $this->request->data['Invoice']['id'];
                    $first_setvlue  = '';
                    $id             = $value['Store']['id'];
                    $order_detail   = $this->Order->find('all', array(
                                                'conditions'=>array('Order.store_id'=>$id,
                                                        'Order.delivery_date between ? and ?' =>
                                                                array($startdate, $endeddate),
                                                'Order.status'=>'Delivered')));

                    if(!empty($order_detail)) {

                        $results = $this->Functions->sumOfDetail($order_detail,$tax,$cardfess);
                        $sub_total                                      = $results['total'];
                        $tax                                            = $site_detail['Sitesetting']['vat_percent'];
                        $grand_total                                    = $sub_total - ($tax + $results['stripe_tax']);
                        $commision                                      = $sub_total*($tax/100);
                        $commision_tax                                  = $commision *($tax/100);
                        $this->request->data['Invoice']['store_id']     = $id;
                        $this->request->data['Invoice']['subtotal']     = $sub_total;
                        $this->request->data['Invoice']['tax']          = $tax;
                        $this->request->data['Invoice']['grand_total']  = $grand_total;
                        $this->request->data['Invoice']['total_order']  = $results['total_order'];
                        $this->request->data['Invoice']['cod_count']    = $results['cod_count'];
                        $this->request->data['Invoice']['cod_price']    = $results['cod_total'];
                        $this->request->data['Invoice']['card_count']   = $results['stripe_count'];
                        $this->request->data['Invoice']['card_price']   = $results['stripe_total'];
                        $this->request->data['Invoice']['card_tax']     = $results['stripe_tax'];
                        $this->request->data['Invoice']['commision']    = $commision;
                        $this->request->data['Invoice']['commision_tax'] =$commision_tax;
                        $this->request->data['Invoice']['commisionGrand']=$commision_tax + $commision;
                        $this->request->data['Invoice']['start_date']    = $startdate;
                        $this->request->data['Invoice']['end_date']     = $endeddate;
                        $checking   = $this->Invoice->find('all',array(
                                        'conditions'=>array('Invoice.store_id'=>$id),
                                            'NOT'=>array('Invoice.start_date'=>$startdate,
                                                'Invoice.start_date.end_date'=>$endeddate)));
                        if(empty($checking)){
                            $this->Invoice->save($this->request->data['Invoice']);
                            $invoice_id = $this->Invoice->id;
                            $ref_id = '#GR000' . $invoice_id . 'INV';
                            $this->request->data['Invoice']['id'] = $this->Invoice->id;
                            $this->request->data['Invoice']['ref_id'] = $ref_id;
                            $this->Invoice->save($this->request->data['Invoice']);
                        }

                    }
                }

            }
        }
        exit();

    }
    public function store_index() {
      $this->layout  = 'assets';
      $id            = $this->Auth->User();
      $invoice_list  = $this->Invoice->find('all',array(
                                            'conditions'=>array('Invoice.store_id'=>$id['Store']['id'])));
      $this->set(compact('invoice_list'));


  }
   public function store_invoiceDetail() {
    $site_detail  = $this->siteSetting;
    $this->layout  = 'assets';
    $ids  = $this->params['pass'];
    $invoice_detail = $this->Invoice->findById($ids[3]);
    $order_detail = $this->Order->find('all',array(
                                        'conditions'=>array(
                                        'Order.store_id'=>$ids[0],
                                        'Order.status'=>'Delivered',
                                        'Order.delivery_date between ? and ?' =>
                                        array($ids[1], $ids[2]))));
    $state_list   = $this->State->findById($order_detail[0]['Store']['store_state']);
    $city_list   = $this->City->findById($order_detail[0]['Store']['store_city']);
    $area_list   = $this->Location->findById($order_detail[0]['Store']['store_zip']);
    $this->set(compact('order_detail','state_list','city_list','area_list','invoice_detail','site_detail'));
    //echo "<pre>";print_r($site_detail); die();
  }
}