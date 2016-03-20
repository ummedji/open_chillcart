<?php
/* janakiraman */
App::import('Vendor', 'Mpdf', array('file' => 'mpdf' . DS . 'mpdf.php'));
App::uses('AppController','Controller');
class InvoicesController extends AppController {    
  public $helpers = array('Html','Form', 'Session', 'Javascript');  
  public $uses    = array('Invoice','Store','Order','State','City','Location');
  public  $components = array('Functions','Mpdf');
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
    $site_detail  = $this->siteSetting;
    $ids  = $this->params['pass'];
      $site_detail  = $this->siteSetting;
      $tax          = $site_detail['Sitesetting']['vat_percent'];
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
      $this->set(compact('invoice_list','tax'));


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
       $tax      = $this->siteSetting['Sitesetting']['vat_percent'];
    $this->set(compact('order_detail','state_list','city_list','area_list','invoice_detail','site_detail','tax'));
  }
    /**
     *Invoice PDF file at admin pannel
     */
    public function admin_invoicePdf(){
        $invoiceId     = $this->params['pass'][0];
        $invoice_detail = $this->Invoice->find('first',array(
            'conditions'=>array(
                'Invoice.id'=>$invoiceId
            )
        ));
        $startDate  = explode(" ",$invoice_detail['Invoice']['start_date']);
        $endDate    = explode(" ",$invoice_detail['Invoice']['end_date']);
        $this->Order->recursive = 0;
        $order_detail = $this->Order->find('all',array(
            'conditions'=>array(
                'Order.store_id'=>$invoice_detail['Invoice']['store_id'],
                'Order.status'=>'Delivered',
                'Order.delivery_date between ? and ?' =>
                    array($startDate[0], $endDate[0]))));
        $state_list   = $this->State->findById($order_detail[0]['Store']['store_state']);
        $city_list   = $this->City->findById($order_detail[0]['Store']['store_city']);
        $area_list   = $this->Location->findById($order_detail[0]['Store']['store_zip']);
        //Invoice PDF template file
        $output = '
            <div style="width:960px;margin:0 auto;">
                <h1 align="center">'.__('Invoice').' ['.$invoice_detail['Invoice']['ref_id'].']</h1>
                <table width="100%"  align="center">
                    <tr style="display:block; width:100%;">
                        <td style="display:inline-block;font:16px/20px Verdana; padding:10px 0px 5px; text-align:left;">
                           Created: '.$invoice_detail['Invoice']['created'].'
                        </td>
                        <td style="display:inline-block;font:16px/20px Verdana; padding:10px 0px 5px; text-align:right;">
                           Period: '.$invoice_detail['Invoice']['start_date'].' to '.
                                     $invoice_detail['Invoice']['end_date'].'
                        </td>
                    </tr>
                </table>
                <hr>
                <table width="100%"  align="center">
                     <tr style="display:block; width:100%;">
                         <td style="display:inline-block;font:14px/20px Verdana; padding:10px 0px 5px; text-align:left;">
                           <h3 style="font:bold 14px/20px Verdana; padding-bottom:15px;">Client:</h3>
                        </td>
                        <td style="display:inline-block;font:16px/20px Verdana; padding:10px 0px 5px; text-align:left;">
                            <h3 style="font:bold 14px/20px Verdana; padding-bottom:15px;">About:</h3>
                        </td>
                        <td style="display:inline-block; padding:10px 0px 5px; text-align:left;">
                            <h3 style="font:bold 14px/20px Verdana; padding-bottom:15px;">Payment Details:</h3>
                        </td>
                     </tr>
                     <tr style="display:block; width:100%;">
                         <td style="display:inline-block;font:14px/20px Verdana; padding:10px 0px 5px; text-align:left;">
                               <span style="font:12px Verdana;">'.$order_detail[0]['Store']['contact_name'].'<br>
                                '.$order_detail[0]['Store']['store_name'].'<br>
                                '.$area_list['Location']['area_name'].','.
                                 $area_list['City']['city_name'].'-'.
                                 $area_list['Location']['zip_code'].',<br>'.
                                 $area_list['State']['state_name'].', '.
                                 $state_list['Country']['country_name'].'</span>
                        </td>
                        <td style="display:inline-block;font:16px/20px Verdana; padding:10px 0px 5px; text-align:left; vertical-align:top;">
                             <span style="font:12px Verdana;">'. $this->siteSetting['Sitesetting']['site_name'].'</span>
                        </td>
                        <td style="display:inline-block;font:16px/20px Verdana; padding:10px 0px 5px; text-align:left; vertical-align:top;">
                           <span style="font:12px Verdana;"> <strong>V.A.T Reg #:</strong>'. $this->siteSetting['Sitesetting']['vat_percent'].'</span>
                        </td>
                     </tr>
                </table>
            </div>';
        $output .= '<table width="100%"  align="center" border="1" cellspacing="1" sellpadding="1">
                        <thead>
                            <tr>
                                <th style="padding:10px 0 10px 15px;" >
                                     Invoice breakdown
                                </th>
                                <th style="padding:10px 0 10px 15px;">
                                     Order Count
                                </th>
                                <th style="padding:10px 0 10px 15px;">
                                     Amount
                                </th>
                            </tr>
                            </thead>
                            <tbody>';
        $output .= '
                            <tr>
                                <td style="padding:10px 0 10px 15px;">
                                    Total value for

                                </td>
                                <td style="padding:10px 0 10px 15px;">'. $invoice_detail['Invoice']['total_order'].'
                                </td>
                                <td style="padding:10px 15px 10px 0;" align="right">'. $this->siteCurrency.' '.$invoice_detail['Invoice']['subtotal'].'
                                </td>

                            </tr>';
        $output .= '
                            <tr>
                                <td style="padding:10px 0 10px 15px;">
                                    Customers paid cash for

                                </td>
                                <td style="padding:10px 0 10px 15px;">'. $invoice_detail['Invoice']['cod_count'].'

                                </td>

                                <td style="padding:10px 15px 10px 0;" align="right" >'.$this->siteCurrency.' '.$invoice_detail['Invoice']['cod_price'].'
                                </td>

                            </tr>';
        $output .= '
                            <tr>
                                <td style="padding:10px 0 10px 15px;">
                                    Customers prepaid online with card for

                                </td>
                                <td style="padding:10px 0 10px 15px;">'.$invoice_detail['Invoice']['card_count'].'</td>

                                <td style="padding:10px 15px 10px 0" align="right">'.$this->siteCurrency.' '.$invoice_detail['Invoice']['card_price'].'

                                </td>

                            </tr>';
        $output .= '
                            <tr>
                                
                                <td style="padding:10px 15px 10px 0;" colspan="2" align="right">subtotal</td>
                                <td style="padding:10px 15px 10px 0;" align="right">'.$this->siteCurrency.' '.$invoice_detail['Invoice']['subtotal'].'</td>

                            </tr>
                            <tr>
                                
                                <td style="padding:10px 15px 10px;" colspan="2" align="right">Total Commission('. $this->siteSetting['Sitesetting']['vat_percent'].'%)</td>
                                <td style="padding:10px 15px 10px 0" align="right">'.$this->siteCurrency.''.$invoice_detail['Invoice']['commision'].'</td>

                            </tr>
                             <tr>
                                
                                <td style="padding:10px 15px 10px 0;" colspan="2" align="right"><strong> Vat for commission ('.$this->siteSetting['Sitesetting']['card_fee'].'%):</strong></td>
                                <td style="padding:10px 15px 10px 0;" align="right">'.$this->siteCurrency.' '.$invoice_detail['Invoice']['commision_tax'].'</td>

                            </tr>
                            <tr>
                                
                                <td style="padding:10px 15px 10px 0;" colspan="2" align="right"><strong>Grand Total</strong></td>
                                <td style="padding:10px 15px 10px 0;" align="right">'.$this->siteCurrency.' '.$invoice_detail['Invoice']['commisionGrand'].'</td>

                            </tr>
                            

                            </tbody>
                            </table>
                        </div>
                    </div>';
        $output .= ' 
                    <h1 style="display:inline-block; font:24px Verdana;">Order Information</h1>
                    <table width="100%" style="margin-top:15px;"  align="center" border="1" cellspacing="1" sellpadding="1">
                            <thead>
                                <tr>
                                    <th style="padding:10px 0 10px 15px;">S_no</th>
                                    <th style="padding:10px 0 10px 15px;">order  Id</th>
                                    <th style="padding:10px 0 10px 15px;">Card/Cash</th>
                                    <th style="padding:10px 0 10px 15px;">Subtotal</th>
                                    <th style="padding:10px 0 10px 15px;">Commision</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $count = 1;
                            foreach($order_detail as $key=>$value){
                                $commision = $value['Order']['order_sub_total'] * ($this->siteSetting['Sitesetting']['card_fee']/100);
                                $output .= '<tr class="odd gradeX">
                                <td style="padding:10px 0 10px 15px;">'.$count.'</td>
                                <td style="padding:10px 0 10px 15px;">'.$value['Order']['ref_number'].'</td>
                                    <td style="padding:10px 0 10px 15px;">'. $value['Order']['payment_type'].'</td>
                                    <td style="padding:10px 0 10px 15px;">'. $this->siteCurrency.' '.$value['Order']['order_sub_total'].'
                                    </td>
                                    <td style="padding:10px 0 10px 15px;">'.
                                    $this->siteCurrency.' '.$commision.'
                                    </td>
                                </tr>';
                                $count ++;
                            }
        $output .= '
                            </tbody>
                        </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>';
        // initializing mPDF
        $this->Mpdf->init();


        $mpdf=new mPDF();
        $mpdf->WriteHTML($output);
        $mpdf->Output();
        exit();

    }



    /**
     *Invoice PDF file at store pannel
     */
    public function store_invoicePdf(){
        $this->layout  = 'assets';
        $invoiceId     = $this->params['pass'][0];
        $invoice_detail = $this->Invoice->find('first',array(
            'conditions'=>array(
                'Invoice.id'=>$invoiceId
            )
        ));
        $startDate  = explode(" ",$invoice_detail['Invoice']['start_date']);
        $endDate    = explode(" ",$invoice_detail['Invoice']['end_date']);
        $this->Order->recursive = 0;
        $order_detail = $this->Order->find('all',array(
            'conditions'=>array(
                'Order.store_id'=>$invoice_detail['Invoice']['store_id'],
                'Order.status'=>'Delivered',
                'Order.delivery_date between ? and ?' =>
                    array($startDate[0], $endDate[0]))));
        $state_list   = $this->State->findById($order_detail[0]['Store']['store_state']);
        $city_list   = $this->City->findById($order_detail[0]['Store']['store_city']);
        $area_list   = $this->Location->findById($order_detail[0]['Store']['store_zip']);
        //Invoice PDF template file

                 $output = '
            <div style="width:960px;margin:0 auto;">
                <h1 align="center">'.__('Invoice').' ['.$invoice_detail['Invoice']['ref_id'].']</h1>
                <table width="100%"  align="center">
                    <tr style="display:block; width:100%;">
                        <td style="display:inline-block;font:16px/20px Verdana; padding:10px 0px 5px; text-align:left;">
                           Created: '.$invoice_detail['Invoice']['created'].'
                        </td>
                        <td style="display:inline-block;font:16px/20px Verdana; padding:10px 0px 5px; text-align:right;">
                           Period: '.$invoice_detail['Invoice']['start_date'].' to '.
                                     $invoice_detail['Invoice']['end_date'].'
                        </td>
                    </tr>
                </table>
                <hr>
                <table width="100%"  align="center">
                     <tr style="display:block; width:100%;">
                         <td style="display:inline-block;font:14px/20px Verdana; padding:10px 0px 5px; text-align:left;">
                           <h3 style="font:bold 14px/20px Verdana; padding-bottom:15px;">Client:</h3>
                        </td>
                        <td style="display:inline-block;font:16px/20px Verdana; padding:10px 0px 5px; text-align:left;">
                            <h3 style="font:bold 14px/20px Verdana; padding-bottom:15px;">About:</h3>
                        </td>
                        <td style="display:inline-block; padding:10px 0px 5px; text-align:left;">
                            <h3 style="font:bold 14px/20px Verdana; padding-bottom:15px;">Payment Details:</h3>
                        </td>
                     </tr>
                     <tr style="display:block; width:100%;">
                         <td style="display:inline-block;font:14px/20px Verdana; padding:10px 0px 5px; text-align:left;">
                               <span style="font:12px Verdana;">'.$order_detail[0]['Store']['contact_name'].'<br>
                                '.$order_detail[0]['Store']['store_name'].'<br>
                                '.$area_list['Location']['area_name'].','.
                                 $area_list['City']['city_name'].'-'.
                                 $area_list['Location']['zip_code'].',<br>'.
                                 $area_list['State']['state_name'].', '.
                                 $state_list['Country']['country_name'].'</span>
                        </td>
                        <td style="display:inline-block;font:16px/20px Verdana; padding:10px 0px 5px; text-align:left; vertical-align:top;">
                             <span style="font:12px Verdana;">'. $this->siteSetting['Sitesetting']['site_name'].'</span>
                        </td>
                        <td style="display:inline-block;font:16px/20px Verdana; padding:10px 0px 5px; text-align:left; vertical-align:top;">
                           <span style="font:12px Verdana;"> <strong>V.A.T Reg #:</strong>'. $this->siteSetting['Sitesetting']['vat_percent'].'</span>
                        </td>
                     </tr>
                </table>
            </div>';
        $output .= '<table width="100%"  align="center" border="1" cellspacing="1" sellpadding="1">
                        <thead>
                            <tr>
                                <th style="padding:10px 0 10px 15px;" >
                                     Invoice breakdown
                                </th>
                                <th style="padding:10px 0 10px 15px;">
                                     Order Count
                                </th>
                                <th style="padding:10px 0 10px 15px;">
                                     Amount
                                </th>
                            </tr>
                            </thead>
                            <tbody>';
        $output .= '
                            <tr>
                                <td style="padding:10px 0 10px 15px;">
                                    Total value for

                                </td>
                                <td style="padding:10px 0 10px 15px;">'. $invoice_detail['Invoice']['total_order'].'
                                </td>
                                <td style="padding:10px 15px 10px 0;" align="right">'. $this->siteCurrency.' '.$invoice_detail['Invoice']['subtotal'].'
                                </td>

                            </tr>';
        $output .= '
                            <tr>
                                <td style="padding:10px 0 10px 15px;">
                                    Customers paid cash for

                                </td>
                                <td style="padding:10px 0 10px 15px;">'. $invoice_detail['Invoice']['cod_count'].'

                                </td>

                                <td style="padding:10px 15px 10px 0;" align="right" >'.$this->siteCurrency.' '.$invoice_detail['Invoice']['cod_price'].'
                                </td>

                            </tr>';
        $output .= '
                            <tr>
                                <td style="padding:10px 0 10px 15px;">
                                    Customers prepaid online with card for

                                </td>
                                <td style="padding:10px 0 10px 15px;">'.$invoice_detail['Invoice']['card_count'].'</td>

                                <td style="padding:10px 15px 10px 0" align="right">'.$this->siteCurrency.' '.$invoice_detail['Invoice']['card_price'].'

                                </td>

                            </tr>';
        $output .= '
                            <tr>
                                
                                <td style="padding:10px 15px 10px 0;" colspan="2" align="right">subtotal</td>
                                <td style="padding:10px 15px 10px 0;" align="right">'.$this->siteCurrency.' '.$invoice_detail['Invoice']['subtotal'].'</td>

                            </tr>
                            <tr>
                                
                                <td style="padding:10px 15px 10px;" colspan="2" align="right">Total Commission('. $this->siteSetting['Sitesetting']['vat_percent'].'%)</td>
                                <td style="padding:10px 15px 10px 0" align="right">'.$this->siteCurrency.''.$invoice_detail['Invoice']['commision'].'</td>

                            </tr>
                             <tr>
                                
                                <td style="padding:10px 15px 10px 0;" colspan="2" align="right"><strong> Vat for commission ('.$this->siteSetting['Sitesetting']['card_fee'].'%):</strong></td>
                                <td style="padding:10px 15px 10px 0;" align="right">'.$this->siteCurrency.' '.$invoice_detail['Invoice']['commision_tax'].'</td>

                            </tr>
                            <tr>
                                
                                <td style="padding:10px 15px 10px 0;" colspan="2" align="right"><strong>Grand Total</strong></td>
                                <td style="padding:10px 15px 10px 0;" align="right">'.$this->siteCurrency.' '.$invoice_detail['Invoice']['commisionGrand'].'</td>

                            </tr>
                            

                            </tbody>
                            </table>
                        </div>
                    </div>';
        $output .= ' 
                    <h1 style="display:inline-block; font:24px Verdana;">Order Information</h1>
                    <table width="100%" style="margin-top:15px;"  align="center" border="1" cellspacing="1" sellpadding="1">
                            <thead>
                                <tr>
                                    <th style="padding:10px 0 10px 15px;">S_no</th>
                                    <th style="padding:10px 0 10px 15px;">order  Id</th>
                                    <th style="padding:10px 0 10px 15px;">Card/Cash</th>
                                    <th style="padding:10px 0 10px 15px;">Subtotal</th>
                                    <th style="padding:10px 0 10px 15px;">Commision</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $count = 1;
                            foreach($order_detail as $key=>$value){
                                $commision = $value['Order']['order_sub_total'] * ($this->siteSetting['Sitesetting']['card_fee']/100);
                                $output .= '<tr class="odd gradeX">
                                <td style="padding:10px 0 10px 15px;">'.$count.'</td>
                                <td style="padding:10px 0 10px 15px;">'.$value['Order']['ref_number'].'</td>
                                    <td style="padding:10px 0 10px 15px;">'. $value['Order']['payment_type'].'</td>
                                    <td style="padding:10px 0 10px 15px;">'. $this->siteCurrency.' '.$value['Order']['order_sub_total'].'
                                    </td>
                                    <td style="padding:10px 0 10px 15px;">'.
                                    $this->siteCurrency.' '.$commision.'
                                    </td>
                                </tr>';
                                $count ++;
                            }
        $output .= '
                            </tbody>
                        </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>';
        // initializing mPDF
        $this->Mpdf->init();


        $mpdf=new mPDF();
        $mpdf->WriteHTML($output);
        $mpdf->Output();
        exit();

    }
}