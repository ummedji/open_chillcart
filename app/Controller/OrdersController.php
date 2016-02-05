<?php

/* janakiraman */

App::uses('AppController','Controller');
App::uses('CakeEmail', 'Network/Email');

class OrdersController extends AppController {
    
  var $helpers = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');

  public $uses    = array('Order','ShoppingCart', 'CustomerAddressBook', 'DeliveryTimeSlot',
                          'StripeCustomer', 'Storeoffer', 'Status', 'State', 'City', 'Location',
                          'Store', 'ProductDetail', 'Orderstatus', 'Notification');

  public $components = array('Stripe', 'Googlemap', 'AndroidResponse');

  public function beforeFilter() {

    parent::beforeFilter();

    $orderStatus = $this->Status->find('list', array(
                                    'fields' => array('id', 'title')));

    $states = $this->State->find('list', array(
                          'conditions' => array('State.country_id' => $this->siteSetting['Sitesetting']['site_country']),
                          'fields' => array('id', 'state_name')));


    $this->storeState = $this->State->find('list', array(
                        'fields' => array('id', 'state_name')));
    $this->storeCity = $this->City->find('list', array(
              'fields' => array('City.id', 'City.city_name')));

    if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
      $this->storeLocation = $this->Location->find('list', array(
                      'fields' => array('id','zip_code')));
    } else {
      $this->storeLocation = $this->Location->find('list', array(
                      'fields' => array('id','area_name')));
    }
    $this->set(compact('orderStatus', 'states'));
  }




  /**
   * BrandsController::admin_index()
   * 
   * @return void
   */
  public function admin_index() {
    
  	$order_list = $this->Order->find('all', array(
                        'conditions' => array('Order.status' => 'Pending'),
                        'order' => array('Order.id DESC')));

    $status = array('Pending' => 'Pending', 'Accepted' => 'Accepted',
                    'Failed' => 'Failed', 'Delivered' => 'Delivered');

    $this->set(compact('order_list', 'status'));
  }


  // Admin Collection Orders
  public function admin_collectionOrders() {

    $order_list = $this->Order->find('all', array(
                        'conditions' => array('Order.status' => 'Accepted',
                                              'Order.order_type' => 'Collection'),
                        'order' => array('Order.id DESC')));

    $status = array('Accepted' => 'Accepted', 'Failed' => 'Failed', 'Delivered' => 'Delivered');

    $this->set(compact('order_list', 'status'));
  }
    public function admin_failedOrderDetail(){
        $order_list = $this->Order->find('all', array(
            'conditions' => array('Order.status' => 'Failed'),
            'order' => array('Order.id DESC')));
        $status = array('Pending' => 'Pending', 'Accepted' => 'Accepted',
            'Failed' => 'Failed', 'Delivered' => 'Delivered');
        $this->set(compact('order_list', 'status'));
    }

  // Admin Dispatch Order
  public function admin_order() {

    $statuss = array('Delivered','Pending','Failed');

    $location = $this->Location->find('list', array(
                                    'fields' => array('id', 'area_name')));

    $city = $this->City->find('list', array(
                                    'fields' => array('id', 'city_name')));

    $orderList = $this->Order->find('all', array(
                        'conditions' => array('Order.order_type' => 'Delivery',
                              'NOT'  => array('Order.status' => $statuss)),
                        'order' => array('Order.id DESC')));
    $status = array('Failed' => 'Failed', 'Delivered' => 'Delivered');

    $this->set(compact('orderList', 'location', 'city', 'status'));


  }
  //Report Management Process
  public function admin_reportIndex($id = null) {
      $order_list = $this->Order->find('all', array(
                                  'conditions' => array('Order.status' => 'Delivered'),
                                  'order' => array('Order.id DESC')));
      $this->set(compact('order_list'));     

  }
  //Admin side ReportManagement Based Order View
  public function admin_reportOrderView($id = null) {
    if (!empty($id)){
      $this->Order->recursive = 2;
      $orders_list = $this->Order->findByRefNumber($id);

      $cities = $this->City->find('list', array(
                      'conditions' => array('City.state_id' => $orders_list['ShoppingCart'][0]['Store']['store_state']),
                      'fields' => array('id', 'city_name')));

      $location = $this->Location->find('list', array(
                      'conditions' => array('Location.city_id' => $orders_list['ShoppingCart'][0]['Store']['store_city']),
                      'fields' => array('id', 'area_name')));

      $this->set(compact('orders_list', 'cities', 'location'));
    } else {
      $this->redirect(array('controller' => 'Orders', 'action' => 'reportIndex'));
    }
    
  }

  //Admin side Order view Process
  public function admin_orderView($id = null, $page) {
    
    if(!empty($id)){
      $this->Order->recursive =2 ;
      $order_detail           = $this->Order->findById($id);

      $cities = $this->City->find('list', array(
                      'conditions' => array('City.state_id' => $order_detail['ShoppingCart'][0]['Store']['store_state']),
                      'fields' => array('id', 'city_name')));

      $location = $this->Location->find('list', array(
                      'conditions' => array('Location.city_id' => $order_detail['ShoppingCart'][0]['Store']['store_city']),
                      'fields' => array('id', 'area_name')));
      
      $this->set(compact('order_detail', 'cities', 'location', 'page'));

    } else {
       $this->redirect(array('controller' => 'Orders', 'action' => 'index'));
    }
    
  }

  //Confirm Order Process
  public function conformOrder() {
      $today= date("m/d/Y");
      $lastsessionid  = $this->Session->read("preSessionid");
      $SessionId = (!empty($lastsessionid)) ? $lastsessionid : $this->Session->id();

      foreach ($this->request->data['Order']['timeSlot'] as $key => $value) {

          $customerDetails = $this->CustomerAddressBook->findById($this->request->data['Order']['delivery_id']);

          
          $order['store_id']            = $value['store_id'];
          $order['customer_id']         = $this->Auth->User('Customer.id');
          $order['user_type']           = 'Customer';
          $order['order_description']   = $this->request->data['Order']['order_description'];
          $order['delivery_date']       = ($value['type'] == 'Today') ? date("Y-m-d") : date("Y-m-d", time()+86400);
          $order['order_type']          = $value['orderType'];

          $storeDetails = $this->Store->findById($order['store_id']);

          if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
            $storeAddress = $storeDetails['Store']['street_address'].', '.
                      $this->storeCity[$storeDetails['Store']['store_city']].', '.
                      $this->storeState[$storeDetails['Store']['store_state']].' '.
                      $this->storeLocation[$storeDetails['Store']['store_zip']].', '.
                      $this->siteSetting['Country']['country_name'];


          } else {
            $storeAddress = $storeDetails['Store']['street_address'].', '.
                      $this->storeLocation[$storeDetails['Store']['store_zip']].', '.
                      $this->storeCity[$storeDetails['Store']['store_city']].', '.
                      $this->storeState[$storeDetails['Store']['store_state']].', '.
                      $this->siteSetting['Country']['country_name'];
          }
          
          $sourceLatLong    = $this->Googlemap->getlatitudeandlongitude($storeAddress);
          $source_lat       = $sourceLatLong['lat'];
          $source_long      = $sourceLatLong['long'];

          if ($order['order_type'] != 'Collection') {

            $order['customer_name']       = $customerDetails['Customer']['first_name']. ' '.
                                            $customerDetails['Customer']['last_name'];
            $order['customer_email']      = $customerDetails['Customer']['customer_email'];
            $order['customer_phone']      = $customerDetails['Customer']['customer_phone'];
            $order['address']             = $customerDetails['CustomerAddressBook']['address'];
            $order['landmark']            = $customerDetails['CustomerAddressBook']['landmark'];
            $order['state_name']          = $customerDetails['State']['state_name'];
            $order['city_name']           = $customerDetails['City']['city_name'];
            $order['location_name']       = $customerDetails['Location']['area_name'];

            $deliveryAddress =  $order['address'].', '.
                            $order['location_name'].', '.
                            $order['city_name'].', '.
                            $order['state_name'].', '.
                            $this->siteSetting['Country']['country_name'];

            $destinationLatLong = $this->Googlemap->getlatitudeandlongitude($deliveryAddress);
            $order['destination_latitude']    = $destinationLatLong['lat'];
            $order['destination_longitude']   = $destinationLatLong['long'];
          } else {

            $order['customer_name']       = $this->Auth->User('Customer.first_name'). ' '.
                                            $this->Auth->User('Customer.last_name');
            $order['customer_email']      = $this->Auth->User('Customer.customer_email');
            $order['customer_phone']      = $this->Auth->User('Customer.customer_phone');
            $order['address']             = $storeDetails['Store']['street_address'];
            $order['landmark']            = '';
            $order['state_name']          = $this->storeState[$storeDetails['Store']['store_state']];
            $order['city_name']           = $this->storeCity[$storeDetails['Store']['store_city']];
            $order['location_name']       = $this->storeLocation[$storeDetails['Store']['store_zip']];

            $order['destination_latitude']    = $sourceLatLong['lat'];
            $order['destination_longitude']   = $sourceLatLong['long'];
          }


          $destination_lat  = $order['destination_latitude'];
          $destination_long = $order['destination_longitude'];

          $distance         = $this->Googlemap->getDrivingDistance($source_lat,$source_long,$destination_lat,$destination_long);
          $order['source_latitude']   = $sourceLatLong['lat'];
          $order['source_longitude']  = $sourceLatLong['long'];


          $storeOffers = $this->Storeoffer->find('first', array(
                                    'conditions' => array('Storeoffer.store_id' => $value['store_id'],
                                              'Storeoffer.status' => 1,
                                               "Storeoffer.from_date <="  => $today,
                                               "Storeoffer.to_date >="    => $today),
                                    'order' => 'Storeoffer.id DESC'));

          $deliverDetails = $this->DeliveryTimeSlot->findById($value['time']);
          
          $total = $this->ShoppingCart->find('all', array(
                  'conditions'=>array('ShoppingCart.session_id' => $SessionId,
                                      'ShoppingCart.store_id' => $value['store_id']),
                  'fields' => array('SUM(ShoppingCart.product_total_price) AS cartSubTotal')));

          $order['delivery_time_slot']  = $deliverDetails['TimeSlot']['time_from']. ' TO '.
                                          $deliverDetails['TimeSlot']['time_to'];
          $order['delivery_charge']     = ($value['orderType'] != 'Collection') ? $deliverDetails['DeliveryTimeSlot']['delivery_charge'] : 0;
          $order['order_sub_total']     = $total[0][0]['cartSubTotal'];
          $order['tax_amount']          = $deliverDetails['Store']['tax'];
          $order['distance']            = $distance['distanceText'];
          $order['offer_amount']        = ($storeOffers['Storeoffer']['offer_price'] <= $total[0][0]['cartSubTotal']) ?
                                            $total[0][0]['cartSubTotal'] * $storeOffers['Storeoffer']['offer_percentage']/100 :
                                            0;
                                            
          $order['order_grand_total']   = $order['order_sub_total'] + $order['delivery_charge'] + $order['tax_amount'] - $order['offer_amount'];

          $this->Order->save($order);

          $update['ref_number']         = '#GNC00'.$this->Order->id;
          $orderId[] = $update['id']    = $this->Order->id;

          $this->Order->save($update);

          $storeDetails = $this->Store->findById($value['store_id']);

          // Store Owner Message
          if ($storeDetails['Store']['is_logged'] == 1) {
            
              $deviceId      = $storeDetails['Store']['device_id'];
              $ordDetails   = json_encode($orderDetails);
              $message      = 'New order came - '.$update['ref_number'];
              
              $gcm = $this->AndroidResponse->sendOrderByGCM(
                      array('OrderDetails' => $ordDetails,
                            'message'    => $message),
                              $deviceId);

          }

          $this->ShoppingCart->updateAll(
                        array('ShoppingCart.order_id' => $this->Order->id),
                        array('ShoppingCart.session_id' => $SessionId,
                              'ShoppingCart.store_id'   => $value['store_id']));

          $cartProducts = $this->ShoppingCart->find('all', array(
                'conditions' => array('ShoppingCart.order_id' => $this->Order->id)));

          foreach ($cartProducts as $key => $value) {
              $value['ProductDetail']['quantity'] -= $value['ShoppingCart']['product_quantity'];
              $value['ProductDetail']['quantity'] = ($value['ProductDetail']['quantity'] > 0) ? 
                                                    $value['ProductDetail']['quantity'] :
                                                    0;
              $this->ProductDetail->save($value['ProductDetail']);
          }

          $this->ordermail($this->Order->id);

          $this->Order->id = '';
      }


      if ($this->request->data['Order']['paymentMethod'] == 'cod') {

          foreach ($orderId as $key => $value) {
              $orderUpdate['id'] = $value;
              $orderUpdate['payment_type'] = 'cod';
              $this->Order->save($orderUpdate);
          }

          /*$this->Session->setFlash('<p>'.__('Your Order Placed Successfully', true).'</p>', 'default', 
                                          array('class' => 'alert alert-success'));*/
      } else {

        $id = $this->request->data['Order']['paymentMethod'];

        $stripeCard = $this->StripeCustomer->findById($id);

        if (empty($stripeCard['StripeCustomer']['stripe_customer_id'])) {

            $datas    = array("stripeToken"  => $stripeCard['StripeCustomer']['stripe_token_id']);
            $customer = $this->Stripe->customerCreate($datas);
            $stripId = $stripeCard['StripeCustomer']['stripe_customer_id'] = $customer['stripe_id'];
            $this->StripeCustomer->save($stripeCard);

        } else {
            $stripId = $stripeCard['StripeCustomer']['stripe_customer_id'];
        }


        foreach ($orderId as $key => $value) {
          $orderTotal = $this->Order->findById($value);
          $amount += $orderTotal['Order']['order_grand_total'];
        }

        $data   = array('currency'       => 'usd',
                        "amount"         => $amount,
                        "stripeCustomer" => $stripId);
        
        $stripeResponse = $this->Stripe->charge($data);
        if ($stripeResponse['status'] == "succeeded" && $stripeResponse['stripe_id'] != '') {
          
            foreach ($orderId as $key => $value) {

              $orderUpdate['id'] = $value;
              $orderUpdate['transaction_id']  = $stripeResponse['stripe_id'];
              $orderUpdate['payment_type']    = 'Card';
              $orderUpdate['payment_method']  = 'paid';
              $this->Order->save($orderUpdate);
            }

            /*$this->Session->setFlash('<p>'.__('Your Order Placed Successfully', true).'</p>', 'default', 
                                        array('class' => 'alert alert-success'));*/

        } else {
            $this->Session->setFlash(__('Payment failed', true),
                                    'default', array('class' => 'alert alert-danger'));
        }

      }

      $this->Session->write("preSessionid",'');

      /*$this->Session->setFlash('<p>'.__('Your Order Place Successfull', true).'</p>', 'default', 
                                          array('class' => 'alert alert-success'));*/
      $this->Session->write('orderplaced', 'success');
      $this->redirect(array('controller' => 'searches', 'action' => 'index', 'Thanks'));

  }
  public function store_index(){
    $this->layout           = 'assets';

    $order_list = $this->Order->find('all', array(
                        'conditions'=>array('Order.store_id' => $this->Auth->User('Store.id'),
                                            'Order.status' => 'Delivered'),
                                'order' => array('Order.id DESC')));

    $this->set(compact('order_list'));
  }
  public function store_reportOrderView($id = null) {
    $this->layout = 'assets';
    if (!empty($id)){
      $this->Order->recursive = 2;
      $orders_list = $this->Order->findByRefNumber($id);
      $cities = $this->City->find('list', array(
                      'conditions' => array('City.state_id' => $orders_list['ShoppingCart'][0]['Store']['store_state']),
                      'fields' => array('id', 'city_name')));

      $location = $this->Location->find('list', array(
                      'conditions' => array('Location.city_id' => $orders_list['ShoppingCart'][0]['Store']['store_city']),
                      'fields' => array('id', 'area_name')));

      $this->set(compact('orders_list', 'cities', 'location'));
    } else {
      $this->redirect(array('controller' => 'Orders', 'action' => 'reportIndex'));
    }
    
  }
   public function store_orderIndex() {
    $this->layout = 'assets';
    $id           = $this->Auth->User();
    $this->Order->recursive =2 ;
    $order_list = $this->Order->find('all', array(
                                      'conditions'=>array('Order.store_id'=>$id['Store']['id'],
                                        'Order.status' => 'Pending'),
                                      'order' => array('Order.id DESC')));
    $status = array('Pending' => 'Pending', 'Accepted' => 'Accepted',
                    'Failed' => 'Failed', 'Delivered' => 'Delivered');

    $this->set(compact('order_list', 'status'));
  }
   public function store_orderView($id = null, $page) {
    $this->layout = 'assets';
    if(!empty($id)){
      $this->Order->recursive =2 ;
      $order_detail           = $this->Order->findById($id);      

      $cities = $this->City->find('list', array(
                      'conditions' => array('City.state_id' => $order_detail['ShoppingCart'][0]['Store']['store_state']),
                      'fields' => array('id', 'city_name')));

      $location = $this->Location->find('list', array(
                      'conditions' => array('Location.city_id' => $order_detail['ShoppingCart'][0]['Store']['store_city']),
                      'fields' => array('id', 'area_name')));
      
      $this->set(compact('order_detail', 'cities', 'location', 'page'));
      

    } else {
       $this->redirect(array('controller' => 'Orders', 'action' => 'index'));
    }
    
  }
  public function store_order() {
    $this->layout = 'assets';
    $id           = $this->Auth->User();
    $status = array('Delivered','Pending','Failed');

    $location = $this->Location->find('list', array(
                                    'fields' => array('id', 'area_name')));

    $city = $this->City->find('list', array(
                                    'fields' => array('id', 'city_name')));
    
    $orderList = $this->Order->find('all', array(
                        'conditions' => array('Order.store_id'=>$id['Store']['id'],
                                              'Order.order_type' => 'Delivery',
                            'NOT' => array('Order.status' => $status)),
                                'order' => array('Order.id DESC')));

    $this->set(compact('orderList', 'location', 'city'));
  }


  public function admin_orderStatus() {

    $orderStatusUpdate['id'] = $orderId      = $this->request->data['orderId'];
    $orderStatusUpdate['status']  = $this->request->data['status'];

    $orderDetail = $this->Order->findById($orderId);


    if (isset($this->request->data['reason'])) {
        $orderStatusUpdate['failed_reason']  = $this->request->data['reason'];
        $this->Order->save($orderStatusUpdate);
    }

    if ($this->request->data['status'] == 'Delivered') {

        $this->Orderstatus->deleteAll(array('Orderstatus.order_id'=>$orderId));
        $orderStatusUpdate['payment_method']  = 'paid';
        $this->Order->save($orderStatusUpdate);
    }

    if ($orderStatusUpdate['status'] == 'Accepted') {
        $orderStatusUpdate['driver_id']  = '';

        if ($this->Order->save($orderStatusUpdate)) {
            
            $gcmId = $orderDetail['Driver']['device_id'];
            
            $message = array(
                            'message' => 'Disclaim Order',
                            'OrderId' => $orderId,
                            'OrderDetails' => '');

            $gcm = $this->AndroidResponse->sendOrderByGCM($message,$gcmId);
            $gcm = json_decode($gcm, true);
            echo 'Success';
        }
    }
    

    // Store Owner Message
    if ($orderDetail['Store']['is_logged'] == 1) {
      
        $deviceId      = $orderDetail['Store']['device_id'];

        if ($this->request->data['status'] == 'Failed') {
          $message = 'This order '.$orderDetail['Order']['ref_number']. ' will be failed. due to '.$this->request->data['reason'].'.';
        } elseif (!empty($orderDetail['Driver']['device_id']) && $this->request->data['status'] == 'Accepted') {
          $message = 'This order '.$orderDetail['Order']['ref_number']. ' was disclaimed.';
        } else{
           $message = 'This order '.$orderDetail['Order']['ref_number']. ' will be '.strtolower(trim($this->request->data('status'))).'.';
        }

        $gcm = $this->AndroidResponse->sendOrderByGCM(
                        array('message'    => $message),
                                            $deviceId);

    }

    exit();
  }

  public function store_orderStatus() {
    
    $orderStatusUpdate['id'] = $orderId      = $this->request->data['orderId'];
    $orderStatusUpdate['status']  = $this->request->data['status'];

    $orderDetail = $this->Order->findById($orderId);


    if (isset($this->request->data['reason'])) {
        $orderStatusUpdate['failed_reason']  = $this->request->data['reason'];
        $this->Order->save($orderStatusUpdate);
    }

    if ($this->request->data['status'] == 'Delivered') {

        $this->Orderstatus->deleteAll(array('Orderstatus.order_id'=>$orderId));

        $orderStatusUpdate['payment_method']  = 'paid';

        $this->Order->save($orderStatusUpdate);
    }

    if ($orderStatusUpdate['status'] == 'Accepted') {
        $orderStatusUpdate['driver_id']  = '';

        if ($this->Order->save($orderStatusUpdate)) {
            
            $gcmId = $orderDetail['Driver']['device_id'];
            
            $message = array(
                            'message' => 'Disclaim Order',
                            'OrderId' => $orderId,
                            'OrderDetails' => '');

            $gcm = $this->AndroidResponse->sendOrderByGCM($message,$gcmId);
            $gcm = json_decode($gcm, true);
            echo 'Success';
        }
    }
    

    // Store Owner Message
    if ($orderDetail['Store']['is_logged'] == 1) {
      
        $deviceId      = $orderDetail['Store']['device_id'];

        if ($this->request->data['status'] == 'Failed') {
          $message = 'This order '.$orderDetail['Order']['ref_number']. ' will be failed. due to '.$this->request->data['reason'].'.';
        } elseif (!empty($orderDetail['Driver']['device_id']) && $this->request->data['status'] == 'Accepted') {
          $message = 'This order '.$orderDetail['Order']['ref_number']. ' was disclaimed.';
        } else{
           $message = 'This order '.$orderDetail['Order']['ref_number']. ' will be '.strtolower(trim($this->request->data('status'))).'.';
        }

        $gcm = $this->AndroidResponse->sendOrderByGCM(
                        array('message'    => $message),
                                            $deviceId);

    }

    exit();
  }
    public function store_collectionOrder(){
        $this->layout = 'assets';
        $id           = $this->Auth->User();
        $order_list = $this->Order->find('all', array(
                                        'conditions' => array('Order.status' => 'Accepted','Order.store_id'=>$id['Store']['id'],
                                            'Order.order_type' => 'Collection'),
                                        'order' => array('Order.id DESC')));

        $status = array('Accepted' => 'Accepted', 'Failed' => 'Failed', 'Delivered' => 'Delivered');

        $this->set(compact('order_list', 'status'));
    }

    public function store_failedOrderDetail(){
        $this->layout = 'assets';
        $id           = $this->Auth->User();
        $order_list = $this->Order->find('all', array(
            'conditions' => array('Order.status' => 'Failed',
                                    'Order.store_id'=>$id['Store']['id']),
            'order' => array('Order.id DESC')));
        $status = array('Pending' => 'Pending', 'Accepted' => 'Accepted',
            'Failed' => 'Failed', 'Delivered' => 'Delivered');
        $this->set(compact('order_list', 'status'));
    }

    public function ordermail($orderId) {

        $datas       = $this->Order->findById($orderId);
        $store_id    = $datas['Order']['store_id'];

        $statusmailCustomer = $this->Notification->find('first',array(
                                  'conditions'=>array('Notification.title =' => 'Order details mail')));

        $statusmailSeller   = $this->Notification->find('first',array(
                                  'conditions'=>array('Notification.title =' => 'Order sellar Mail')));

        $customerContent = $statusmailCustomer['Notification']['content'];
        $customerSubject = $statusmailCustomer['Notification']['subject'];

        $sellerContent = $statusmailSeller['Notification']['content'];
        $sellerSubject = $statusmailSeller['Notification']['subject'];


        $name= ' <table class="row note">
          <tbody><tr style="border-bottom:1px solid #ccc">
                <td class="wrapper vertical-middle bold center" width="35%">S.No</td>
                <td class="wrapper vertical-middle bold" width="20%">Item Image </td>
                <td class="wrapper vertical-middle bold" width="7%">Item Name</td>
                <td class="wrapper vertical-middle bold" width="20%">Qty</td>
                <td class="wrapper vertical-middle bold" width="20%">Price</td>
                <td class="wrapper vertical-middle bold" width="20%">Total Price</td>
          </tr>';

      $source = $this->siteUrl.'/siteicons/logo.png/';
      $title  = $Currency['Store_general']['logo'];

      /*$storename   = $Currency['Store_general']['name'];
      $storemailId = $Currency['Store_general']['customer_email'];*/

      /*$userId   = $Currency['Store_general']['user_id'];
      $Currency   = $Currency['Store_general']['currency_id'];
      $CurrencySymbol = $this->Currency->findById($Currency);*/
      $Currency   = $this->siteSetting['Country']['currency_symbol'];


        $name='<table cellpadding="5" cellspacing="0" width="100%" style=" text-align:left; color:#fff; table-layout:fixed; margin:auto; color:#666; border-collapse:separate;background:#fff; border:1px solid #b1b1b2; border-radius:3px">
           <thead><tr>
            <th width="5%" bgcolor="#777" align="left" style="color:#fff; padding-left:10px; text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:bold;word-wrap:break-word">
                S.No </th>
            <th width="5%" bgcolor="#777" align="left" style="color:#fff; padding-left:10px; text-align:left;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:bold;word-wrap:break-word">
                      Item Image </th>
            <th width="30%" bgcolor="#777" align="center" style="color:#fff; text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:bold;word-wrap:break-word">
                      Item Name </th>
            <th width="5%" bgcolor="#777" align="center" style="color:#fff; text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:bold;word-wrap:break-word">
                        Qty        </th>
            <th width="10%" bgcolor="#777" align="center" style="color:#fff; text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:bold;word-wrap:break-word">
                        Price   </th>
            <th width="10%" bgcolor="#777" align="center" style="color:#fff; text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:bold;word-wrap:break-word">
                        Total Price   </th></tr>
            </thead>
            <tbody>';

            foreach ($datas['ShoppingCart'] as $key => $data) {

              $productSrc = $this->siteUrl.'/stores/'.$store_id.'/products/carts/'.$data['product_image'];

              $serialNo = $key+1;

              $name.='<tr>
                    <td>'.$serialNo.'
                    <td bgcolor="#fff" style="word-wrap:break-word; padding-left:10px; width:auto; font-family:Helvetica,Arial,sans-serif;font-size:12px;border-bottom:1px solid #e0e0e0">
                    <img src="'.$productSrc.'" width="71" alt="" style="float:left;margin-right:5px; border:1px solid #454545">    
                <b>'. $data['productName'].'</b><br>
              </td><td bgcolor="#fafafa" style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:12px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0">
                 '. $data['product_name'].' </td>
              <td bgcolor="#fafafa" style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:12px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0">
                      '. $data['product_quantity'].'   </td>
              <td bgcolor="#fafafa" style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:12px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0">
                      '. $Currency." ".$data['product_price'] .'   </td>
              <td bgcolor="#fafafa" style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:11px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0">
                '. $Currency." ".$data['product_total_price'] .' </td>
              </tr>'; 
            }

          $name.='</tbody>
              <tfoot><tr>
              <td  colspan="5" style="text-align:right;font-family:Helvetica,Arial,sans-serif;font-size:12px;word-wrap:break-word; padding-right:10px;">
                  <b>Sub-Total :</b></td>
           <td  style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:12px;border-left:1px solid #e0e0e0">
            '. $Currency." ".$datas['Order']['order_sub_total'] .'</td>
          </tr>';
          
            if ($datas['Order']['delivery_charge'] > 0) {
              $name.='<tr>
              <td  colspan="5" style="text-align:right;font-family:Helvetica,Arial,sans-serif;font-size:12px;word-wrap:break-word; padding-right:10px;">
                <b>Delivery Fee  :</b></td>
                    <td  style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:12px;border-left:1px solid #e0e0e0">
                      '. $Currency." ".$datas['Order']['delivery_charge'].'</td>
                </tr>';
            }

            if ($datas['Order']['tax_amount'] > 0) {

              $name.='<tr>
                <td  colspan="5" style="text-align:right;font-family:Helvetica,Arial,sans-serif;font-size:12px;word-wrap:break-word; padding-right:10px;">
                <b>Tax  :</b></td>
                    <td  style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:12px;border-left:1px solid #e0e0e0">
                      '. $Currency." ".$datas['Order']['tax_amount'].'</td>
                </tr>';
            }

            if ($datas['Order']['offer_amount'] > 0) {

              $name.='<tr>
                <td  colspan="5" style="text-align:right;font-family:Helvetica,Arial,sans-serif;font-size:12px;word-wrap:break-word; padding-right:10px;">
                <b>Offer  :</b></td>
                    <td  style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:12px;border-left:1px solid #e0e0e0">
                      '. $Currency." ".$datas['Order']['offer_amount'].'</td>
                </tr>';
            }


              $name.='<tr>
                <td colspan="5" style="text-align:right;font-family:Helvetica,Arial,sans-serif;font-size:12px;word-wrap:break-word; padding-right:10px;">
                  <b>Total :</b></td>
                  <td  style="text-align:center;font-family:Helvetica,Arial,sans-serif;font-size:12px;border-left:1px solid #e0e0e0">
                    '. $Currency." ".$datas['Order']['order_grand_total'].' </td>
                </tr>
                </tfoot>
              </table>';


      $Address= '
      <table border="0" width="100%" cellpadding="0" cellspacing="0" align="center"><tr>
          <td valign="top" width="50%" style="padding:10px 10px; font-family: sans-serif; font-size: 13px; line-height: 24px; color: #3a3939; text-align: left;">
        <table width="100%" bordercolor="#fff" bgcolor="#b1b1b2" style="border:1px solid #b1b1b2; background-color:#fff;">
            <thead> <tr> <th bgcolor="#bd1104" style="background-color:#777; padding:5px; color:#fff">
              Here is your order information</th> </tr>
            </thead>
            <tbody style="display:block;">
              <tr><td  style="padding:5px 5px 0;" height="10px"><b>Order Number/ID :</b></td>
                  <td style="padding:5px 5px 0 0;" height="10px">'.$datas['Order']['ref_number'].'</td>
              </tr>
              <tr><td style="padding:0 5px 0;" height="10px"><b>Payment Method :</b></td>
                  <td style="padding:0 5px 0 0;" height="10px">'.str_ireplace('cod', 'cash on delivery', $datas['Order']['payment_type']) .'</td>
              </tr>
              <tr><td style="padding:0 5px 0;" height="10px"><b>Order Type :</b></td>
                  <td style="padding:0 5px 0 0;" height="10px">'.
                    $datas['Order']['order_type'].'</td>
              </tr>
              <tr><td style="padding:0 5px 0;" height="10px" ><b>'.$datas['Order']['order_type'].' Time :</b></td>
                  <td style="padding:0 5px 0 0;" height="10px">'.$datas['Order']['delivery_time_slot'].'</td>
              </tr>
            </tbody>
        </table>
        </td><td valign="top" width="50%" style="padding:10px 10px; font-family: sans-serif; font-size: 14px; line-height: 24px;">
          <table width="100%" bordercolor="#fff" bgcolor="#b1b1b2" style="border:1px solid #b1b1b2; background-color:#fff;">
          <thead>
            <tr><th bgcolor="#bd1104" style="background-color:#777; padding:5px; color:#fff">
              Address</th></tr>
            </thead>
            <tbody style="display:block;">
              <tr><td  style="padding:5px 5px 0;" height="10px"><b>'.
                  $datas['Order']['customer_name'].'</b></td></tr>
                <tr><td style="padding:0 5px 0;" height="10px"></br>'.
                    $datas['Order']['address']." ".
                    $datas['Order']['location_name']. ','.
                    $datas['Order']['city_name'].'</td></tr><tr><td>'.
                    $state[$datas['Order']['state_name']]." - ".
                    $this->siteSetting['Country']['country_name']. '</td></tr><tr><td><b>'.
                    $datas['Order']['customer_phone'].'<b></td></tr><tr><td>
                      
          </tbody>
        </table>
        </td></tr>
      </table>';


      $customer_mail = $datas['Order']['customer_email'];
      $customerName  = $datas['Order']['customer_name'];
      $storename     = $datas['Store']['store_name'];
      $storemailId   = $this->siteSetting['Sitesetting']['admin_email'];

      $mailContent = $customerContent;
      $siteUrl = $this->siteUrl;

      $mailContent = str_replace("{Customer name}", $customerName, $mailContent);
      $mailContent = str_replace("{source}", $source, $mailContent);
      $mailContent = str_replace("{title}", $title, $mailContent);
      $mailContent = str_replace("{Store name}", $storename, $mailContent);
      $mailContent = str_replace("{orderid}", $datas['Order']['ref_number'], $mailContent);
      $mailContent = str_replace("{note}", $name, $mailContent);
      $mailContent = str_replace("{Address}", $Address, $mailContent);
      $mailContent = str_replace("{SITE_URL}", $siteUrl, $mailContent);

      $customerSubject = str_replace("[with Order ID]", $datas['Order']['ref_number'], $customerSubject);
      $customerSubject = str_replace("store name", $storename, $customerSubject);

      $email = new CakeEmail();
      $email->from($storemailId);
      $email->to($customer_mail);
      $email->subject($customerSubject);
      $email->template('register');
      $email->emailFormat('html');
      $email->viewVars(array('mailContent' => $mailContent,
                          'source' => $source,
                          'storename' => $storename));

      $email->send();

      $mailContent = $sellerContent;

      $mailContent = str_replace("{Customer name}", $customerName, $mailContent);
      $mailContent = str_replace("{source}", $source, $mailContent);
      $mailContent = str_replace("{title}", $title, $mailContent);
      $mailContent = str_replace("{Store name}", $storename, $mailContent);
      $mailContent = str_replace("{orderid}", $order_id, $mailContent);
      $mailContent = str_replace("{note}", $name, $mailContent);
      $mailContent = str_replace("{Address}", $Address, $mailContent);
      $mailContent = str_replace("{SITE_URL}", $siteUrl, $mailContent);
      //$mailContent = str_replace("order ID", $datas['Order']['ref_number'], $mailContent);

      $sellerSubject = str_replace("[ Order ID ]", $datas['Order']['ref_number'], $sellerSubject);
      $sellerSubject = str_replace("customer name", $customerName, $sellerSubject);

      $email = new CakeEmail();
      $email->from($customer_mail); 
      $email->to($storemailId);
      $email->subject($sellerSubject);
      $email->template('register');
      $email->emailFormat('html');
      $email->viewVars(array('mailContent' => $mailContent,
                            'source' => $source,
                            'storename' => $storename));
      
      $email->send();

    }

}